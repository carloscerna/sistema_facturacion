<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
    include($path_root."/sistema_facturacion/includes/funciones_2.php");
    //include($path_root."/sistema_facturacion/includes/consultas.php");
    include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
   	include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");
// variables y consulta a la tabla.
    $id_ = $_REQUEST["id_"];
    $fecha_ = explode("/",$_REQUEST["fecha_"]);
    $fecha_año = $fecha_[2];
    $separar_numero_factura = explode("-",$_POST['numero_factura']);
    $separar_codigo_tipo_factura = explode("-",$_POST['codigo_tipo_factura']);
    $numero_factura = $separar_numero_factura[1];
    $numero_factura_real = $separar_numero_factura[0];
    $codigo_tipo_factura = $separar_codigo_tipo_factura[0]; 
//
    $db_link = $dblink;
    if(isset($_REQUEST['cambiar_fecha'])){$cambiar_fecha = $_REQUEST['cambiar_fecha'];}else{$cambiar_fecha = 0;}
    if(isset($_REQUEST['fecha_nueva'])){$fecha_nueva = cambiaf_a_normal($_REQUEST['fecha_nueva']);}else{$fecha_nueva = "";}

// Inicializamos variables de mensajes y JSON
$respuestaOK = true;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";

// Proceso de la creaciòn de la Hoja de cálculo.
    $n_hoja = 0;	// variable para el activesheet.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// call the autoload
    require $path_root."/sistema_facturacion/vendor/autoload.php";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// load phpspreadsheet class using namespaces.
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
// call xlsx weriter class to make an xlsx file
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Creamos un objeto Spreadsheet object
    $objPHPExcel = new Spreadsheet();
// Time zone.
    //echo date('H:i:s') . " Set Time Zone"."<br />";
    date_default_timezone_set('America/El_Salvador');
// set codings.
//    $objPHPExcel->_defaultEncoding = 'ISO-8859-1';
// Set default font
    //echo date('H:i:s') . " Set default font"."<br />";
            //
	    // Establecer formato para la fecha.
	    // 
		date_default_timezone_set('America/El_Salvador');
		setlocale(LC_TIME,'es_SV');
	    //
		//$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
                //Salida: Viernes 24 de Febrero del 2012		


    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Leemos un archivo Excel 2007
    $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $origen = $path_root."/sistema_facturacion/formatos_hoja_de_calculo/";
    $objPHPExcel = $objReader->load($origen."cotizaciones.xlsx");
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // consulta a la tabla para optener la nomina.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Get the current sheet with all its newly-set style properties
    $objWorkSheetBase = $objPHPExcel->getSheet(0); 
// Indicamos que se pare en la hoja uno del libro
    $objPHPExcel->setActiveSheetIndex($n_hoja);
    //$objPHPExcel->getActiveSheet($n_hoja)->setTitle(cambiar_de_del($print_grado).' '.$print_seccion);
    $n_hoja++;    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Time zone.
    //echo date('H:i:s') . " Set Encabezado"."<br />";
//Escribimos en la hoja en la celda e3. los datos del bachillerato, grado, sección, año lectivo, etc.
//    $objPHPExcel->getActiveSheet()->SetCellValue('A1', $print_bachillerato);
// ARMAR LA CONSULTA.
// Armar Consulta para Recorrer la factura.
				$query_factura = "SELECT fac_dv.codigo_producto, fac_dv.numero_factura, fac_dv.cantidad, fac_dv.precio_venta, fac_dv.precio_venta as venta_exenta, fac_dv.codigo_tipo_factura, 
					fac_v.fecha, fac_v.codigo_descuento, cat_des.descripcion as porcentaje, fac_v.codigo_vendedor, fac_v.total_venta,
					cat_pro.descripcion, cat_pro.producto_exento,
					(cli.nombres || cast( ' ' as varchar) || cli.apellidos) as nombre_completo, cli.direccion, cli.dui, cli.nit, cli.cliente_empresa
					FROM facturas_detalles_ventas fac_dv
						INNER JOIN facturas_ventas fac_v ON fac_v.numero_factura = fac_dv.numero_factura
						INNER JOIN catalogo_productos cat_pro ON (cat_pro.codigo_categoria || cat_pro.codigo) = fac_dv.codigo_producto
						INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
						INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento
							WHERE fac_dv.numero_factura_real = '$numero_factura_real' and fac_dv.numero_factura = {$numero_factura} and
                    fac_v.codigo_tipo_factura = '$codigo_tipo_factura' and fac_dv.codigo_tipo_factura = '$codigo_tipo_factura' and fac_v.numero_factura_real = '$numero_factura_real' and fac_v.numero_factura = {$numero_factura}";
                    
		$resultado_factura = $db_link -> query($query_factura);
