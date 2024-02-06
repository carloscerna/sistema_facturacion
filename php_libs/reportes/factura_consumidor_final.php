<?php
sleep(1);
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
    include($path_root."/sistema_facturacion/includes/consultas.php");
    include($path_root."/sistema_facturacion/includes/detectar_so.php");
//	include($path_root."/sistema_facturacion/includes/DeNumero_a_Letras.php");
	include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
	include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");

// Llamar a la libreria fpdf
    include($path_root."/sistema_facturacion/php_libs/fpdf/fpdf.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
// variables y consulta a la tabla.
$print_no_fecha = 0;
if(isset($_REQUEST['no_fecha']))
{
  $no_fecha =  $_REQUEST['no_fecha'];
  if($no_fecha == 1){
    $print_no_fecha = 1;
  }
}  
	if(isset($_REQUEST['cambiar_fecha'])){$cambiar_fecha = $_REQUEST['cambiar_fecha'];}else{$cambiar_fecha = 0;}
	if(isset($_REQUEST['fecha_nueva'])){$fecha_nueva = cambiaf_a_normal($_REQUEST['fecha_nueva']);}else{$fecha_nueva = "";}

  $separar_numero_factura = explode("-",$_REQUEST['numero_factura']);
	$numero_factura = $separar_numero_factura[1];
  $numero_factura_real = $separar_numero_factura[0];
	$printer = 0; $aumentar_espacio_linux = 0;
    $db_link = $dblink;
				
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

}
}
//************************************************************************************************************************
// Creando el Informe.
    $pdf=new PDF('P','mm',array(139.7,215.9));	// Formato Media Carta. Libreria Primavera
    //$pdf=new PDF('P','mm',array(160.00,215.9));	// Formato Media Oficio. 
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
    //$pdf->AddPage();
/////////////////////////////////////////////////////////////////////////////////////////
// configuración de colores par ala linea
    $pdf->SetDrawcolor(0,0,0);
/////////////////////////////////////////////////////////////////////////////////////////
// declara matriz para los certificados dependiendo sus valores de Preparatoria, Primer y Segundo Ciclo, Tercer ciclo (7º y 8ª) y Tercer Ciclo (9ª)
if($info["os"] == "WIN")
{
  $medida_bach = '01';
  $printer = 0;
}
if($info["os"] == "LINUX")
{
  $medida_bach = '01';
  $printer = 1;
  $aumentar_espacio_linux = 2;
  $porcentaje = 0;
}	
   // Creando la página.
  // $pdf->AddPage();
//	Consulta para las medidas.   
   $query = "SELECT m.id_medidas, m.fila, m.columna, m.descripcion, m.codigo_modalidad,
				cat_f.descripcion as nombre_fuente, cat_e.descripcion as nombre_estilo, cat_t.descripcion as tamano_fuente
			FROM medidas m
			INNER JOIN catalogo_fuente cat_f ON cat_f.codigo = m.codigo_fuente
			INNER JOIN catalogo_estilo cat_e ON cat_e.codigo = m.codigo_estilo
			INNER JOIN catalogo_tamano cat_t ON cat_t.codigo = m.codigo_tamano
			WHERE m.codigo_modalidad = '".$medida_bach."' and m.printer = ".$printer." ORDER BY m.id_medidas";
// ejecutar la consulta para las medida de los certificados.
    $xf = array(); $yc = array(); $nombre_fuente = array(); $nombre_estilo = array(); $tamaño_fuente = array(); $venta_total = 0;
	$result_medidas = $db_link -> query($query);
	while($row_medidas = $result_medidas -> fetch(PDO::FETCH_BOTH))
	{
		// Medidas con respecto a certificados de Primero y Segundo Ciclo.
		if($row_medidas['codigo_modalidad'] == $medida_bach)
			{	
				// printer 0; asignacion del valor de la fila y columna a la matriz.
			    $xf[] = $row_medidas['fila'];  $yc[] = $row_medidas['columna'];
				$nombre_fuente[] = trim($row_medidas['nombre_fuente']);
				$tamaño_fuente[] = trim($row_medidas['tamano_fuente']);
				if(trim($row_medidas['nombre_estilo']) == 'Normal')
				{
					$nombre_estilo[] = "";
				}else{
					$nombre_estilo[] = trim($row_medidas['nombre_estilo']);
				}
			}
	}
