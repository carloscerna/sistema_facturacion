<?php
sleep(1);
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
    include($path_root."/sistema_facturacion/includes/consultas.php");
    include($path_root."/sistema_facturacion/includes/detectar_so.php");
	include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
	include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");

// Llamar a la libreria fpdf
    include($path_root."/sistema_facturacion/php_libs/fpdf/fpdf.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
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

function RotatedTextMultiCellGiro($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
	$this->MultiCell(40,2.5,$txt,0,'L');
	$this->Rotate(0);
}

function RotatedTextMultiCellAspectos($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
  $this->MultiCell(65,4,$txt,0,'L');
	$this->Rotate(0);
}

function RotatedTextMultiCellNombre2($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
  $this->MultiCell(65,3,$txt,0,'L');
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
    $pdf=new PDF('P','mm',array(139.7,215.9));	// Formato Media Carta.
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
  $medida_bach = '02';
  $printer = 0;
}
if($info["os"] == "LINUX")
{
  $medida_bach = '02';
  $printer = 1;
  $aumentar_espacio_linux = 2;
}	
//	Consulta para las medidas.   
   $query = "SELECT m.id_medidas, m.fila, m.columna, m.descripcion, m.codigo_modalidad,
				cat_f.descripcion as nombre_fuente, cat_e.descripcion as nombre_estilo, cat_t.descripcion as tamano_fuente
			FROM medidas m
			INNER JOIN catalogo_fuente cat_f ON cat_f.codigo = m.codigo_fuente
			INNER JOIN catalogo_estilo cat_e ON cat_e.codigo = m.codigo_estilo
			INNER JOIN catalogo_tamano cat_t ON cat_t.codigo = m.codigo_tamano
			WHERE m.codigo_modalidad = '".$medida_bach."' and m.printer = ".$printer." ORDER BY m.id_medidas";
// ejecutar la consulta para las medida de los certificados.
    $xf = array(); $yc = array(); $nombre_fuente = array(); $nombre_estilo = array(); $tamaño_fuente = array(); 
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
		$alto=array(5.7,12,5.1); //determina el ancho de las columnas
		$ancho=array(6,65,12,10,18,18,17); //determina el ancho de las columnas
	    global $xf,$yc;
		$tipo_factura = "02"; $iva = 0; $subtotal = 0;
		$i=1; $var_f_e_t = 0; $sumas_ventas_exentas = 0; $sumas_ventas_gravadas = 0; $sumas_ventas_gravadas_procesar = 0;
    $sumas_ventas_exentas_procesar = 0; $iva_procesar = 0; $porcentaje = 0; 
// Armar Consulta para Recorrer la factura.
		$query_factura = "SELECT fac_dv.id_detalle, fac_dv.codigo_producto, fac_dv.numero_factura, fac_dv.cantidad, fac_dv.precio_venta, fac_dv.precio_venta as venta_exenta, fac_dv.codigo_tipo_factura,
					fac_v.fecha, fac_v.codigo_tipo_factura, fac_v.codigo_vendedor,
					cat_pro.descripcion, cat_pro.producto_exento,
					(cli.nombres || cast( ' ' as varchar) || cli.apellidos) as nombre_completo, cli.direccion, cli.dui, cli.nit, cli.numero_registro, cli.giro, depa.nombre as nombre_departamento, cli.cliente_empresa
					FROM facturas_detalles_ventas fac_dv
						INNER JOIN facturas_ventas fac_v ON fac_v.numero_factura = fac_dv.numero_factura
						INNER JOIN catalogo_productos cat_pro ON (cat_pro.codigo_categoria || cat_pro.codigo) = fac_dv.codigo_producto
						INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
						INNER JOIN departamento depa ON depa.codigo = cli.codigo_departamento
							WHERE fac_dv.numero_factura_real = '$numero_factura_real' and fac_dv.numero_factura = {$numero_factura} and
                    fac_v.codigo_tipo_factura = '$tipo_factura' and fac_dv.codigo_tipo_factura = '$tipo_factura' and fac_v.numero_factura_real = '$numero_factura_real' and fac_v.numero_factura = {$numero_factura}
                    ORDER BY fac_dv.id_detalle";
		$resultado_factura = $db_link -> query($query_factura);
//	Recorrer la tabla en donde se encuentra la información del DETALLE DE LA FACTURA TEMP.
		while($row_factura = $resultado_factura -> fetch(PDO::FETCH_BOTH))
			{
						// oPTENER VALORES DE LA CONSULTA.
						$fecha = cambiaf_a_normal($row_factura["fecha"]);
						$nombre_cliente = utf8_decode(trim($row_factura["cliente_empresa"]));
						$direccion = utf8_decode(trim($row_factura["direccion"]));
						$dui = trim($row_factura["dui"]);
						$nit = trim($row_factura["nit"]);
						$numero_registro = trim($row_factura["numero_registro"]);
						$codigo_vendedor = trim($row_factura["codigo_vendedor"]);
						$giro = strtolower(utf8_decode(trim($row_factura["giro"])));
						$nombre_departamento = utf8_decode(trim($row_factura["nombre_departamento"]));
						
						$cantidad = trim($row_factura["cantidad"]);
						$descripcion = utf8_decode(substr(trim($row_factura["descripcion"]),0,33));
						$precio_unitario = trim($row_factura['precio_venta']);
						$venta_exenta = trim($row_factura['venta_exenta']);
						$producto_exento = trim($row_factura['producto_exento']);
						$codigo_tipo_factura = trim($row_factura['codigo_tipo_factura']);
							// Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_unitario = 0;}
									else{
										$venta_exenta = 0;}
								  // Calcula rel 13% depende del Tipo de Factura.
								  if($codigo_tipo_factura === "02"){
								//	CREDITO FISCAL ////////////////////////////////////////////////////////////////////////////////////
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_ventas_exentas_procesar = $cantidad * $venta_exenta;
                  $precio_total_ventas_exentas = number_format($precio_total_ventas_exentas_procesar,2,'.',',');
                  // SEMAS EXENTAS
                  $sumas_ventas_exentas_procesar = $sumas_ventas_exentas_procesar + $precio_total_ventas_exentas_procesar;
									$sumas_ventas_exentas = number_format($sumas_ventas_exentas_procesar,2,'.',',');       
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_unitario_sin_iva_procesar = round($precio_unitario / 1.13,4);
                  $precio_unitario_sin_iva = number_format($precio_unitario_sin_iva_procesar,4,'.',',');
									$precio_total_ventas_gravadas_procesar = round($cantidad * $precio_unitario_sin_iva_procesar,4);
                  $precio_total_ventas_gravadas = number_format($precio_total_ventas_gravadas_procesar,4,'.',',');
                                    
									$sumas_ventas_gravadas_procesar = ($sumas_ventas_gravadas_procesar + $precio_total_ventas_gravadas_procesar);
                  $sumas_ventas_gravadas = number_format($sumas_ventas_gravadas_procesar,4,'.',',');
                  //$iva_procesar = $iva_procesar + ($precio_total_ventas_gravadas_procesar * 0.13);
                  //$iva = number_format($iva_procesar,4,'.',',');
									$precio_unitario = $precio_unitario_sin_iva_procesar;
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$venta_total_procesar = round($sumas_ventas_exentas_procesar + $sumas_ventas_gravadas_procesar + $iva_procesar,2);
                  $venta_total = number_format($venta_total_procesar,2,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$descuento = number_format($venta_total_procesar * $porcentaje,2);
									$venta_total_descuento = number_format($venta_total_procesar - $descuento,2);
									// Validar cuando el producto es exento de iva.
									if($producto_exento == "01"){
										  $precio_total = $precio_total_ventas_exentas;}
									  else{
										  $precio_total = $precio_total_ventas_gravadas;}
								  }				
				if($i == 1)
					{
						$pdf->Addpage();
						//	IMPRIMIR DATOS.
						// DATO FECHA POSICIÓN 0
            if(strlen($nombre_cliente) > 65){
							$pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]-3);
              $pdf->RotatedTextMulticellNombre2($xf[0],$yc[0],($nombre_cliente),0);              
            }else{
							$pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]);
              $pdf->RotatedTextMulticellAspectos($xf[0],$yc[0],($nombre_cliente),0);
            }
            // IMPRIMIR EL NUMERO DE FACTURA.
                $pdf->SetFont($nombre_fuente[$var_f_e_t],$nombre_estilo[$var_f_e_t],$tamaño_fuente[$var_f_e_t]);
        				$pdf->RotatedText($xf[0]+83,$yc[0]-30,($numero_factura),0);
						// DATO NOMBRE DEL CLIENTE POSICIÓN 1
						if($cambiar_fecha == 1){
							$pdf->SetFont($nombre_fuente[1],$nombre_estilo[1],$tamaño_fuente[1]);
							$pdf->RotatedText($xf[1],$yc[1],($fecha_nueva),0);}
							else{
							$pdf->SetFont($nombre_fuente[1],$nombre_estilo[1],$tamaño_fuente[1]);
							$pdf->RotatedText($xf[1],$yc[1],($fecha),0);	
							}
						// DATO DIRECCION POSICIÓN 2
            if(strlen($direccion) > 65){
							$pdf->SetFont($nombre_fuente[2],$nombre_estilo[2],$tamaño_fuente[2]);
							$pdf->RotatedTextMulticellDireccion($xf[2],$yc[2],($direccion),0);
            }else{
              $pdf->SetFont($nombre_fuente[2],$nombre_estilo[2],$tamaño_fuente[2]-3);
							$pdf->RotatedTextMulticellDireccion($xf[2],$yc[2],($direccion),0);
            }
						// DATO número de registro POSICIÓN 3		
							$pdf->SetFont($nombre_fuente[3],$nombre_estilo[3],$tamaño_fuente[3]);
							$pdf->RotatedText($xf[3],$yc[3],($numero_registro),0);
						// DATO GIRO POSICIÓN 4		
							$pdf->SetFont($nombre_fuente[4],$nombre_estilo[4],$tamaño_fuente[4]);
							$pdf->RotatedTextMulticellGiro($xf[4],$yc[4],($giro),0);
						// DATO NOMBRE DEPARTAMENTO DE POSICIÓN 5		
							$pdf->SetFont($nombre_fuente[5],$nombre_estilo[5],$tamaño_fuente[5]);
							$pdf->RotatedText($xf[5],$yc[5],$nombre_departamento,0);
						// DATO VENTA A CUENTA DE POSICIÓN 6		
							$pdf->SetFont($nombre_fuente[6],$nombre_estilo[6],$tamaño_fuente[6]);
							$pdf->RotatedText($xf[6],$yc[6],'NIT:'.$nit,0);							
						// DATO CONDICIONES DE LA OEPRACIÓN DE POSICIÓN 7
							$pdf->SetFont($nombre_fuente[7],$nombre_estilo[7],$tamaño_fuente[7]);
							$pdf->RotatedText($xf[7],$yc[7],'',0);
						// DATO contado DE POSICIÓN 8
							$pdf->SetFont($nombre_fuente[8],$nombre_estilo[8],$tamaño_fuente[8]);
							$pdf->RotatedText($xf[8],$yc[8],'',0);
						// DATO credito POSICIÓN 9
							$pdf->SetFont($nombre_fuente[9],$nombre_estilo[9],$tamaño_fuente[9]);
							$pdf->RotatedText($xf[9],$yc[9],'',0);
						// DATO dias DE POSICIÓN 10
							$pdf->SetFont($nombre_fuente[10],$nombre_estilo[10],$tamaño_fuente[10]);
							$pdf->RotatedText($xf[10],$yc[10],'',0);
						// DATO nº nota de remisión anterior DE POSICIÓN 10
							$pdf->SetFont($nombre_fuente[11],$nombre_estilo[11],$tamaño_fuente[11]);
							$pdf->RotatedText($xf[11],$yc[11],'',0);
						// DATO venta a cuenta de DE POSICIÓN 10
							$pdf->SetFont($nombre_fuente[12],$nombre_estilo[12],$tamaño_fuente[12]);
							$pdf->RotatedText($xf[12],$yc[12],$codigo_vendedor,0);
							
						// DATO CANTIDAD - DESCRIPCION - PRECIO UNITARIO - VENTANOS NO SUJETAS - VENTAS EXENTAS - VENTAS GRAVADAS - DE POSICIÓN 5
							$pdf->SetFont($nombre_fuente[13],$nombre_estilo[13],$tamaño_fuente[13]);
							$pdf->SetXY($xf[13],$yc[13]);
							$pdf->Cell($ancho[0],$alto[0],$cantidad,0,0,'R');
							$pdf->Cell($ancho[1],$alto[0],$descripcion,0,0,'L');
             
 							if($precio_unitario == 0){$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$venta_exenta,0,0,'R');}else{$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$precio_unitario,0,0,'R');}
							if($venta_exenta == 0){$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],$precio_total,0,0,'R');}
							if($precio_unitario == 0){$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],'',0,1,'R');}else{$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],$precio_total,0,1,'R');}
					}
					if($i>1){
						// DATO CANTIDAD - DESCRIPCION - PRECIO UNITARIO - VENTANOS NO SUJETAS - VENTAS EXENTAS - VENTAS GRAVADAS - DE POSICIÓN 5
							$pdf->SetFont($nombre_fuente[13],$nombre_estilo[13],$tamaño_fuente[13]);
							$pdf->SetX($xf[13]);
							$pdf->Cell($ancho[0],$alto[0],$cantidad,0,0,'R');
							$pdf->Cell($ancho[1],$alto[0],$descripcion,0,0,'L');
							
 							if($precio_unitario == 0){$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$venta_exenta,0,0,'R');}else{$pdf->Cell($ancho[2]+$aumentar_espacio_linux,$alto[0],$precio_unitario,0,0,'R');}
							if($venta_exenta == 0){$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[4]+$aumentar_espacio_linux,$alto[0],$precio_total,0,0,'R');}
							if($precio_unitario == 0){$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],'',0,1,'R');}else{$pdf->Cell($ancho[5]+$aumentar_espacio_linux,$alto[0],$precio_total,0,1,'R');}
					// MODIFICAR EL ALTO DE LA FILA.
						if($i >= 6){
							$alto=array(5.5,12,5.1); //determina el ancho de las columnas
						}
					}
					// aumentar el varlo de $I
					$i++; $var_f_e_t++;
	    } // do while.
