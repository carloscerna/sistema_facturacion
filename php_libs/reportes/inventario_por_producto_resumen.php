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
    
    //
    // SUMAR +1 PARA QUE PUEDA MOSTRAR EL FINAL DE ESTE AÑO QUE ES EL INICIAL DEL PROXIMO.
    //
    $year = $dato[2] + 1;
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
 $this->Cell(100,4,'PERIODO DEL ' . ($fecha_inicio) . ' AL ' . ($fecha_fin),0,1,'L');
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
		$fill = false;
		$fila_salto = 39; $total_general_saldo = 0; $num = 0; $salto = 0; $y= 0; $saldo=0;
		$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  presentar en el informe.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //
 // CONSULTA LA TABLA INVENTARIO INICIAL 
 //
	$query_i = "SELECT pi.codigo_producto, pi.descripcion, pi.fecha, pi.cantidad, pi.precio, cat_pro.descripcion as nombre_producto
              FROM productos_inventario_inicial pi
              INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = pi.codigo_producto
              WHERE pi.fecha = '01-01-$year'";
  $result_i = $db_link -> query($query_i);
  
  if($result_i -> rowCount() != 0){
			 // Extraer saldoe de la consulta.
				 while($row_ = $result_i -> fetch(PDO::FETCH_BOTH))
				 {
						$codigo_producto = trim($row_["codigo_producto"]);
						$descripcion = trim($row_["nombre_producto"]);
						$descripcion_inventario = "Inventario";
						$existencia = (int)$row_["cantidad"];
						$costo_promedio = $row_["precio"];
						$saldo = $existencia * $costo_promedio;
							//if($existencia < 0){
      // if($existencia > 0){
           $total_general_saldo = $total_general_saldo + $saldo;
       //}
								
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
  }
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