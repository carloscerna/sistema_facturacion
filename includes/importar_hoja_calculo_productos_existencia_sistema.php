<?php

header ('Content-type: text/html; charset=utf-8');
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
include($path_root."/sistema_facturacion/includes/funciones.php");
    set_time_limit(0);
    ini_set("memory_limit","2000M");
// variables. del post.
	//$ruta = $path_root.'/sistema_facturacion/formatos_hoja_de_calculo/inventario-agosto-2018.xlsx';
  //$trimestre = trim($_REQUEST["periodo_"]);
// variable de la conexión dbf.
    $db_link = $dblink;
// Inicializando el array
$datos=array(); $fila_array = 0;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
// iniciar phpexcel.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Clases Php
    require_once($path_root."/sistema_facturacion/phpexcel/Classes/PHPExcel.php");
   // require_once($path_root."/sgp_web/phpexcel/Classes/PHPExcel/Reader/Excel2007.php");
	require_once($path_root."/sistema_facturacion/phpexcel/Classes/PHPExcel/Reader/Excel2007.php");
// PHPExcel_IOFactory
    require_once($path_root."/sistema_facturacion/phpexcel/Classes/PHPExcel/IOFactory.php");

// Creamos un objeto PHPExcel
    $objPHPExcel = new PHPExcel();

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
	 $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $origen = $path_root."/sistema_facturacion/formatos_hoja_de_calculo/";
    $objPHPExcel = $objReader->load($origen."inventario-agosto-2018.xlsx");    
	 $fila = 7;

// Número de hoja.
   $numero_de_hoja = 0;
	$numero = 1;
	$codigo_producto = 0;
	$exento = "No";
	$precio = 0;
   //$total_de_hojas = $objPHPExcel->getSheetCount();
// 	Recorre el numero de hojas que contenga el libro
       $objPHPExcel->setActiveSheetIndex($numero_de_hoja);
		//	BUCLE QUE RECORRE TODA LA CUADRICULA DE LA HOJA DE CALCULO.
		while($objPHPExcel->getActiveSheet()->getCell("A".$fila)->getValue() != "")
		  {
			 //  DATOS GENERALES.
				$codigo_producto = trim($objPHPExcel->getActiveSheet()->getCell("B".$fila)->getValue());
				// Armar query para guardar en la tabla CATALOGO_PRODUCTOS.
				$query_cat = "SELECT existencia FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
				$consulta_cat = $db_link -> query($query_cat);
                // convertimos el objeto
										while($listados = $consulta_cat -> fetch(PDO::FETCH_BOTH))
										{
											$existencia_sistema = trim($listados['existencia']);
										}
			print "Codigo Producto" . $codigo_producto .' Existencia del Sistema - ' .$existencia_sistema;
			print "<br>";                
         // GRABAR EN LA CELDA AX7
         $objPHPExcel->getActiveSheet()->SetCellValue("D".$fila, $existencia_sistema);
         $existencia = 0;
         $fila = $fila + 1;
		}	// FIN DEL WHILE PRINCIPAL DE L AHOJA DE CALCULO.
	// Nombre del archivo.
		$nombre_archivo = ("Inventario-agosto-2018-1.xlsx");

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($origen.$nombre_archivo);
/*
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								$query_p = "SELECT id_productos, codigo, substring(codigo from 1 for 3)::int as codigo_cargo_numero_entero
											FROM catalogo_productos ORDER BY codigo_cargo_numero_entero DESC LIMIT 1";
							// Ejecutamos el Query.
									$consulta_p = $dblink -> query($query_p);
									// Verificar si existen registros.
									if($consulta_p -> rowCount() != 0){
										// convertimos el objeto
										while($listados = $consulta_p -> fetch(PDO::FETCH_BOTH))
										{
											$codigo_entero_p = trim($listados['codigo_cargo_numero_entero']) + 1;
											$codigo_string_p = (string) $codigo_entero_p;
											$codigo_nuevo_p = codigos_nuevos($codigo_string_p);
										}
										// Armar query para guardar en la tabla CATALOGO_PRODUCTOS.
										$query_cat = "INSERT INTO catalogo_productos (codigo, descripcion, existencia, codigo_categoria) VALUES ('$codigo_nuevo_p','$nombre','$cantidad','$codigo_nuevo')";
										$consulta_cat = $dblink -> query($query_cat);
									}
									else{
											$codigo_nuevo_p = "001";
										// Armar query para guardar en la tabla CATALOGO_PRODUCTOS.
										$query_cat = "INSERT INTO catalogo_productos (codigo, descripcion, existencia, codigo_categoria) VALUES ('$codigo_nuevo_p','$nombre','$cantidad','$codigo_nuevo')";
										$consulta_cat = $dblink -> query($query_cat);}
										
										
													// condición
			if((int) $codigo_categoria === $numero){
				$codigo_producto = $codigo_producto + 1;
				
			}else{
				$codigo_producto = 1;
				$numero = $numero + 1;
			}
			$objPHPExcel->getActiveSheet()->SetCellValue("B".$fila, $codigo_producto);
										
										*/