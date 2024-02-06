<?php
/*
header ('Content-type: text/html; charset=utf-8');
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
include($path_root."/sistema_facturacion/includes/funciones.php");
    set_time_limit(0);
    ini_set("memory_limit","2000M");
// variables. del post.
//  $ruta = $path_root.'/sgp_web/formatos_hoja_de_calculo/fianzas.xls';
// $ruta = $path_root.'/sgp_web/formatos_hoja_de_calculo/prestamos.xls';
	$ruta = $path_root.'/sistema_facturacion/formatos_hoja_de_calculo/inventario-2017.xls';
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
	require_once($path_root."/sistema_facturacion/phpexcel/Classes/PHPExcel/Reader/Excel5.php");
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
	 $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $origen = $ruta;
	 $fila = 3;
    $objPHPExcel = $objReader->load($origen);

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
				$codigo_categoria = $objPHPExcel->getActiveSheet()->getCell("A".$fila)->getValue();
				$codigo_producto = $objPHPExcel->getActiveSheet()->getCell("B".$fila)->getValue();
				//$descripcion = $objPHPExcel->getActiveSheet()->getCell("C".$fila)->getValue();
            $descripcion = "Inventario";
				$existencia = $objPHPExcel->getActiveSheet()->getCell("H".$fila)->getCalculatedValue();
				$exento = $objPHPExcel->getActiveSheet()->getCell("I".$fila)->getValue();
				//$precio = $objPHPExcel->getActiveSheet()->getCell("J".$fila)->getValue();
            $precio = $objPHPExcel->getActiveSheet()->getCell("K".$fila)->getCalculatedValue();
				$fecha = "01-01-2017";
				if(empty($precio)){$precio = 0;}
				if($exento == "X"){$exento = "Si";}else{$exento = "No";}
				
				$codigo_string = (string) $codigo_categoria;
				$codigo_categoria = codigos_nuevos_productos($codigo_string);
				
				$codigo_string = (string) $codigo_producto;
				$codigo_producto = codigos_nuevos_productos($codigo_string);
            $codigo = $codigo_categoria.$codigo_producto;

			$fila = $fila + 1;

				// Armar query para guardar en la tabla CATALOGO_PRODUCTOS.
				$query_cat = "INSERT INTO productos_inventario_inicial (codigo_producto, fecha, descripcion, cantidad, precio) VALUES ('$codigo','$fecha','$descripcion','$existencia','$precio')";
				$consulta_cat = $db_link -> query($query_cat);
           // print $query_cat . "<br>";
			print "Codigo Producto" . $codigo .' Descripcion - ' .$descripcion . ' Existencia - ' .$existencia . 'Precio '. $precio;
			//print "Codigo Categoria " . $codigo_categoria . " - Codigo Producto - " . $codigo_producto . ' Descripcion - ' .$descripcion . ' Existencia - ' .$existencia;
			print "<br>";
         $existencia = 0; $precio = 0;
		}	// FIN DEL WHILE PRINCIPAL DE L AHOJA DE CALCULO.
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