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
$mes_periodo_p = 3;

	$printer = 0;
    $db_link = $dblink;
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];
    $nombre_mes = "";
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
    //$nombre_mes = $meses[$nombre_mes];     // El Mes.		
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
 global $fecha_inicio, $fecha_fin, $codigo, $descripcion, $codigo_c, $nombre_mes, $mes, $year;
	// Encabezado
	$this->SetFont('Comic','','10');
 $this->Cell(100,4.5,utf8_decode('Contribuyente: Gladis Marisol López de Guardado'),0,1,'L');
	$this->Cell(120,4.5,'Nombre Comercial: LIBRERIA Y PAPELERIA PRIMAVERA',0,0,'L');
 $this->SetFont('Comic','','8');
 $this->Cell(40,4.5,'N.I.T.: 0210-180684-103-8',0,0,'L');
 $this->Cell(40,4.5,'N.R.C.: 241910-3',0,1,'L');
 $this->Cell(40,4.5,utf8_decode('CONSOLIDADO DEL INVENTARIO'),0,1,'L');
 $this->Cell(50,4.5,'MES: '.strtoupper($mes),0,0,'L');
 $this->Cell(100,4,'PERIODO DEL ' . cambiaf_a_normal($fecha_inicio) . ' AL ' . cambiaf_a_normal($fecha_fin),0,1,'L');
// Encabezado
	//$this->SetFont('Comic','','14');
	//$this->Cell(210,6,'Inventario del '.cambiaf_a_normal($fecha_inicio).' al '.cambiaf_a_normal($fecha_fin),0,1,'C');
	// Encabezado
	$this->SetFont('Comic','','10');
	$this->SetY(25);
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
		$ancho=array(10,20,90,15,25,25); //determina el ancho de las columnas
    // armar el encabezado COMPRAS.
      $this->Cell($ancho[0],6,'','LRT','C',1);
      $this->Cell($ancho[1],6,'','LRT','C',1);
      $this->Cell($ancho[2],6,'','LRT','C',1);
      $this->Cell($ancho[3],6,'Costo','LRT',0,'C',1);
      $this->Cell(25,6,'UNIDADES',1,0,'C',1);
      $this->Cell(25,6,'VALORES',1,1,'C',1);
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
    $pdf=new PDF('P','mm','Letter');	//  Carta.
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
		$header=array('N°','Código','Descripción','Promedio','Existencia','Saldo $');
		$alto=array(6); //determina el ancho de las columnas
		$ancho=array(10,20,90,15,25,25); //determina el ancho de las columnas
/////////////////////////////////////////////////////////////////////////////////////////
	//$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;
//	Consulta tabla Tipo de Factura.
	$query_ = "SELECT codigo_categoria, codigo, descripcion, existencia FROM catalogo_productos
            GROUP BY codigo_categoria, codigo, descripcion, existencia ORDER BY codigo_categoria, codigo";
	$result_ = $db_link -> query($query_);
	$num = 0; $salto = 0; $existencia = 0; $saldo = 0;
 $t_total_compra = 0; $t_total_cantidad_compra = 0;
 $t_total_venta = 0; $t_total_cantidad_venta = 0;
 $total_general_cantidad_compra = 0; $total_general_precio_compra = 0;
 $total_general_cantidad_venta = 0; $total_general_precio_venta = 0;
 $total_general_saldo = 0;
 $fila_salto = 39;
  // crear matriz para el codigo del producto.
  $codigo_categoria_array = array(); $codigo_array = array(); $codigo_c = array();
  $y = $pdf->GetY();
        // LIMPIAR TABLA
          $query_limpiar = "DELETE FROM inventario_por_producto";
          $result_limpiar = $db_link -> query($query_limpiar);
			 // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
					$codigo_categoria = trim($row_["codigo_categoria"]);
					$codigo = trim($row_["codigo"]);
          //  llenar la matriz.
         $codigo_c[] = $codigo_categoria . $codigo;
					}
	$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;     
