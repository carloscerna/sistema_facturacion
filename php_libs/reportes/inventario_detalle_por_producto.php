<?php
sleep(1);
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
//	include($path_root."/sistema_facturacion/includes/DeNumero_a_Letras.php");
	include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
	//include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");

// Llamar a la libreria fpdf
    include($path_root."/sistema_facturacion/php_libs/fpdf/fpdf.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
//	$fecha = $_REQUEST["fecha"];

	$printer = 0;
    $db_link = $dblink;
    $fecha_inicio = ($_REQUEST["fecha_inicio"]);
    $fecha_fin = ($_REQUEST["fecha_fin"]);
    $codigo_producto = ($_REQUEST["codigo_producto"]);
    $precio_compra_anterior = 0;  
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
		$dia = strftime("%d");		// El Día.
  $mes = $meses[date('n')-1];     // El Mes.
		$año = strftime("%Y");		// El Año.
    $dato = explode("/",$fecha_inicio);
    $dato_entero = (int)$dato[1];
    $mes = $meses[$dato_entero-1];     // El Mes.
    $year = $dato[2];
class PDF extends FPDF
{
// rotar texto funcion TEXT()
function RotatedText($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
  $this->Text($x,$y,$txt);
	$this->Rotate(0);
}

// rotar texto funcion MultiCell()
function RotatedTextMultiCellDireccion($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
	$this->MultiCell(70,4,$txt,0,'L');
	$this->Rotate(0);
}

function RotatedTextMultiCellGiro($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
	$this->MultiCell(40,2.5,$txt,0,'L');
	$this->Rotate(0);
}

//Cabecera de página
function Header()
{
 global $fecha_inicio, $fecha_fin, $codigo, $descripcion, $codigo_c, $mes, $year;
	// Encabezado
	$this->SetFont('Comic','','9');
 $this->Cell(100,4.5,utf8_decode('Contribuyente: Gladis Marisol López de Guardado'),0,1,'L');
	$this->Cell(150,4.5,'Nombre Comercial: LIBRERIA Y PAPELERIA PRIMAVERA',0,0,'L');
 $this->SetFont('Comic','','8');
 $this->Cell(40,4.5,'N.I.T.: 0210-180684-103-8',0,0,'L');
 $this->Cell(40,4.5,'N.R.C.: 241910-3',0,1,'L');
 $this->Cell(150,4.5,utf8_decode('Control del Inventario año ' . $year),0,0,'L');
 $this->Cell(100,4,'PERIODO DEL ' . ($fecha_inicio) . ' AL ' . ($fecha_fin),0,1,'L');
  
 $this->Cell(150,4,utf8_decode('Descripción del Producto:'),0,0,'L');
 $this->Cell(40,4,utf8_decode('Código Artículo:'),0,1,'L');
 $this->Cell(40,4,utf8_decode('Localización: '),0,0,'L');
 $this->Cell(40,4,utf8_decode('Cantidad Máxima: 1'),0,0,'L');
 $this->Cell(40,4,utf8_decode('Cantidad Mínima: 10'),0,1,'L');
// Encabezado
	//$this->SetFont('Comic','','14');
	//$this->Cell(210,6,'Inventario del '.cambiaf_a_normal($fecha_inicio).' al '.cambiaf_a_normal($fecha_fin),0,1,'C');
	// Encabezado
	$this->SetFont('Comic','','10');
	$this->SetY(30);
}

//Pie de página
function Footer()
{
	$this->SetY(-10);
    $this->SetX(10);
	//Crear ubna línea
    $this->Line(10,285,200,285);
	
    $fecha = date("l, F jS Y ");
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'L');
    $this->SetX(80);
    $this->Cell(0,10,$fecha,0,0,'L');
}
//Tabla coloreada
function FancyTable($header)
{
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Comic','','8');
	$this->SetX(5);
    //Cabecera
		$alto=array(6); //determina el ancho de las columnas
		$ancho=array(10,15,20,10,10,60,15,15,15,15,15,15,15,15); //determina el ancho de las columnas
    // armar el encabezado COMPRAS.
      $this->Cell($ancho[0],6,'','LRT','C',1);
      $this->Cell($ancho[1],6,'','LRT','C',1);
      $this->Cell($ancho[2],6,'','LRT','C',1);
      $this->Cell($ancho[3],6,'','LRT','C',1);
      $this->Cell($ancho[4],6,'','LRT','C',1);
      $this->Cell($ancho[5],6,'','LRT','C',1);
      $this->Cell($ancho[6],6,'Costo','LRT',0,'C',1);
      $this->Cell($ancho[7],6,'Costo','LRT',0,'C',1);
      $this->Cell(45,6,'UNIDADES',1,0,'C',1);
      $this->Cell(45,6,'VALORES',1,1,'C',1);
    for($i=0;$i<count($header);$i++)
        $this->Cell($ancho[$i],$alto[0],utf8_decode($header[$i]),'LRB',0,'C',1);

    $this->Ln();
    //Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Datos
    $fill=false;
}
}
//************************************************************************************************************************
// Creando el Informe.
    $pdf=new PDF('L','mm','Letter');	//  Carta.
    #Establecemos los márgenes izquierda, arriba y derecha: 
    $pdf->SetMargins(5, 5, 5);
    #Establecemos el margen inferior: 
    $pdf->SetAutoPageBreak(true,5);