///////////////////////////////////////////////////////////////////////////////////////////////////
//  INICIO PARA MOSTRAR LOS DATOS DE LA TABLA.
//	Recorrer la tabla en donde se encuentra el nombre del encargado.
		$alto=array(5.8,12,5.5); //determina el ancho de las columnas
		$ancho=array(6,65,12,10,18,18,17); //determina el ancho de las columnas
	    global $xf,$yc;
		$tipo_factura = "01";
		$i=1; $var_f_e_t = 0; $sumas_ventas_exentas = 0; $sumas_ventas_gravadas = 0; $sumas_ventas_gravadas_procesar = 0;
    $sumas_ventas_exentas_procesar = 0; $descuento_procesar = 0;
// Armar Consulta para Recorrer la factura.
		$query_factura = "SELECT fac_dv.codigo_producto, fac_dv.numero_factura, fac_dv.cantidad, fac_dv.precio_venta, fac_dv.precio_venta as venta_exenta, fac_dv.codigo_tipo_factura, 
					fac_v.fecha, fac_v.codigo_descuento, cat_des.descripcion as porcentaje, fac_v.codigo_vendedor,
					cat_pro.descripcion, cat_pro.producto_exento,
					(cli.nombres || cast( ' ' as varchar) || cli.apellidos) as nombre_completo, cli.direccion, cli.dui, cli.nit, cli.cliente_empresa
					FROM facturas_detalles_ventas fac_dv
						INNER JOIN facturas_ventas fac_v ON fac_v.numero_factura = fac_dv.numero_factura
						INNER JOIN catalogo_productos cat_pro ON (cat_pro.codigo_categoria || cat_pro.codigo) = fac_dv.codigo_producto
						INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
						INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento
							WHERE fac_dv.numero_factura_real = '$numero_factura_real' and fac_dv.numero_factura = {$numero_factura} and
                    fac_v.codigo_tipo_factura = '$tipo_factura' and fac_dv.codigo_tipo_factura = '$tipo_factura' and fac_v.numero_factura_real = '$numero_factura_real' and fac_v.numero_factura = {$numero_factura}";
		$resultado_factura = $db_link -> query($query_factura);
