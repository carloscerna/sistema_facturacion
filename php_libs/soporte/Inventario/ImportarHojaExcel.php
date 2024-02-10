<?php
header ('Content-type: text/html; charset=utf-8');
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexi�n a la base de datos
    include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
    include($path_root."/sistema_facturacion/includes/funciones.php");
    set_time_limit(0);
    ini_set("memory_limit","10000M");
// Inicializamos variables de mensajes y JSON
    $respuestaOK = true;
    $mensajeError = "Si Registro";
    $contenidoOK = "";
// variables. del post.
    $ruta = $path_root . '/sistema_facturacion/files/' . trim($_REQUEST["nombre_archivo_"]);
// variable de la conexi�n dbf.
    $db_link = $dblink;
// Inicializando el array
    $datos=array(); $fila_array = 0;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
// iniciar phpexcel.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// call the autoload
    require $path_root."/sistema_facturacion/vendor/autoload.php";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// load phpspreadsheet class using namespaces.
    // load phpspreadsheet class using namespaces.
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
// call xlsx weriter class to make an xlsx file
// Creamos un objeto Spreadsheet object
    $objPHPExcel = new Spreadsheet();
//
    $objPHPExcel->_defaultEncoding = 'ISO-8859-1';
// call xlsx weriter class to make an xlsx file
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Creamos un objeto Spreadsheet object
    $objPHPExcel = new Spreadsheet();
// Set default font
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Leemos un archivo Excel 2007
    $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
//
    $origen = $ruta;
	 $fila = 4;
     $n_hoja = 0;
    $objPHPExcel = $objReader->load($origen);
    //  Get the current sheet with all its newly-set style properties
    $objWorkSheetBase = $objPHPExcel->getSheet(0); 
// Indicamos que se pare en la hoja uno del libro
    $objPHPExcel->setActiveSheetIndex($n_hoja);
// IMPORTAR VALORES FIJOS.
    $fecha_inventario_ajuste = "31-12-" . $objPHPExcel->getActiveSheet()->getCell("B1")->getValue();
    $CeldaExistencia = $objPHPExcel->getActiveSheet()->getCell("D1")->getValue();
    $CeldaAjuste = $objPHPExcel->getActiveSheet()->getCell("E1")->getValue();
// N�mero de hoja.
   $numero_de_hoja = 0;
	$numero = 1;
	$codigo_producto = 0;
	$exento = "No";
	$precio = 0;						
   // VALORES QUE PROVIENEN DEL INVENTARIO. SE GUARDA LA EXISTENCIA EN EL CATALOGO PRODUCTOS.
   //	BUCLE QUE RECORRE TODA LA CUADRICULA DE LA HOJA DE CALCULO.
		while($objPHPExcel->getActiveSheet()->getCell("B".$fila)->getValue() != "")
		{
            //$fecha_inventario_ajuste = '31-12-2023'; // PRIMER INVENTARIO AGOSTO
				$codigo_producto = trim($objPHPExcel->getActiveSheet()->getCell("B".$fila)->getValue());
				$descripcion = "Ajuste de Inventario";
				$precio_costo = trim($objPHPExcel->getActiveSheet()->getCell("E".$fila)->getValue());
                if(empty($precio_costo)){
                    $precio_costo = 0;
                }
            //  Existencia y Ajuste.
			    $existencia = $objPHPExcel->getActiveSheet()->getCell($CeldaExistencia.$fila)->getCalculatedValue();		
                $cantidad_ajuste = $objPHPExcel->getActiveSheet()->getCell($CeldaAjuste.$fila)->getCalculatedValue();
            //
                $fila = $fila + 1;
                $numero++;
                //print "fecha: " . $fecha_inventario_ajuste . "<br>";
                //print "código producto: " . $codigo_producto . " precio costo: " . $precio_costo . " existencia: " . $existencia . " cantidad ajuste: " . $cantidad_ajuste . "<br>";
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //  ALMACENAR INFORMACION DE LA HOJA DE EXCEL CON RESPECTO AL AJUSTE DEL VALOR DE LAS
            // EXISTENCIA POR PRODUCTO.
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           // Query para buscar el registro si existe para guardarlo o insertarlo.
           $query_buscar_i = "SELECT * FROM productos_inventario_ajuste WHERE codigo_producto = '$codigo_producto' and fecha = '$fecha_inventario_ajuste'";
            $result_buscar_i = $db_link -> query($query_buscar_i);
            $fila_i = $result_buscar_i -> rowCount();

                if($fila_i == 0){
                // GUARDAR
                $query_guardar_i = "INSERT INTO productos_inventario_ajuste (fecha, codigo_producto, descripcion, cantidad, precio) VALUES ('$fecha_inventario_ajuste','$codigo_producto','$descripcion','$cantidad_ajuste','$precio_costo')";
                    $result_guardar_i = $db_link -> query($query_guardar_i);
                }else{
                $query_actualizar_i = "UPDATE productos_inventario_ajuste SET cantidad = '$cantidad_ajuste', precio = '$precio_costo' WHERE codigo_producto = '$codigo_producto' and fecha = '$fecha_inventario_ajuste'";
                $result_actualizar_i = $db_link -> query($query_actualizar_i);
                }
		}	// FIN DEL WHILE PRINCIPAL DE L AHOJA DE CALCULO.
// Armamos array para convertir a JSON
	$salidaJson = array(
        "respuesta" => $respuestaOK,
        "mensaje" => $mensajeError,
		"contenido" => $contenidoOK);
    echo json_encode($salidaJson);     