//	Agregar el tipo de letra.	
    $pdf->AddFont('Comic','','comic.php');
    $pdf->AddFont('PoetsenOne','','PoetsenOne-Regular.php');
//Títulos de las columnas
    $header=array('');
    $pdf->AliasNbPages();
    $pdf->AddPage();
	$pdf->SetX(5);
/////////////////////////////////////////////////////////////////////////////////////////
// ARMAR EL ENCABEZADO
		$header=array('N°','Fecha','N° Doc.','Compra','Venta','Proveedor/Cliente','Promedio','Unitario','Entrada','Salida','Existencia','Entrada','Salida','Saldo');
		$alto=array(6); //determina el ancho de las columnas
		$ancho=array(10,15,20,10,10,60,15,15,15,15,15,15,15,15); //determina el ancho de las columnas
/////////////////////////////////////////////////////////////////////////////////////////
	//$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;
//	Consulta tabla Tipo de Factura.
 $query_ = "SELECT codigo_categoria, codigo, descripcion, existencia FROM catalogo_productos
            WHERE btrim(codigo_categoria || codigo) = '$codigo_producto'
            GROUP BY codigo_categoria, codigo, descripcion, existencia ORDER BY codigo_categoria, codigo";
	$result_ = $db_link -> query($query_);
	$num = 0; $salto = 0; $existencia = 0; $saldo = 0;
 $t_total_compra = 0; $t_total_cantidad_compra = 0;
 $t_total_venta = 0; $t_total_cantidad_venta = 0;
 $total_general_cantidad_compra = 0; $total_general_precio_compra = 0;
 $total_general_cantidad_venta = 0; $total_general_precio_venta = 0;
 $fila_salto = 27;
  // crear matriz para el codigo del producto.
  $codigo_categoria_array = array(); $codigo_array = array(); $codigo_c = array();
  $y = $pdf->GetY();
        // LIMPIAR TABLA
          $query_limpiar = "DELETE FROM inventario";
          $result_limpiar = $db_link -> query($query_limpiar);
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
					$codigo_categoria = trim($row_["codigo_categoria"]);
					$codigo = trim($row_["codigo"]);
          $codigo_producto = $codigo_categoria . $codigo;
										// VALIDAR CODIGO DE COPIAS Y AMPLIACIONES.
										if($codigo_producto <> '205001' or $codigo_producto <> '205002' or $codigo_producto <> '205003')
										{
												$codigo_c[] = $codigo_categoria . $codigo;		
										}
					}
	$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;     
