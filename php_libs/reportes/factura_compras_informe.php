<?php
sleep(1);
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
    include($path_root."/sistema_facturacion/includes/consultas.php");
    include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
    include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");
// Llamar a la libreria fpdf
    include($path_root."/sistema_facturacion/php_libs/fpdf/fpdf.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
  $numero_factura = $_REQUEST['numero_factura'];
  $codigo_proveedor = $_REQUEST['codigo_proveedor'];
  $db_link = $dblink; $num=0; $total_compra = 0; $i = 0; $fill = false; $iva = 0; $subtotal = 0; $total_exentas = 0; $total = 0;
  $precio_unitario_exento =0; $precio_unitario_gravado = 0; $cantidadxcompra =0;
				
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

function RotatedTextMultiCellAspectos($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
  $this->MultiCell(95,4,$txt,0,'L');
	$this->Rotate(0);
}

//Cabecera de página
function Header()
{
}

//Pie de página
function Footer()
{   
}

//Tabla coloreada
function FancyTable($header)
{
    //Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Comic','');
    //Cabecera
		$alto=array(5.8,12,5.5); //determina el ancho de las columnas
		$ancho=array(6,15,80,20,20,20,20,20,150); //determina el ancho de las columnas
    for($i=0;$i<count($header);$i++)
        $this->Cell($ancho[$i],7,utf8_decode($header[$i]),1,0,'C',1);
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
    $pdf=new PDF('P','mm','Letter');	// Formato Tamaño Carta.
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
    $pdf->SetXY(10,15);
/////////////////////////////////////////////////////////////////////////////////////////
// configuración de colores par ala linea
    $pdf->SetDrawcolor(0,0,0);
    $pdf->SetFont('Comic','',10);
    $header=array('Nº','Código','Descripción','Cantidad','P/G','P/E','P/T');
/////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//  INICIO PARA MOSTRAR LOS DATOS DE LA TABLA.
//	Recorrer la tabla en donde se encuentra el nombre del encargado.
		$alto=array(5.8,12,5.5); //determina el ancho de las columnas
		$ancho=array(6,15,80,20,20,20,20,20,150); //determina el ancho de las columnas
// Armar Consulta para Recorrer la factura.
		$query_factura= "SELECT  fac_d_c.codigo_producto, cat_pro.descripcion, fc.fecha, fc.numero_factura, fc.codigo_proveedor, fc.id_compras, fac_d_c.cantidad, fc.codigo_tipo_factura,
                            fac_d_c.precio_compra, fac_d_c.cantidad * fac_d_c.precio_compra as total_compra, fac_d_c.id_detalle, cat_pro.producto_exento,
                            CONCAT(pro.nombre,' ',pro.nombre_empresa) as nombre_completo
                            FROM facturas_compras fc
                            INNER JOIN facturas_detalles_compras fac_d_c ON fac_d_c.numero_factura = fc.numero_factura and fac_d_c.codigo_proveedor = fc.codigo_proveedor
                            INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = fac_d_c.codigo_producto
                            INNER JOIN proveedores pro ON pro.codigo = fc.codigo_proveedor
                            WHERE fc.numero_factura = $numero_factura and fac_d_c.numero_factura = $numero_factura and fc.codigo_proveedor = '$codigo_proveedor' and fac_d_c.codigo_proveedor = '$codigo_proveedor'
                                ORDER BY fac_d_c.id_detalle ASC";
		$resultado_factura = $db_link -> query($query_factura);
//	Recorrer la tabla en donde se encuentra la información del DETALLE DE LA FACTURA TEMP.
        if($resultado_factura -> rowCount() != 0){
					while($listado = $resultado_factura -> fetch(PDO::FETCH_BOTH))
					{
              $num++;
              $id_detalle = $listado['id_detalle'];
              $numero_factura = $listado['numero_factura'];
              $codigo_producto = $listado['codigo_producto'];
              $descripcion = utf8_decode($listado['descripcion']);
              $cantidad = $listado['cantidad'];
              $precio_compra = $listado['precio_compra'];
              $codigo_proveedor = utf8_decode($listado['codigo_proveedor']);
              $codigo_tipo_factura = $listado['codigo_tipo_factura'];
              $nombre_proveedor = utf8_decode(trim($listado['nombre_completo']));
              $fecha = cambiaf_a_normal($listado['fecha']);
              $producto_exento = $listado['producto_exento'];
                        // Calcular el iva si el producto es exento o no
                        if($producto_exento == "01"){
                                $producto_exento = "Si";
                                $precio_unitario_exento = $precio_compra;
                                $total_exentas = $total_exentas + (($cantidad * $precio_compra));
                                $total_compra = $total_compra + (($cantidad * $precio_compra));
                                $cantidadxcompra = (($cantidad * $precio_compra));
                        }
                        if($producto_exento == "02"){
                                $producto_exento = "No";
                                $precio_unitario_gravado = $precio_compra;
                                $total_compra = $total_compra + (($cantidad * $precio_compra));
                                $cantidadxcompra = (($cantidad * $precio_unitario_gravado));
                            }
            //	IMPRIMIR DATOS.
          		if($i == 0)
                {
                    $pdf->Cell($ancho[8],$alto[0],'Proveedor: '.$nombre_proveedor,0,0,'L');
                    $pdf->Cell($ancho[4],$alto[0],'Fecha: '.$fecha,0,1,'L');
                    $pdf->Cell($ancho[4],$alto[0],utf8_decode('Número de Factura: ').$numero_factura,0,1,'L');
                    
                    $pdf->FancyTable($header);    
                    $pdf->SetFont('Comic','',8);
                    $pdf->Cell($ancho[0],$alto[0],$num,0,0,'L',$fill);
                    $pdf->Cell($ancho[1],$alto[0],$codigo_producto,0,0,'L',$fill);
                    $pdf->Cell($ancho[2],$alto[0],$descripcion,0,0,'L',$fill);
                    $pdf->Cell($ancho[3],$alto[0],$cantidad,0,0,'C',$fill);
                    
                    if($producto_exento == "Si"){
                      $pdf->Cell($ancho[4],$alto[0],'',0,0,'R',$fill);
                      $pdf->Cell($ancho[5],$alto[0],$precio_unitario_exento,0,0,'R',$fill);
                    }
                    else{
                      $pdf->Cell($ancho[4],$alto[0],$precio_unitario_gravado,0,0,'R',$fill);
                      $pdf->Cell($ancho[5],$alto[0],'',0,0,'R',$fill);
                    }
                    
                    $pdf->Cell($ancho[6],$alto[0],$cantidadxcompra,0,1,'R',$fill);
                }
              if($i >= 1){
                $pdf->SetFont('Comic','',8);
                $pdf->Cell($ancho[0],$alto[0],$num,0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],$codigo_producto,0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],$descripcion,0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],$cantidad,0,0,'C',$fill);
                    
                    if($producto_exento == 'Si'){
                      $pdf->Cell($ancho[4],$alto[0],'',0,0,'R',$fill);
                      $pdf->Cell($ancho[5],$alto[0],$precio_unitario_exento,0,0,'R',$fill);
                    }
                    else{
                      $pdf->Cell($ancho[4],$alto[0],$precio_unitario_gravado,0,0,'R',$fill);
                      $pdf->Cell($ancho[5],$alto[0],'',0,0,'R',$fill);
                    }
                    
                  $pdf->Cell($ancho[6],$alto[0],$cantidadxcompra,0,1,'R',$fill);
              }
					// aumentar el varlo de $I
    					$i++; $fill=!$fill;
					}
          // SUMAS
            $pdf->Ln();
                $pdf->Cell($ancho[0],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],'SUMAS',0,0,'L',$fill);
                $pdf->Cell($ancho[4],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[5],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[6],$alto[0],$total_compra,0,1,'R',$fill);
                // CALCULAR IVA
                if($producto_exento == "No")
                {
                  $iva = number_format(round($total_compra * 0.13,4),4);  
                }
                
                $pdf->Cell($ancho[0],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[4],$alto[0],'IVA',0,0,'R',$fill);
                $pdf->Cell($ancho[5],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[6],$alto[0],$iva,0,1,'R',$fill);
                // CALCULAR SUBTOTAL
                if($producto_exento == "No")
                {
                  $subtotal = number_format(round($total_compra + $iva,4),4);
                }
                $pdf->Cell($ancho[0],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[4],$alto[0],'Sub-Total',0,0,'R',$fill);
                $pdf->Cell($ancho[5],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[6],$alto[0],$subtotal,0,1,'R',$fill);
                // CALCULAR compras exentas
                $pdf->Cell($ancho[0],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[4],$alto[0],'Exentas',0,0,'R',$fill);
                $pdf->Cell($ancho[5],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[6],$alto[0],$total_exentas,0,1,'R',$fill);
                // CALCULAR OTAL
                $total = number_format(round($subtotal+$total_exentas,2),2);
                $pdf->Cell($ancho[0],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[1],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[2],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[3],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[4],$alto[0],'Total',0,0,'R',$fill);
                $pdf->Cell($ancho[5],$alto[0],'',0,0,'L',$fill);
                $pdf->Cell($ancho[6],$alto[0],$total,0,1,'R',$fill);
				}
				else{
          $pdf->Cell($ancho[0],$alto[0],"NO SE ENCONTRARON REGISTROS...",0,0,'L');
				}
// Salida del pdf.
    $pdf->Output('I');
?>