//	Recorrer la tabla en donde se encuentra la información del DETALLE DE LA FACTURA TEMP.
		while($row_factura = $resultado_factura -> fetch(PDO::FETCH_BOTH))
			{
						// oPTENER VALORES DE LA CONSULTA.
						$fecha = cambiaf_a_normal($row_factura["fecha"]);
						$nombre_cliente = utf8_decode(trim($row_factura["cliente_empresa"]));
						$direccion = trim($row_factura["direccion"]);
						$dui = trim($row_factura["dui"]);
						$nit = trim($row_factura["nit"]);
						$codigo_vendedor = trim($row_factura["codigo_vendedor"]);
						$porcentaje = number_format($row_factura['porcentaje'] / 100,2);
						$cantidad = trim($row_factura["cantidad"]);
						$descripcion = substr(utf8_decode(trim($row_factura["descripcion"])),0,37);
						$precio_unitario = number_format(trim($row_factura['precio_venta']),4);
						$venta_exenta = number_format(trim($row_factura['venta_exenta']),4);
						$producto_exento = (trim($row_factura['producto_exento']));
						$codigo_tipo_factura = trim($row_factura['codigo_tipo_factura']);
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_unitario = 0;}
									else{
										$venta_exenta = 0;}
								  // Calcula rel 13% depende del Tipo de Factura.
								  //	CONSUMIDOR FINAL ////////////////////////////////////////////////////////////////////////////////////
								  if($codigo_tipo_factura === "01"){
									// Pasar el precio a dos decimales.
									$precio_unitario = ($precio_unitario);
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_ventas_exentas = $cantidad * $venta_exenta;
									$sumas_ventas_exentas = number_format($sumas_ventas_exentas + $precio_total_ventas_exentas,2);
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_total_ventas_gravadas = $cantidad * $precio_unitario;
                  $sumas_ventas_gravadas_procesar = ($sumas_ventas_gravadas_procesar + $precio_total_ventas_gravadas);
                  $sumas_ventas_gravadas = number_format($sumas_ventas_gravadas_procesar,2,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$venta_total_procesar = round($sumas_ventas_exentas + $sumas_ventas_gravadas_procesar,2);
                  $venta_total = number_format($venta_total_procesar,2,'.',',');
                  $descuento_procesar = round($venta_total_procesar * $porcentaje,2);
                  $descuento = number_format($descuento_procesar,2,'.',',');
									$venta_total_descuento_procesar = round($venta_total_procesar - $descuento_procesar,2);
                  $venta_total_descuento = number_format($venta_total_descuento_procesar,2,'.',',');
									// Validar para imprimri el valor de la venta total con o sin descuento.
									if($porcentaje >0){
										$venta_total = number_format($venta_total_descuento_procesar,2,'.',',');
									}
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_total = number_format($precio_total_ventas_exentas,2);}
									else{
										$precio_total = number_format($precio_total_ventas_gravadas,2);}									
								  }						
				if($i == 1)
					{
						$pdf->Addpage();
						//	IMPRIMIR DATOS.
						// DATO FECHA POSICIÓN 0
            if($print_no_fecha == 1){
            // mada            
             // print $print_no_fecha;
            }else{
        			if($cambiar_fecha == 1){
        				$pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]);
        				$pdf->RotatedText($xf[0],$yc[0],($fecha_nueva),0);}
        			else{
        				$pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]);
        				$pdf->RotatedText($xf[0],$yc[0],($fecha),0);
        			}
            }
            // IMPRIMIR EL NUMERO DE FACTURA.
                $pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]);
        				$pdf->RotatedText($xf[0]+10,$yc[0]-29,($numero_factura),0);
						// DATO NOMBRE DEL CLIENTE POSICIÓN 1
							$pdf->SetFont($nombre_fuente[1],$nombre_estilo[1],$tamaño_fuente[1]);
							$pdf->RotatedTextMulticellAspectos($xf[1],$yc[1],($nombre_cliente),0);
						// DATO DIRECCION POSICIÓN 2
							$pdf->SetFont($nombre_fuente[2],$nombre_estilo[2],$tamaño_fuente[2]);
							$pdf->RotatedTextMulticellDireccion($xf[2],$yc[2],($direccion),0);
						// DATO dui o nit POSICIÓN 3		
							$pdf->SetFont($nombre_fuente[3],$nombre_estilo[3],$tamaño_fuente[3]);
							$pdf->RotatedText($xf[3],$yc[3],($dui).' '.($nit),0);
						// DATO VENTA A CUENTA DE POSICIÓN 4		
							$pdf->SetFont($nombre_fuente[4],$nombre_estilo[4],$tamaño_fuente[4]);
							$pdf->RotatedText($xf[4],$yc[4],$codigo_vendedor,0);
							
						// DATO CANTIDAD - DESCRIPCION - PRECIO UNITARIO - VENTANOS NO SUJETAS - VENTAS EXENTAS - VENTAS GRAVADAS - DE POSICIÓN 5
							$pdf->SetFont($nombre_fuente[5],$nombre_estilo[5],$tamaño_fuente[5]);
							$pdf->SetXY($xf[5],$yc[5]);
							$pdf->Cell($ancho[0],$alto[0],$cantidad,0,0,'L');
							$pdf->Cell($ancho[1],$alto[0],$descripcion,0,0,'L');

							if($precio_unitario == 0){$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$venta_exenta,0,0,'R');}else{$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$precio_unitario,0,0,'R');}
							if($venta_exenta == 0){$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],$precio_total,0,0,'R');}
							if($precio_unitario == 0){$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],'',0,1,'R');}else{$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],$precio_total,0,1,'R');}
					}
					if($i>1){
						// DATO CANTIDAD - DESCRIPCION - PRECIO UNITARIO - VENTANOS NO SUJETAS - VENTAS EXENTAS - VENTAS GRAVADAS - DE POSICIÓN 5
							$pdf->SetFont($nombre_fuente[5],$nombre_estilo[5],$tamaño_fuente[5]);
							$pdf->SetX($xf[5]);
							$pdf->Cell($ancho[0],$alto[0],$cantidad,0,0,'L');
							$pdf->Cell($ancho[1],$alto[0],$descripcion,0,0,'L');
							
							if($precio_unitario == 0){$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$venta_exenta,0,0,'R');}else{$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$precio_unitario,0,0,'R');}
							if($venta_exenta == 0){$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],$precio_total,0,0,'R');}
							if($precio_unitario == 0){$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],'',0,1,'R');}else{$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],$precio_total,0,1,'R');}
					// MODIFICAR EL ALTO DE LA FILA.
						if($i >= 8){
							$alto=array(5.9,12,5.5); //determina el ancho de las columnas
						}
					}
					// aumentar el varlo de $I
					$i++; $var_f_e_t++;
	      } // do while.	