// Correlativo, numero de linea.
    $num = 0; $fila_excel = 15;
    while($row = $resultado_factura -> fetch(PDO::FETCH_BOTH))
    {
      //  LLENAR LAS CELDAS QUE CONTIENEN VALORES FIJOS EN LA COTIZACIÒN.
      if($num === 0)
      {
        //Crear una línea. Fecha.
            $fecha_venta = cambiaf_a_normal($row["fecha"]);
            if($cambiar_fecha == 1){
                $fecha = $fecha_nueva;
            }else{
                $fecha = $fecha_venta;
            }
            $dato_fecha = explode("/", $fecha);  
            $dia = $dato_fecha[0];		// El Día.
            $mes = $meses[$dato_fecha[1]-1];
            $año = $dato_fecha[2];;		// El Año.
            
        // variables
        $numero_factura = "FAC " . codigos_factura($row["numero_factura"]);
        $cliente_empresa = $row["cliente_empresa"];
        $total_venta = number_format($row["total_venta"],2);
        // CELDAS
        $objPHPExcel->getActiveSheet()->SetCellValue("D7", "Santa Ana, ".$dia." de ".$mes." de ".$año);
        //$objPHPExcel->getActiveSheet()->SetCellValue("A103", "Santa Ana, ".$dia." de ".$mes." de ".$año);
        $objPHPExcel->getActiveSheet()->SetCellValue("E5", $numero_factura);
        $objPHPExcel->getActiveSheet()->SetCellValue("D9", $cliente_empresa);
      }
    // acumular correlativo y fila.
        $num++; $fila_excel++;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Cantidad
	$cantidad = $row['cantidad'];
	// Descripcion
	$descripcion = trim(($row['descripcion']));
	// Precio Unitario
	$precio_venta = $row['precio_venta'];
  // Precio unitario * cantidad.
  
	//  IMPRIMIR EL CONTENIDO DE  INFORMACION EN EXCEL.
    $objPHPExcel->getActiveSheet()->SetCellValue("A".$fila_excel, $num);
    $objPHPExcel->getActiveSheet()->SetCellValue("B".$fila_excel, $cantidad);
    $objPHPExcel->getActiveSheet()->SetCellValue("D".$fila_excel, $descripcion);
    $objPHPExcel->getActiveSheet()->SetCellValue("E".$fila_excel, $precio_venta);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
   }    //  FIN DEL WHILE.
// Verificar si Existe el directorio archivos.
    //$codigo_tipo_factura = $codigo_tipo_factura;
    $nombre_ann_lectivo = $fecha_año;
    $cantidad_en_letras = mb_convert_encoding(numtoletras($total_venta),"ISO-8859-1","UTF-8");
    
// Escribar cantidad en letras
    $objPHPExcel->getActiveSheet()->SetCellValue("D134", $cantidad_en_letras);
    $codigo_destino = 1;
    CrearDirectorios($path_root,$nombre_ann_lectivo,$codigo_tipo_factura,$codigo_destino,"");
// Nombre del archivo.
    $nombre_archivo = ($numero_factura .".xlsx");
//
	try {
    // Grabar el archivo.
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($DestinoArchivo.$nombre_archivo);
    // cambiar permisos del archivo antes grabado.
		chmod($DestinoArchivo.$nombre_archivo,07777);
	}catch(Exception $e){
		$respuestaOK = false;
		$mensajeError = "No Save";
		$contenidoOK = "Error - > ".$e;
	}
// Armamos array para convertir a JSON
$salidaJson = array("respuesta" => $respuestaOK,
		"mensaje" => $mensajeError,
		"contenido" => $contenidoOK);

echo json_encode($salidaJson);	
?>