// /////////////////////////////////////////////////////////////////////////////////////////////////////
// CALCULAR EL IVA Y SUMAS EN BASE A SUMAS GRAVADAS Y SUMAS EXENTAS
// /////////////////////////////////////////////////////////////////////////////////////////////////////
              //  $sumas_ventas_gravadas = round($sumas_ventas_gravadas,4);
                $iva_procesar = ($sumas_ventas_gravadas_procesar * 0.13);
                $iva = number_format($iva_procesar,4,".",",");
								$subtotal = number_format($sumas_ventas_gravadas_procesar + $iva_procesar,2);
								$venta_total_procesar = ($sumas_ventas_exentas_procesar + $sumas_ventas_gravadas_procesar + $iva_procesar);
                $venta_total = number_format($sumas_ventas_exentas_procesar + $sumas_ventas_gravadas_procesar + $iva_procesar,2,".",",");                 
// /////////////////////////////////////////////////////////////////////////////////////////////////////
// AL SALIR DEL BUCLE DE LA CONSULTA.
// /////////////////////////////////////////////////////////////////////////////////////////////////////
	// DATO CANTIDAD EN LETRAS.
	$pdf->SetFont($nombre_fuente[14],$nombre_estilo[14],$tamaño_fuente[14]);
	$pdf->RotatedText($xf[14],$yc[14],numtoletras(number_format($venta_total_procesar,2)),0);