// recorrer la matriz para ooptener los datos de la tabla detalles de la venta.
for($jj=0;$jj<count($codigo_c);$jj++)
{
 //
 // limipar variables.
   $cantidad_compra = 0; $cantidad_venta = 0; $saldo = 0; $existencia = 0; $calcular_costo_promedio = 0; $cantidad_convertida = 0;
   $cantidad_por = 0; $precio_compra = 0; $costo_promedio = 0; $total_compra =0;
 //
 // CONSULTA PARA COMPRAS.
 //
 $query_compra = "SELECT fac_d_c.codigo_producto, cat_pro.descripcion, fc.fecha, fc.numero_factura, fc.codigo_proveedor, fac_d_c.cantidad,
                  fac_d_c.precio_compra, fac_d_c.cantidad * fac_d_c.precio_compra as total_compra,
                  pro.nombre, pro.nombre_empresa
              FROM facturas_compras fc
              INNER JOIN facturas_detalles_compras fac_d_c ON fac_d_c.numero_factura = fc.numero_factura and fac_d_c.codigo_proveedor = fc.codigo_proveedor
              INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_c[$jj]'
              INNER JOIN proveedores pro ON pro.codigo = fc.codigo_proveedor
              WHERE fac_d_c.codigo_producto = '$codigo_c[$jj]' and fc.fecha >= '01-01-$year' and fc.fecha <= '31-12-$year'
              ORDER BY fc.fecha ASC";
  $result_compra = $db_link -> query($query_compra);

			 // Extraer valore de la consulta.
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
          $query_inventario = "INSERT INTO inventario_por_producto
                                      (codigo, descripcion, fecha, fecha_compra, numero_factura_compra, cantidad_compra, precio_compra, total_compra, proveedor_cliente, costo_promedio)
                                VALUES ('$codigo_producto','$descripcion','$fecha_compra','$fecha_compra','$numero_factura','$cantidad_compra','$precio_compra','$total_compra','$proveedor_cliente','$costo_promedio')";
          $result_inventario = $db_link -> query($query_inventario);
         
				 }   //  FIN DEL WHILE DE LA COMPRA.
     // VARIABLES A CERO.
     $existencia = 0; $saldo = 0;
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
         //
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
          $query_inventario = "INSERT INTO inventario_por_producto
                                (codigo, descripcion, fecha, fecha_venta, numero_factura_venta, cantidad_venta, proveedor_cliente, codigo_tipo_factura_venta, precio_compra, costo_promedio, total_venta)
                                VALUES
                                ('$codigo_producto','$descripcion','$fecha_venta','$fecha_venta','$numero_factura','$cantidad_venta','$proveedor_cliente','$codigo_tipo_factura_venta','$precio_compra','$costo_promedio', '$total_venta')";
          $result_inventario = $db_link -> query($query_inventario);
				 }
     // VARIABLES A CERO.
     $existencia = 0; $saldo = 0; $cantidad_venta = 0; $cantidad_compra = 0; $total_venta = 0; $total_compra = 0;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //  ACTUALIZAR PRECIO DE COMPRA.
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $query = "SELECT * FROM inventario_por_producto WHERE codigo = '$codigo_c[$jj]' ORDER BY fecha, numero_factura_compra, numero_factura_venta";
      $result_ = $db_link -> query($query);
    // Extraer saldoe de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
          // Actualizar existencia y saldo $$$
          $id_ = $row_["id_inventario"];
          $cantidad_compra = (int)$row_["cantidad_compra"];
          $cantidad_venta = (int)$row_["cantidad_venta"];
          // calcular el precio de compra.
          if($cantidad_compra > 0){
             $precio_compra = $row_["precio_compra"];
           }
          if($cantidad_venta > 0){
             $total_venta = $cantidad_venta * $precio_compra;
           }          
          //  Grabar en la tabla inventario.
            $query_actualizar = "UPDATE inventario_por_producto SET precio_compra = '$precio_compra', total_venta = '$total_venta' WHERE id_inventario = '$id_'";      
            $result_actualizar = $db_link -> query($query_actualizar);
          // variables a cero.
            $total_venta = 0;
				 }     
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //  ACTUALIZAR EXISTENCIA Y SALDO.
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $query = "SELECT * FROM inventario_por_producto WHERE codigo = '$codigo_c[$jj]' ORDER BY fecha, numero_factura_compra, numero_factura_venta";
      $result_ = $db_link -> query($query);
    // Extraer saldoe de la consulta.
      $fila = 0;
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
          // Actualizar existencia y saldo $$$
          $fila++;
          $id_ = $row_["id_inventario"];
          $cantidad_compra = (int)$row_["cantidad_compra"];
          $cantidad_venta = (int)$row_["cantidad_venta"];
          $total_venta = $row_["total_venta"];
          $total_compra = $row_["total_compra"];
          // Calcular Existencia.
            $existencia = $existencia + ($cantidad_compra - $cantidad_venta);
          // Calcular saldo.
            $saldo = $saldo + ($total_compra - $total_venta);
          // Calcular Costo Promedio.
            if($existencia > 0){
               $costo_promedio = $saldo / $existencia; 
            }
            
          //  Grabar en la tabla inventario.
            $query_actualizar = "UPDATE inventario_por_producto SET numero_registros = '$fila', existencia = '$existencia', saldo = '$saldo', costo_promedio = '$costo_promedio' WHERE id_inventario = '$id_'";      
            $result_actualizar = $db_link -> query($query_actualizar);
     }
       // Actualizar existencia del catalogo productos.
           if($fecha_fin == $year.'-12-31'){
             $query_actualizar_cat = "UPDATE catalogo_productos SET existencia = '$existencia' WHERE  = '$codigo_c[$jj]'";
             $result_actualizar_cat = $db_link -> query($query_actualizar_cat);
            }
      // VARIABLES A CERO.
         $existencia = 0; $saldo = 0; $fila = 0; $costo_promedio = 0;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  presentar en el informe.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $query = "SELECT * FROM inventario_por_producto WHERE codigo = '$codigo_c[$jj]' and fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
               ORDER BY numero_registros DESC LIMIT 1 ";
      $result_ = $db_link -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
           $codigo_producto = trim($row_["codigo"]);
           $descripcion = utf8_decode(trim($row_["descripcion"]));
           $proveedor_cliente = substr(utf8_decode(trim($row_["proveedor_cliente"])),0,30);
           $codigo_producto = trim($row_["codigo"]);
           $descripcion = trim($row_["descripcion"]);
           $costo_promedio = trim($row_["costo_promedio"]);
           $existencia = trim($row_["existencia"]);
           $saldo = trim($row_["saldo"]);
              //if($existencia < 0){
                     $total_general_saldo = $total_general_saldo + $saldo;
                     // Presentar en Pantalla.
                     $num++; $salto++;
                     $pdf->SetX(5);
                     $pdf->SetFont('Times','','9');
                     $pdf->Cell($ancho[0],$alto[0],$num,0,0,'L',$fill);
                     $pdf->Cell($ancho[1],$alto[0],substr($codigo_producto,0,35),0,0,'C',$fill);
                     $pdf->Cell($ancho[2],$alto[0],utf8_decode($descripcion),0,0,'L',$fill);
                     $pdf->Cell($ancho[3],$alto[0],$costo_promedio,0,0,'C',$fill);        
                     $pdf->Cell($ancho[4],$alto[0],($existencia),0,0,'C',$fill);
                     $pdf->Cell($ancho[5],$alto[0],number_format($saldo,2,'.',','),0,1,'R',$fill);          
              //}					
          $y = $y+15;
          $fill=!$fill;
             if($salto == $fila_salto){
              $pdf->AddPage();
              $y = $pdf->GetY();
              $salto =0; $existencia = 0; $saldo = 0;
              $pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
              $pdf->SetFont('Times','','7');
             }
				 }
         //
         // Salto de Pàgina para OTRO PRODUCTO.
         //
} // FIN DEL FOR.
///
// imprimir el total general según el mes o período seleccionado.
///*
         $pdf->SetFont('Times','','10');
          $pdf->Cell($ancho[0],$alto[0],'',0,0,'C',$fill);
          $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
          $pdf->Cell($ancho[2],$alto[0],'','',0,'R',$fill);
          $pdf->Cell($ancho[3],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[4],$alto[0],'',0,0,'R',$fill);
          $pdf->Cell($ancho[5],$alto[0],'$' . number_format($total_general_saldo,2),'TB',1,'R',$fill);       
// Salida del pdf.
    $pdf->Output('I');
?>