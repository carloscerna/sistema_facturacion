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
   $ruta = '../files/' . trim($_REQUEST["nombre_archivo_"]);
  
// variable de la conexi�n dbf.
    $db_link = $dblink;
// Inicializando el array
   $datos=array(); $fila_array = 0;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
// iniciar phpexcel.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
    //date_default_timezone_set('America/El_Salvador');
// set codings.
    $objPHPExcel->_defaultEncoding = 'ISO-8859-1';
// Set default font
    //echo date('H:i:s') . " Set default font"."<br />";
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Leemos un archivo Excel 2007
    //$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	 $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $origen = $ruta;
	 $fila = 3;
    $objPHPExcel = $objReader->load($origen);
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
			 //  DATOS GENERALES.
            $year_inventario_ajuste = 2023;
           // $fecha_inventario_ajuste = '06-08-'.$year_inventario_ajuste; // PRIMER INVENTARIO AGOSTO
            $fecha_inventario_ajuste = '23-12-'.$year_inventario_ajuste; // SEGUNDO INVENTARIO DICIEMBRE
				$codigo_producto = trim($objPHPExcel->getActiveSheet()->getCell("B".$fila)->getValue());
				$descripcion = "Ajuste de Inventario";
				$precio_costo = trim($objPHPExcel->getActiveSheet()->getCell("E".$fila)->getValue());
            if(empty($precio_costo)){
               $precio_costo = 0;
            }
				//$descripcion = $objPHPExcel->getActiveSheet()->getCell("C".$fila)->getValue();
				$existencia = $objPHPExcel->getActiveSheet()->getCell("AQ".$fila)->getCalculatedValue();		
            $cantidad_ajuste = $objPHPExcel->getActiveSheet()->getCell("AR".$fila)->getCalculatedValue();

            $fila = $fila + 1;
            $numero++;
		//print "Codigo Producto - " . $codigo_producto . ' Descripcion - ' .$descripcion . ' Existencia - ' .$cantidad_ajuste;
	//	print "<br>";
     //   }
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
			
			//print "Codigo Producto - " . $codigo_producto . ' Descripcion - ' .$descripcion . ' Existencia - ' .$cantidad_ajuste;
			//print "<br>";
		}	// FIN DEL WHILE PRINCIPAL DE L AHOJA DE CALCULO.
      //print "Cantidad de Productos: " . $numero;

// Armamos array para convertir a JSON
	$salidaJson = array("respuesta" => $respuestaOK,
   	"mensaje" => $mensajeError,
		"contenido" => $contenidoOK);
echo json_encode($salidaJson);     
      