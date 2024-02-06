<?php
session_name('demoUI');
// Inicializamos variables de mensajes y JSON
$respuestaOK = true;
$mensajeError = "Si Save";
$contenidoOK = "Si Save";
// ruta de los archivos con su carpeta
$path_root=trim($_SERVER['DOCUMENT_ROOT']);
// COLOCAR UN LIMITE A LA MEMORIA PARA LA CREACIÓN DE LA HOJA DE CÁLCULO.
    set_time_limit(0);
    ini_set("memory_limit","1024M");
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//    VARIABLES QUE PROVIENEN DEL TEMP DETALLE FACTURA 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
               $codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_usuario = $_POST['codigo_usuario'];
					$codigo_producto = $_POST['codigo_producto'];   // columna C.
					$cantidad = convertir_a_numero($_POST['cantidad']);   // Columna D.
					$precio = convertir_a_numero($_POST['precio']); // Columna F.
                    $numero_factura = $_POST['numero_factura'];
                    $fecha = $_POST['fecha'];
               // Fila
               $fila_excel = 1;               
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// call the autoload
    require $path_root."/sistema_facturacion/vendor/autoload.php";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// load phpspreadsheet class using namespaces.
    //use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
// call xlsx weriter class to make an xlsx file
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Creamos un objeto Spreadsheet object
    $objPHPExcel = new Spreadsheet();
// Set default font
    //echo date('H:i:s') . " Set default font"."<br />";
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Leemos un archivo Excel 2007 y verificar si la carpeta o directorio existe.
		$objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$origen = $path_root."/sistema_facturacion/formatos_hoja_de_calculo/";
		$nombre_de_hoja_de_calculo = "detalle de la venta.xlsx";
		
				// Indicamos que se pare en la hoja uno del libro
            		$objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet(0)->setTitle("Prueba");
    
                // Seleccionar el archivo con el se trabajará
                    $objPHPExcel = $objReader->load($origen.$nombre_de_hoja_de_calculo);
                //	BUCLE QUE RECORRE TODA LA CUADRICULA DE LA HOJA DE CALCULO.
                    while($objPHPExcel->getActiveSheet()->getCell("C".$fila_excel)->getValue() != "")
                      {
                        $fila_excel++;
                      }
					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//  IMPRIMIR EL CONTENIDO DE  INFORMACION EN EXCEL.
						$objPHPExcel->getActiveSheet()->SetCellValue("A".$fila_excel, $numero_factura);
						$objPHPExcel->getActiveSheet()->SetCellValue("B".$fila_excel, $fecha);
						$objPHPExcel->getActiveSheet()->SetCellValue("C".$fila_excel, $codigo_producto);
						$objPHPExcel->getActiveSheet()->SetCellValue("D".$fila_excel, $cantidad);
						$objPHPExcel->getActiveSheet()->SetCellValue("E".$fila_excel, "");
						$objPHPExcel->getActiveSheet()->SetCellValue("F".$fila_excel, $precio);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Guardamos el archivo en formato Excel 2016
	try {
		$objPHPExcel->setActiveSheetIndex(0);
    // Verificar el formato a grabar el archivo.
		$objWriter = new Xlsx($objPHPExcel);
	// nuevo nombre sin espacios.. para guardar el archivo.
      $DestinoArchivo = $origen;
		$nombre_archivo = $nombre_de_hoja_de_calculo;
     // Guardar la ubicacion y el nombre del archivo.
		$objWriter->save($DestinoArchivo.$nombre_archivo);
    // cambiar permisos del archivo antes grabado.
		//chmod($DestinoArchivo.$nombre_archivo,07777);
	}catch(Exception $e){
		$respuestaOK = false;
		$mensajeError = "No Save";
		$contenidoOK = "".$e;
	}
// Armamos array para convertir a JSON
	$salidaJson = array("respuesta" => $respuestaOK,
		"mensaje" => $mensajeError,
		"contenido" => $contenidoOK);	
// enviar el Json
echo json_encode($salidaJson);
?>