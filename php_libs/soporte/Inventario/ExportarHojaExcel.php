<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
	include($path_root."/sistema_facturacion/includes/funciones_2.php");
    include($path_root."/sistema_facturacion/includes/consultas.php");
	include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
//
// Establecer formato para la fecha.
// 
    date_default_timezone_set('America/El_Salvador');
    setlocale(LC_TIME,'es_SV');
    //
    //$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
            //Salida: Viernes 24 de Febrero del 2012		
    //Crear una línea. Fecha.
    //$dia = strftime("%d");		// El Día.
    $mes = $meses[date('n')-1];     // El Mes.
    //$año = strftime("%Y");		// El Año.
    $year = $año;
    //$dato = explode("/",$fecha_inicio);
    //$dato_entero = (int)$dato[1];
    //$mes = $meses[$dato_entero-1];     // El Mes.
    //$year = $dato[2];
// variables y consulta a la tabla.
  //$codigo_estatus = $_REQUEST["codigo_estatus"];
  $db_link = $dblink;
// Inicializamos variables de mensajes y JSON
$respuestaOK = true;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
// COLOCAR UN LIMITE A LA MEMORIA PARA LA CREACIÓN DE LA HOJA DE CÁLCULO.
set_time_limit(0);
ini_set("memory_limit","1024M");
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
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Style;
// Creamos un objeto Spreadsheet object
    $objPHPExcel = new Spreadsheet();
// Time zone.
    //echo date('H:i:s') . " Set Time Zone"."<br />";
    date_default_timezone_set('America/El_Salvador');
// set codings.
//    $objPHPExcel->_defaultEncoding = 'ISO-8859-1';
// Set default font
    //echo date('H:i:s') . " Set default font"."<br />";
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Leemos un archivo Excel 2007
    $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $origen = $path_root."/sistema_facturacion/formatos_hoja_de_calculo/";
    $objPHPExcel = $objReader->load($origen."Exportar-Inventario.xlsx");
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // consulta a la tabla para optener la nomina.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  Get the current sheet with all its newly-set style properties
    $objWorkSheetBase = $objPHPExcel->getSheet(0); 
// Indicamos que se pare en la hoja uno del libro
    $objPHPExcel->setActiveSheetIndex($n_hoja);
//  Escribir el año lectivo
    $yearInventario = $_POST["yearInventario"];
        $objPHPExcel->getActiveSheet()->SetCellValue("B1", $yearInventario);
// estilo
    $sharedStyle2 = new Style();
    $sharedStyle2->applyFromArray(
        ['fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => 'ffffffff'],
                ],
                'borders' => [
                    'bottom' => ['borderStyle' => Border::BORDER_THIN],
                    'right' => ['borderStyle' => Border::BORDER_MEDIUM],
                ],
            ]
    );
    
    $objPHPExcel->getActiveSheet()->duplicateStyle($sharedStyle2, 'A4:BI10000');
    //$objPHPExcel->getActiveSheet($n_hoja)->setTitle(cambiar_de_del($print_grado).' '.$print_seccion);
    $n_hoja++;    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Armar Consulta para Recorrer la talba personal
// 00-TODOS, 01- ACTIVOS; 02-INACTIVOS.
  $query_ = "SELECT codigo_categoria, codigo, descripcion, existencia, precio_costo
              FROM catalogo_productos
                GROUP BY codigo_categoria, codigo, descripcion, existencia, precio_costo
                  ORDER BY codigo_categoria";

// EJECUAR QUERY PARA LA TABLA PERSONAL.
   $resultado_ = $db_link -> query($query_);
// RECORRER EL WHILE Y OPTENEER LOS DIFERENTES VALORES.   
    $num = 1; $fila_excel = 4;
    while($row = $resultado_ -> fetch(PDO::FETCH_BOTH))
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Variables
        $codigo = $row['codigo_categoria'] . $row['codigo'];
        $descripcion = trim($row["descripcion"]);
        $existencia = ($row["existencia"]);
        $precio_costo = ($row["precio_costo"]);
        //  IMPRIMIR EL CONTENIDO DE  INFORMACION EN EXCEL.
        $objPHPExcel->getActiveSheet()->SetCellValue("A".$fila_excel, $num);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila_excel,$codigo);
        //$objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$fila_excel,$codigo,PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$fila_excel, $descripcion);
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$fila_excel, $existencia);
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$fila_excel, $precio_costo);
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // ESTABLECER FORMULA EN.
            $FormulaSuma = "=SUM(F" . $fila_excel .":BG".$fila_excel.")";
            $FormulaSi = "=IF(BH".$fila_excel."=0,D".$fila_excel."*-1,BH".$fila_excel."-D".$fila_excel.")";
            $objPHPExcel->getActiveSheet()->setCellValue("BH".$fila_excel, $FormulaSuma);
            $objPHPExcel->getActiveSheet()->setCellValue("BI".$fila_excel, $FormulaSi);
        // BODERS EN LAS CELDAS
            //Comprobamos si num es un número par o no
            if (($fila_excel % 2) == 0) {
                //Es un número par
                $RangoColumnas = "A".$fila_excel.":BI".$fila_excel;
                $objPHPExcel->getActiveSheet()->getStyle($RangoColumnas)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFAFEEEE');
                $objPHPExcel->getActiveSheet()->getStyle($RangoColumnas)->getFont()->getColor()->setRGB('FFFFFFFF');
            } else {
                //Es un número impar
                $RangoColumnas = "A".$fila_excel.":BI".$fila_excel;
                $objPHPExcel->getActiveSheet()->getStyle($RangoColumnas)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFFFF');
                $objPHPExcel->getActiveSheet()->getStyle($RangoColumnas)->getFont()->getColor()->setRGB('FF000000');
            }
        // acumular correlativo y fila.
            $num++; $fila_excel++;

   }    //  FIN DEL WHILE.
// PROCESO DE GUARDADO DEL LIBRO SALDOS.
//
// Verificar si Existe el directorio archivos.
    $codigo_tipo_factura = "";
	// Tipo de Carpeta a Grabar.
		$codigo_destino = 2;
		CrearDirectorios($path_root,$yearInventario,$codigo_tipo_factura,$codigo_destino,"");
    // nombre del archivo. verificar el tipo.
    	$nombre_archivo = replace_3("Inventario-".$yearInventario.".xlsx");
    // Guardar el ARchivo Inventario.
    	//$objWriter = new Xlsx($objPHPExcel);
        //$objWriter->save($DestinoArchivo.$nombre_archivo);
    
	try {
        $respuestaOK = true;
		$mensajeError = "Archivo Guardado.";
    // Grabar el archivo.
        $objWriter = new Xlsx($objPHPExcel);
        $objWriter->save($DestinoArchivo.$nombre_archivo);
    // cambiar permisos del archivo antes grabado.
		//chmod($origen.$nombre_archivo,07777);
        // Armamos array para convertir a JSON
            $salidaJson = array("respuesta" => $respuestaOK,
            "mensaje" => $mensajeError,
            "contenido" => $contenidoOK);

            echo json_encode($salidaJson);	
	}catch(Exception $e){
		$respuestaOK = false;
		$mensajeError = "Achivo no guardado.";
		$contenidoOK = "Error - > ".$e;

        // Armamos array para convertir a JSON
            $salidaJson = array("respuesta" => $respuestaOK,
            "mensaje" => $mensajeError,
            "contenido" => $contenidoOK);

            echo json_encode($salidaJson);	
	}
?>