// /////////////////////////////////////////////////////////////////////////////////////////////////////
// AL SALIR DEL BUCLE DE LA CONSULTA.
// /////////////////////////////////////////////////////////////////////////////////////////////////////
	// DATO CANTIDAD EN LETRAS.
	$pdf->SetFont($nombre_fuente[6],$nombre_estilo[6],$tamaño_fuente[6]);
  if($porcentaje > 0)
  {
  	$pdf->RotatedText($xf[6],$yc[6],numtoletras(number_format($venta_total,2)),0);
  }else{
    $pdf->RotatedText($xf[6],$yc[6],numtoletras(number_format($venta_total_procesar,2)),0);
  }
// DATO  SUMAS EXENTAS.
	$pdf->SetFont($nombre_fuente[7],$nombre_estilo[7],$tamaño_fuente[7]);
	$pdf->SetXY($xf[7],$yc[7]);
	if($sumas_ventas_exentas == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_exentas,0,0,'R');}
// DATO  SUMAS gravadas
	$pdf->SetFont($nombre_fuente[8],$nombre_estilo[8],$tamaño_fuente[8]);
	$pdf->SetXY($xf[8],$yc[8]);
	$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_gravadas,0,0,'R');
// DATO  SUBTOTAL
	$pdf->SetFont($nombre_fuente[9],$nombre_estilo[9],$tamaño_fuente[9]);
	$pdf->SetXY($xf[9],$yc[9]);
	$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_gravadas,0,0,'R');
// DATO  nombre de la razon social y dui cuando sean mayores a $200.00
	if($venta_total >= 200){
		$pdf->SetFont($nombre_fuente[10],$nombre_estilo[10],$tamaño_fuente[10]);
		$pdf->RotatedText($xf[10],$yc[10],$nombre_cliente,0);
	// DATO  DUI
		$pdf->SetFont($nombre_fuente[11],$nombre_estilo[11],$tamaño_fuente[11]);
		$pdf->RotatedText($xf[11],$yc[11],$dui,0);
	}
// DATO  SUMAS EXENTAS.
	$pdf->SetFont($nombre_fuente[12],$nombre_estilo[12],$tamaño_fuente[12]);
	$pdf->SetXY($xf[12],$yc[12]);
	if($sumas_ventas_exentas == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_exentas,0,0,'R');}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DESCUENTO.
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($porcentaje > 0)
{
  $pdf->SetFont($nombre_fuente[13],$nombre_estilo[13],$tamaño_fuente[13]);
  $pdf->SetXY(90,187);
	$pdf->Cell($ancho[6],$alto[0],"Desc.".($porcentaje*100)."%-"."$".$descuento,0,0,'R');
} 
// DATO  VENTA TOTAL
	$pdf->SetFont($nombre_fuente[13],$nombre_estilo[13],$tamaño_fuente[13]);
	$pdf->SetXY($xf[13],$yc[13]);
	$pdf->Cell($ancho[6],$alto[0],$venta_total,0,0,'R');
// GUARDAR EL TOTAL DE VENTA
  $query_venta_descuento = "UPDATE facturas_ventas SET total_venta = $venta_total
                    WHERE numero_factura_real = '$numero_factura_real' and numero_factura = {$numero_factura} and
                    codigo_tipo_factura = '$tipo_factura' and codigo_tipo_factura = '$tipo_factura' and numero_factura_real = '$numero_factura_real' and numero_factura = {$numero_factura}";
  $resultado_ = $db_link -> query($query_venta_descuento);  
// Salida del pdf.
    $pdf->Output('I');
?>