// DATO  SUMAS EXENTAS.
	$pdf->SetFont($nombre_fuente[15],$nombre_estilo[15],$tamaño_fuente[15]);
	$pdf->SetXY($xf[15],$yc[15]);
	if($sumas_ventas_exentas == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_exentas,0,0,'R');}
// DATO  SUMAS GRAVADAS.
	$pdf->SetFont($nombre_fuente[16],$nombre_estilo[16],$tamaño_fuente[16]);
	$pdf->SetXY($xf[16],$yc[16]);
	if($sumas_ventas_gravadas == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_gravadas,0,0,'R');}
// DATO  SUMAS IVA.
	$pdf->SetFont($nombre_fuente[17],$nombre_estilo[17],$tamaño_fuente[17]);
	$pdf->SetXY($xf[17],$yc[17]);
	if($iva == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],number_format($iva,4),0,0,'R');}
// DATO  SUMAS GRAVADAS MAS IVA
	$pdf->SetFont($nombre_fuente[18],$nombre_estilo[18],$tamaño_fuente[18]);
	$pdf->SetXY($xf[18],$yc[18]);
	$pdf->Cell($ancho[6],$alto[0],$subtotal,0,0,'R');
// SUMAS VENTAS EXENTAS.
	$pdf->SetFont($nombre_fuente[19],$nombre_estilo[19],$tamaño_fuente[19]);
	$pdf->SetXY($xf[19],$yc[19]);
	if($sumas_ventas_exentas == 0){$pdf->Cell($ancho[6],$alto[0],'',0,0,'R');}else{$pdf->Cell($ancho[6],$alto[0],$sumas_ventas_exentas,0,0,'R');}
// DATO  SUBTOTAL
	$pdf->SetFont($nombre_fuente[20],$nombre_estilo[20],$tamaño_fuente[20]);
	$pdf->SetXY($xf[20],$yc[20]);
	$pdf->Cell($ancho[6],$alto[0],$venta_total,0,0,'R');
// DATO  nombre de la razon social y dui cuando sean mayores a $200.00
	if($venta_total >= 11428.57){
		$pdf->SetFont($nombre_fuente[10],$nombre_estilo[10],$tamaño_fuente[10]);
		$pdf->RotatedText($xf[10],$yc[10],$nombre_cliente,0);
	// DATO  DUI
		$pdf->SetFont($nombre_fuente[11],$nombre_estilo[11],$tamaño_fuente[11]);
		$pdf->RotatedText($xf[11],$yc[11],$dui,0);
	}
// Salida del pdf.
    $pdf->Output('I');
?>