// recorrer la matriz para ooptener los datos de la tabla detalles de la venta.
for($jj=0;$jj<count($codigo_c);$jj++)
{
 //
 // limipar variables.
   $cantidad_compra = 0; $cantidad_venta = 0; $saldo = 0; $existencia = 0; $calcular_costo_promedio = 0; $cantidad_convertida = 0;
   $cantidad_por = 0; $precio_compra = 0; $costo_promedio = 0; $total_compra =0; $existencia = 0; $codigo_producto = ""; $existencia2 = 0;
   $cantidad_compra2 = 0;
 //
 // CONSULTA LA TABLA INVENTARIO
 //
 $query_i = "SELECT pi.codigo_producto, pi.descripcion, pi.fecha, pi.cantidad, pi.precio, cat_pro.descripcion as nombre_producto
              FROM productos_inventario_inicial pi
              INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_c[$jj]'
              WHERE pi.codigo_producto = '$codigo_c[$jj]' and pi.fecha = '01-01-$year'";
  $result_i = $db_link -> query($query_i);
  
  if($result_i -> rowCount() != 0){
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_i -> fetch(PDO::FETCH_BOTH))
				 {
          $codigo_producto = trim($row_["codigo_producto"]);
          $descripcion = (trim($row_["nombre_producto"]));
          $descripcion_inventario = "Inventario";
          $fecha_compra = trim($row_["fecha"]);
          $cantidad_compra = (int)$row_["cantidad"];
          $cantidad_compra2 = (int)$row_["cantidad"];
          $existencia = (int)$row_["cantidad"];
          $existencia2 = (int)$row_["cantidad"];
          $precio_compra = $row_["precio"];
           //
         // VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
         //
         
   								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_c[$jj]'";
  									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
   									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
    										{
       											$cantidad_convertir = $listado['convertir_cantidad'];
    										}
                  // 	validar la cantidada convertir.
                   if($cantidad_convertir > 0){
                        if($cantidad_compra > 0 || $cantidad_compra < 0){
                            $existencia = $existencia + $cantidad_compra;
                            $total_compra = $cantidad_compra * $precio_compra;
                            $saldo = $saldo + $total_compra;
                             if($existencia > 0){
                               $costo_promedio = $saldo / $existencia;
                             }
                            // Calcular la Existencia.
/*                             $cantidad_convertida = ($cantidad_compra * $cantidad_convertir);
                             $total_compra = ($precio_compra * $cantidad_compra);
                            // Calcular el Nuevo Precio de Compra Convertido.
                             $existencia = $existencia + $cantidad_convertida;
                             $total_compra = $cantidad_compra * $precio_compra;
                             $precio_compra = $total_compra / $cantidad_convertida;
                             $saldo = $saldo + $total_compra;
                             $cantidad_compra = $cantidad_convertida;
                             if($existencia > 0){
                               $costo_promedio = $saldo / $existencia;
                             }*/
                         }
                   }else{
                     if($cantidad_compra > 0 || $cantidad_compra < 0){
                            $existencia = $existencia + $cantidad_compra;
                            $total_compra = $cantidad_compra * $precio_compra;
                            $saldo = $saldo + $total_compra;
                             if($existencia > 0){
                               $costo_promedio = $saldo / $existencia;
                             }
                     }
                   }
                   
                   if($year == 2018){
                     $existencia = $existencia2;
                     $cantidad_compra = $cantidad_compra2;
                   }
                   
          //
          //  GRABAR A LA TABLA INVENTARIO. COMPRAS
          //
          //  Grabar en la tabla inventario.
          $query_inventario = "INSERT INTO inventario (codigo, proveedor_cliente, fecha, fecha_compra, cantidad_compra, descripcion, precio_compra, total_compra, existencia)
                                VALUES ('$codigo_producto','$descripcion_inventario','$fecha_compra','$fecha_compra','$cantidad_compra','$descripcion','$precio_compra','$total_compra','$existencia')";
          $result_inventario = $db_link -> query($query_inventario);
         
      }   //  FIN DEL WHILE DE INVENTARIO INICIAL.
     } // DEL while INVENTARIO
  //
 // CONSULTA LA TABLA INVENTARIO AJUSTE
 //
 $query_i = "SELECT pi.codigo_producto, pi.descripcion, pi.fecha, pi.cantidad, pi.precio, cat_pro.descripcion as nombre_producto
              FROM productos_inventario_ajuste pi
              INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_c[$jj]'
              WHERE pi.codigo_producto = '$codigo_c[$jj]' and extract(year from fecha) = '$year'";
              
  $result_i = $db_link -> query($query_i);
  
  if($result_i -> rowCount() != 0){
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_i -> fetch(PDO::FETCH_BOTH))
				 {
          $codigo_producto = trim($row_["codigo_producto"]);
          $descripcion = (trim($row_["nombre_producto"]));
          $descripcion_inventario = (trim($row_["descripcion"]));
          $fecha_compra = trim($row_["fecha"]);
          $cantidad_compra = (int)$row_["cantidad"];
          $cantidad_compra2 = (int)$row_["cantidad"];
          $existencia = (int)$row_["cantidad"];
          $existencia2 = (int)$row_["cantidad"];
          
          //
          //  GRABAR A LA TABLA INVENTARIO. PRODUCTOS INVENTARIO AJUSTE
          //
          //  Grabar en la tabla inventario.
          $query_inventario = "INSERT INTO inventario (codigo, proveedor_cliente, fecha, fecha_compra, cantidad_compra, descripcion, existencia)
                                VALUES ('$codigo_producto','$descripcion_inventario','$fecha_compra','$fecha_compra','$cantidad_compra','$descripcion','$existencia')";
          $result_inventario = $db_link -> query($query_inventario);
         
      }   //  FIN DEL WHILE de PRODUCTOS INVENTARIO AJUSTE.
     } // DEL WHILE INVENTARIO AJUSTE.
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 // CONSULTA PARA COMPRAS. //////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $query_compra = "SELECT fac_d_c.codigo_producto, fac_d_c.codigo_proveedor, cat_pro.descripcion, fc.fecha, fc.numero_factura, fc.codigo_proveedor, fac_d_c.cantidad,
                  fac_d_c.precio_compra, fac_d_c.cantidad * fac_d_c.precio_compra as total_compra,
                  pro.nombre, pro.nombre_empresa
              FROM facturas_compras fc
              INNER JOIN facturas_detalles_compras fac_d_c ON fac_d_c.numero_factura = fc.numero_factura and fac_d_c.codigo_proveedor = fc.codigo_proveedor
              INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_c[$jj]'
              INNER JOIN proveedores pro ON pro.codigo = fc.codigo_proveedor
              WHERE fac_d_c.codigo_producto = '$codigo_c[$jj]' and fc.fecha >= '01-01-$year' and fc.fecha <= '31-12-$year'
              ORDER BY fc.fecha ASC";
  $result_compra = $db_link -> query($query_compra);
  
  if($result_compra -> rowCount() != 0){
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_compra -> fetch(PDO::FETCH_BOTH))
				 {
          $calcular_costo_promedio++;
          $codigo_producto = trim($row_["codigo_producto"]);
          $descripcion = trim($row_["descripcion"]);
          // datos de la compra.
          $proveedor_cliente = trim($row_["nombre"]) . ' ' . trim($row_["nombre_empresa"]);;
          $fecha_compra = trim($row_["fecha"]);
          $numero_factura = trim($row_["numero_factura"]);
          $cantidad_compra = (int)$row_["cantidad"];
          $precio_compra = trim($row_["precio_compra"]);
          //
         // VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
         //
   								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_c[$jj]'";
  									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
   									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
    										{
       											$cantidad_convertir = $listado['convertir_cantidad'];
    										}
                  // 	validar la cantidada convertir.
                   if($cantidad_convertir > 0){
                        if($cantidad_compra > 0){
                            // Calcular la Existencia.
                             $cantidad_convertida = ($cantidad_compra * $cantidad_convertir);
                             $total_compra = ($precio_compra * $cantidad_compra);
                            // Calcular el Nuevo Precio de Compra Convertido.
                             $existencia = $existencia + $cantidad_convertida;
                             $total_compra = $cantidad_compra * $precio_compra;
                             $precio_compra = $total_compra / $cantidad_convertida;
                             $saldo = $saldo + $total_compra;
                             $cantidad_compra = $cantidad_convertida;
                             if($existencia > 0){
                               $costo_promedio = $saldo / $existencia;
                             }
                         }
                   }else{
                        if($cantidad_compra > 0){                        
                               $existencia = $existencia + $cantidad_compra;
                               $total_compra = $cantidad_compra * $precio_compra;
                               $saldo = $saldo + $total_compra;
                                if($existencia > 0){
                                  $costo_promedio = $saldo / $existencia;
                                }
                        }
                    }
          //
          //  GRABAR A LA TABLA INVENTARIO. COMPRAS
          //
          //  Grabar en la tabla inventario.
          $query_inventario = "INSERT INTO inventario
                                      (codigo, descripcion, fecha, fecha_compra, numero_factura_compra, cantidad_compra, precio_compra, total_compra, proveedor_cliente, costo_promedio)
                                VALUES ('$codigo_producto','$descripcion','$fecha_compra','$fecha_compra','$numero_factura','$cantidad_compra','$precio_compra','$total_compra','$proveedor_cliente','$costo_promedio')";
          $result_inventario = $db_link -> query($query_inventario);
         
      }   //  FIN DEL WHILE DE LA COMPRA.
     } // DEL INF RECCOUNT()
     // VARIABLES A CERO.
     $existencia = 0; $saldo = 0; $total_compra = 0; 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// recorrer la matriz para ooptener los datos de la tabla detalles de la venta.
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $query_venta = "SELECT fac_d_v.codigo_producto, cat_pro.descripcion, fv.fecha, fv.numero_factura, fv.codigo_cliente,
                  fac_d_v.cantidad, fac_d_v.precio_venta, fac_d_v.cantidad * fac_d_v.precio_venta as total_venta, fac_d_v.cantidad_por, fac_d_v.codigo_tipo_factura,
                  fac_d_v.cantidad_por, cli.cliente_empresa
                from facturas_ventas fv
                INNER JOIN facturas_detalles_ventas fac_d_v ON fac_d_v.numero_factura = fv.numero_factura and fac_d_v.codigo_tipo_factura = fv.codigo_tipo_factura
                INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_c[$jj]'
                INNER JOIN clientes cli ON cli.codigo = fv.codigo_cliente
                WHERE fac_d_v.codigo_producto = '$codigo_c[$jj]' and fv.fecha >= '01-01-$year' and fv.fecha <= '31-12-$year' and fac_d_v.numero_factura = fv.numero_factura and fac_d_v.numero_factura_real = fv.numero_factura_real
                ORDER BY fv.fecha ASC";
  $result_venta = $db_link -> query($query_venta);
  $fila_venta = $result_venta -> rowCount();
  //print $fila_venta;
  
  if($result_venta -> rowCount() != 0){
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_venta -> fetch(PDO::FETCH_BOTH))
				 {
          //$proveedor_cliente = trim($row_["nombres"]) . ' '. trim($row_["apellidos"]);
          $proveedor_cliente = trim($row_["cliente_empresa"]);
          $codigo_tipo_factura_venta = trim($row_["codigo_tipo_factura"]);
          // datos de la venta.
          $fecha_venta = trim($row_["fecha"]);
          $numero_factura = trim($row_["numero_factura"]);
          $cantidad_venta = (int)$row_["cantidad"];
          $cantidad_por = trim($row_["cantidad_por"]);
           //
         // VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
         ///
         
   							 $query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_c[$jj]'";
  									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
   									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
    										{
       											$cantidad_convertir = $listado['convertir_cantidad'];
    										}
                  // 	validar la cantidada convertir.
                   if($cantidad_convertir > 0){
                        if($cantidad_venta > 0){
                          // Calcular cuando cantidad por es igual a 1.
                               if($cantidad_por == '1'){
                                  // Calcular la Existencia.
                                   $cantidad_convertida = ($cantidad_venta * $cantidad_convertir);
                                   $total_venta = ($precio_compra * $cantidad_convertida);
                                   $cantidad_venta = $cantidad_convertida;
                               }else{
                                   $total_venta = $cantidad_venta * $precio_compra;                                
                               }
                         }
                   }else{
                     if($cantidad_venta > 0){
                            $existencia = $existencia + $cantidad_venta;
                            $total_venta = $cantidad_venta * $precio_compra;
                            $saldo = $saldo + $total_venta;
                     }
                   }
          //
          //  GRABAR A LA TABLA INVENTARIO. VENTAS
          //
          //  Grabar en la tabla inventario.
          $query_inventario = "INSERT INTO inventario
                                (codigo, descripcion, fecha, fecha_venta, numero_factura_venta, cantidad_venta, proveedor_cliente, codigo_tipo_factura_venta, precio_compra, costo_promedio, total_venta)
                                VALUES
                                ('$codigo_producto','$descripcion','$fecha_venta','$fecha_venta','$numero_factura','$cantidad_venta','$proveedor_cliente','$codigo_tipo_factura_venta','$precio_compra','$costo_promedio', '$total_venta')";
          $result_inventario = $db_link -> query($query_inventario);
      }
     } // if reccount ventas
     // VARIABLES A CERO.
     $existencia = 0; $saldo = 0; $cantidad_venta = 0; $cantidad_compra = 0; $total_venta = 0; $total_compra = 0;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //  ACTUALIZAR PRECIO DE COMPRA.
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $query = "SELECT * FROM inventario WHERE codigo = '$codigo_c[$jj]' ORDER BY fecha, numero_factura_compra, numero_factura_venta";
      $result_ = $db_link -> query($query);
    // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
          // Actualizar existencia y saldo $$$
          $id_ = $row_["id_inventario"];
          $cantidad_compra = (int)$row_["cantidad_compra"];
          $cantidad_venta = (int)$row_["cantidad_venta"];
          $proveedor_cliente = trim($row_["proveedor_cliente"]);
          $existencia = trim($row_["existencia"]);
          
          // SI CANTIDAD COMPRA ES MAYOR DE CERO CAMIBAR EL VALOR DE LA COMPRA.
          if($cantidad_compra > 0){
           if($proveedor_cliente <> "Ajuste de Inventario"){
              $precio_compra = $row_["precio_compra"];  
           }
           
          }else{
           $precio_compra_anterior = $row_["precio_compra"]; 
          }
          
          // SE CALCULA CUANDO ES UNA VENTA. se hace cuando EXISTE UNA COMPRA
          if($cantidad_venta > 0){
               $total_venta = $cantidad_venta * $precio_compra;
           }
          //  Grabar en la tabla inventario.
            $query_actualizar = "UPDATE inventario SET precio_compra = '$precio_compra', total_venta = '$total_venta' WHERE id_inventario = '$id_'";      
            $result_actualizar = $db_link -> query($query_actualizar);
          // variables a cero.
            $total_venta = 0;
				 } // FINAL DE WHILE
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  INVENTARIO AJUSTAR TODOS LOS AJUSTE DE INVENTARIO.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $var_ajuste = "Ajuste de Inventario";
     
     $query = "SELECT * FROM inventario WHERE codigo = '$codigo_c[$jj]' and proveedor_cliente = '$var_ajuste' ORDER BY fecha, numero_factura_compra, numero_factura_venta";
      $result_ = $db_link -> query($query);
      $fila = 0;
     
    // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                  $id_ = $row_["id_inventario"];
             $cantidad_compra = $row_["cantidad_compra"];
             $precio_compra = $row_["precio_compra"];
     

                  $total_compra = $precio_compra * $cantidad_compra;


                            //  Grabar en la tabla inventario.
               $query_actualizar = "UPDATE inventario SET total_compra = $total_compra WHERE id_inventario = '$id_'";
                $result_actualizar = $db_link -> query($query_actualizar);
     }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  ACTUALIZAR EXISTENCIA Y SALDO.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $query = "SELECT * FROM inventario WHERE codigo = '$codigo_c[$jj]' ORDER BY fecha, numero_factura_compra, numero_factura_venta";
      $result_ = $db_link -> query($query);
      $fila = 0; 										$existencia = 0;
    // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
          // Actualizar existencia y saldo $$$

          $fila++;
          $id_ = $row_["id_inventario"];
          $cantidad_compra = (int)$row_["cantidad_compra"];
          $cantidad_venta = (int)$row_["cantidad_venta"];
          $total_venta = $row_["total_venta"];
          $total_compra = $row_["total_compra"];
          $proveedor_cliente = trim($row_["proveedor_cliente"]);
          
          /// MEDIA VEZ SEA DIFERENE DE CERO
          if($cantidad_compra <> 0 or $cantidad_venta <> 0 or $cantidad_compra < 0){
                 // Calcular Existencia.
                   $existencia = $existencia + ($cantidad_compra - $cantidad_venta);
                 // Calcular saldo.
                   $saldo = $saldo + ($total_compra - $total_venta);
                /////////////////////////////////////////////////////////////////////////////////////////// 
                ///////////////////////////////////////////////////////////////////////////////////////////
                 if($proveedor_cliente <> "Ajuste de Inventario"){
                     // Calcular Costo Promedio.
                         if($cantidad_compra > 0){
                              if($existencia > 0){
                                 $costo_promedio = $saldo / $existencia; 
                              }
                         }
                 }
                
                 // Calcular Saldo en el caso que la existencia es igual a 0.
                   if($cantidad_compra > 0){
                        if($existencia == 0){
                           $saldo =0.0000; 
                        }
                   }
          }
          
          // Cuando el Ajuste de Inventario es igual a cero.
                  if($cantidad_compra == 0){
                   $total_compra = 0;
                  }

          if($cantidad_compra <= 0){
           $query_actualizar = "UPDATE inventario SET numero_registros = '$fila', existencia = '$existencia', saldo = '$saldo', costo_promedio = '$costo_promedio', total_compra = '$total_compra' WHERE id_inventario = '$id_'";
          }else{
            $query_actualizar = "UPDATE inventario SET numero_registros = '$fila', existencia = '$existencia', saldo = '$saldo', costo_promedio = '$costo_promedio' WHERE id_inventario = '$id_'";
          }
            $result_actualizar = $db_link -> query($query_actualizar);
				 }
      // VARIABLES A CERO.
         $existencia = 0; $saldo = 0; $costo_promedio = 0;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  INVENTARIO INICIAL PARA EL PROXIMO AÑO.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $query = "SELECT * FROM inventario WHERE codigo = '$codigo_c[$jj]' and fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
               ORDER BY numero_registros DESC LIMIT 1 ";
      $result_ = $db_link -> query($query);
      $year_inventario_inicial = $year + 1;
      $fecha_inventario_inicial = '01-01-'.$year_inventario_inicial;
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
           $descripcion = (trim($row_["descripcion"]));
           $descripcion_inventario = "Inventario";
           $codigo_producto = trim($row_["codigo"]);
           $precio = trim($row_["precio_compra"]);
           $cantidad = trim($row_["existencia"]);
           $saldo = trim($row_["saldo"]);
           // Query para buscar el registro si existe para guardarlo o insertarlo.
           $query_buscar_i = "SELECT * FROM productos_inventario_inicial WHERE codigo_producto = '$codigo_c[$jj]' and fecha = '$fecha_inventario_inicial'";
            $result_buscar_i = $db_link -> query($query_buscar_i);
            $fila_i = $result_buscar_i -> rowCount();

             if($fila_i == 0){
                // GUARDAR
                $query_guardar_i = "INSERT INTO productos_inventario_inicial (fecha, codigo_producto, descripcion, cantidad, precio) VALUES ('$fecha_inventario_inicial','$codigo_producto','$descripcion_inventario','$cantidad','$precio')";
                 $result_guardar_i = $db_link -> query($query_guardar_i);
             }else{
                $query_actualizar_i = "UPDATE productos_inventario_inicial SET cantidad = '$cantidad', precio = '$precio' WHERE codigo_producto = '$codigo_c[$jj]' and fecha = '$fecha_inventario_inicial'";
                 $result_actualizar_i = $db_link -> query($query_actualizar_i);
             }
         //
         // ACTUALIZAR EXISTENCIA EN EL CATALOGO PRODUCTOS.
         //
         if($año == $year)
         {
             $query_actualizar_cat = "UPDATE catalogo_productos SET existencia = {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_c[$jj]'";
             $result_actualizar_cat = $db_link -> query($query_actualizar_cat);
//             print $cantidad . '-Saldo: '.$saldo;
         }
          
				 }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  presentar en el informe.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // variables para la palabra inventario.
      $query = "SELECT * FROM inventario WHERE codigo = '$codigo_c[$jj]' and fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
               ORDER BY fecha, numero_factura_compra, numero_factura_venta ";
      $result_ = $db_link -> query($query);
    // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
          // Compras
          $codigo_producto = trim($row_["codigo"]);
          $descripcion = trim($row_["descripcion"]);
          $proveedor_cliente = substr(utf8_decode(trim($row_["proveedor_cliente"])),0,35);
					
          // datos de la compra.
          $fecha_compra = ($row_["fecha_compra"]);
          $numero_factura_compra = trim($row_["numero_factura_compra"]);
          $cantidad_compra = (int)$row_["cantidad_compra"];
          $precio_compra = trim($row_["precio_compra"]);
          $total_compra = trim($row_["total_compra"]);
          
          // NO TOMAR EN CUENTA EL AJUSTE para obtner el valor total de la compra
          if($proveedor_cliente <> "Ajuste de Inventario")
          {
           // Calculos para la Compra
              $t_total_cantidad_compra = $t_total_cantidad_compra + $cantidad_compra;
              $t_total_compra = $t_total_compra + $total_compra; 
          }
          
          
                   
          // Ventas
           $codigo_producto = trim($row_["codigo"]);
           $descripcion = trim($row_["descripcion"]);
          // datos de la venta.
          $codigo_tipo_factura_venta = trim($row_["codigo_tipo_factura_venta"]);
          $costo_promedio = trim($row_["costo_promedio"]);
          $fecha_venta = ($row_["fecha_venta"]);
          $numero_factura_venta = trim($row_["numero_factura_venta"]);
          $cantidad_venta = (int)$row_["cantidad_venta"];
          $precio_venta = trim($row_["precio_venta"]);
          $total_venta = trim($row_["total_venta"]);
          
          // NO TOMAR EN CUENTA EL AJUSTE para obtner el valor total de la venta
          if($proveedor_cliente <> "Ajuste de Inventario")
          {
            // Calculos para la Venta
               $t_total_cantidad_venta = $t_total_cantidad_venta + $cantidad_venta;
               $t_total_venta = $t_total_venta + $total_venta;
          }
          
          // Calculo para la existencia
          $existencia = trim($row_["existencia"]);
          $saldo = trim($row_["saldo"]);
          
          // Presentar en Pantalla.
					$num++; $salto++;
					$pdf->SetX(5);
          $pdf->SetFont('Times','','7');
          if($num === 1){
            $pdf->SetFont('Times','B','9');
            $pdf->RotatedText(55,22,utf8_decode($descripcion),0);
            $pdf->RotatedText(185,22,($codigo_producto),0);
            $pdf->SetFont('Times','','7');
          }
          //// numero correlativo.
           $pdf->Cell($ancho[0],$alto[0],$num,0,0,'C',$fill);
          // CUANDO LOS DATOS PROVIENEN DEL INVENTARIO INICIAL. TOMAR EN CUENTA EN LA DESCRIPCION PROVEEDOR_CLIENTE
          if($existencia == 0){
            if($proveedor_cliente == "Ajuste de Inventario" Or $proveedor_cliente == "Inventario"){
                $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_compra),0,0,'C',$fill);
                  if(empty($codigo_tipo_factura_venta)){
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }else{
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }
            }
          }

          if($existencia > 0){
            if($proveedor_cliente == "Ajuste de Inventario" Or $proveedor_cliente == "Inventario"){
                $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_compra),0,0,'C',$fill);
                  if(empty($codigo_tipo_factura_venta)){
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }else{
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }
            }
          }

         // Cuando la existencia es menor
          if($existencia < 0){
            if($proveedor_cliente == "Ajuste de Inventario" Or $proveedor_cliente == "Inventario"){
                $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_compra),0,0,'C',$fill);
                  if(empty($codigo_tipo_factura_venta)){
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }else{
                   $pdf->Cell($ancho[2],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
                   $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
                  }
            }
          }
         
          ///
          /// VALOR DE LA COMPRA EN CANTIDAD
          ///
          if($cantidad_compra > 0 && $proveedor_cliente <> "Inventario" && $proveedor_cliente <> "Ajuste de Inventario"){
           $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_compra),0,0,'C',$fill);
             if(empty($codigo_tipo_factura_venta)){
              $pdf->Cell($ancho[2],$alto[0],utf8_decode('CCF. N°').($numero_factura_compra),0,0,'C',$fill);
              $pdf->Cell($ancho[3],$alto[0],'X',0,0,'C',$fill);
              $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
             }else{
              $pdf->Cell($ancho[2],$alto[0],utf8_decode('CCF. N°').($numero_factura_compra),0,0,'C',$fill);
              $pdf->Cell($ancho[3],$alto[0],'X',0,0,'C',$fill);
              $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
             }
          }
       /*   
           if($cantidad_compra == 0 && $proveedor_cliente <> "Inventario" && $proveedor_cliente <> "Ajuste de Inventario"){
           $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_compra),0,0,'C',$fill);
             if(empty($codigo_tipo_factura_venta)){
              $pdf->Cell($ancho[2],$alto[0],utf8_decode('CCF. N°').($numero_factura_compra),0,0,'C',$fill);
              $pdf->Cell($ancho[3],$alto[0],'X',0,0,'C',$fill);
              $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
             }else{
              $pdf->Cell($ancho[2],$alto[0],utf8_decode('CCF. N°').($numero_factura_compra),0,0,'C',$fill);
              $pdf->Cell($ancho[3],$alto[0],'X',0,0,'C',$fill);
              $pdf->Cell($ancho[4],$alto[0],'',0,0,'C',$fill);              
             }
          }
          
          */
          
          if($cantidad_venta > 0){
           $pdf->Cell($ancho[1],$alto[0],cambiaf_a_normal($fecha_venta),0,0,'C',$fill);
           if($codigo_tipo_factura_venta == '01'){
             $pdf->Cell($ancho[2],$alto[0],'FAC.'.($numero_factura_venta),0,0,'C',$fill); 
           }
           if($codigo_tipo_factura_venta == '02'){
             $pdf->Cell($ancho[2],$alto[0],'CCF.'.($numero_factura_venta),0,0,'C',$fill); 
           }           
           $pdf->Cell($ancho[3],$alto[0],'',0,0,'C',$fill);
           $pdf->Cell($ancho[4],$alto[0],'X',0,0,'C',$fill);
          }          
          
          $pdf->Cell($ancho[5],$alto[0],$proveedor_cliente,0,0,'L',$fill);
          $pdf->Cell($ancho[6],$alto[0],$costo_promedio,0,0,'C',$fill);        
          // COSTO UNITARIO
           if($cantidad_compra == 0 && $proveedor_cliente === "Ajuste de Inventario"){
              $pdf->Cell($ancho[7],$alto[0],($precio_compra),0,0,'R',$fill);  
            }
          if($cantidad_compra > 0 || $cantidad_compra < 0){
             $pdf->Cell($ancho[7],$alto[0],($precio_compra),0,0,'R',$fill);
          }
          
          if($cantidad_venta > 0){
          $pdf->Cell($ancho[7],$alto[0],($precio_compra),0,0,'R',$fill);
          }
          // UNIDADES - ENTRADA - SALIDA - SALDO
          if($cantidad_compra == 0){$pdf->Cell($ancho[8],$alto[0],'',0,0,'C',$fill);}else{$pdf->Cell($ancho[8],$alto[0],($cantidad_compra),0,0,'C',$fill);}
          if($cantidad_venta == 0){$pdf->Cell($ancho[9],$alto[0],'',0,0,'C',$fill);}else{$pdf->Cell($ancho[9],$alto[0],($cantidad_venta),0,0,'C',$fill);}
          $pdf->Cell($ancho[10],$alto[0],($existencia),0,0,'R',$fill);

          if($total_compra == 0){$pdf->Cell($ancho[11],$alto[0],'',0,0,'R',$fill);}else{$pdf->Cell($ancho[11],$alto[0],($total_compra),0,0,'R',$fill);}        
          if($total_venta == 0){$pdf->Cell($ancho[12],$alto[0],'',0,0,'R',$fill);}else{$pdf->Cell($ancho[12],$alto[0],($total_venta),0,0,'R',$fill);}
          $pdf->Cell($ancho[13],$alto[0],$saldo,0,1,'C',$fill);
          
          //$pdf->Cell($ancho[13],$alto[0],($saldo),0,1,'R',$fill);
					
          $y = $y+15;
          
					$fill=!$fill;
        if($salto == $fila_salto){
         $pdf->AddPage();
         $num=0;
         $y = $pdf->GetY();
         $salto =0; $num=0; $existencia = 0; $saldo = 0;
//         $pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
         $pdf->SetFont('Times','','7');
        }
				 }
         
         //
         // imprimir consolidados.
         // COMPRAS
         if($t_total_cantidad_compra > 0 || $t_total_cantidad_venta > 0)
         {
          // Acumular el Total del Mes o Período Seleccionado.
          $total_general_cantidad_compra = $total_general_cantidad_compra + $t_total_cantidad_compra;
          $total_general_precio_compra = $total_general_precio_compra + $t_total_compra;
           //venta.
           $total_general_cantidad_venta = $total_general_cantidad_venta + $t_total_cantidad_venta;
           //
           // TOMAR EN CUENTA EL TOTAL VENTA CUANDO LA EXISTENCIA SEA DIFERENCIA DE 0
           //
            //if($existencia >= 0){
              $total_general_precio_venta = $total_general_precio_venta + $t_total_venta;   
            //}
          
          // retornar variables a 0, existencia, saldo, total compras, total ventas, etc.
          $t_total_cantidad_compra = 0; $t_total_compra = 0;
          $t_total_cantidad_venta = 0; $t_total_venta = 0;
          $existencia = 0;
          $saldo = 0;
          $cantidad_compra = 0; $cantidad_venta =0;
          $total_venta = 0; $total_compra = 0;
         }
         //
         // Salto de Pàgina para OTRO PRODUCTO.
         //
         if($result_ -> rowCount() >0)
         {
          $pdf->AddPage();
          $pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
          $salto =0; $num=0; $existencia = 0; $saldo = 0;
          }
              // die();
} // FIN DEL FOR.

//
// imprimir el total general según el mes o período seleccionado.
///*
$saldo_ = 0;
          $pdf->Cell($ancho[0],$alto[0],'',0,0,'C',$fill);
          $pdf->Cell($ancho[1],$alto[0],'',0,0,'C',$fill);
          $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
          $pdf->Cell($ancho[3],$alto[0],'','',0,'R',$fill);
          $pdf->Cell($ancho[4],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[5],$alto[0],'','',0,'R',$fill);
          $pdf->Cell($ancho[6],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[7],$alto[0],'','',0,'R',$fill);
          $pdf->Cell($ancho[8],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[9],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[10],$alto[0],'','',0,'R',$fill);
          $pdf->Cell($ancho[11],$alto[0],number_format($total_general_precio_compra,2),'TB',0,'R',$fill);
          $pdf->Cell($ancho[12],$alto[0],number_format($total_general_precio_venta,2),'TB',0,'R',$fill);
          $saldo_ = $total_general_precio_compra - $total_general_precio_venta;
          $pdf->Cell($ancho[13],$alto[0],number_format($saldo_,2),'TB',1,'R',$fill);
          
// Salida del pdf.
    $pdf->Output();
?>