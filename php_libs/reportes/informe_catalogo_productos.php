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
	// Encabezado
	$this->SetFont('Comic','','16');
	$this->Cell(210,6,'LIBRERIA Y PAPELERIA PRIMAVERA',0,1,'C');
// Encabezado
	$this->SetFont('Comic','','14');
	$this->Cell(210,6,utf8_decode('Catálogo de Productos'),0,1,'C');
// Encabezado
	$this->SetFont('Comic','','12');
	$this->Cell(210,6,utf8_decode('Por Código y Descripción'),0,1,'C');
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
    $this->SetFillColor(0,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Comic','');
	$this->SetX(15);
    //Cabecera
		$alto=array(6); //determina el ancho de las columnas
		$ancho=array(10,30,130,20); //determina el ancho de las columnas
    
    for($i=0;$i<count($header);$i++)
        $this->Cell($ancho[$i],$alto[0],utf8_decode($header[$i]),'LTR',0,'C',1);

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
	$pdf->SetX(15);
/////////////////////////////////////////////////////////////////////////////////////////
// ARMAR EL ENCABEZADO
		$header=array('Nº','Código Producto','Descripción','Existencia');
		$alto=array(6); //determina el ancho de las columnas
		$ancho=array(10,30,130,20); //determina el ancho de las columnas

/////////////////////////////////////////////////////////////////////////////////////////
	$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;
//	Consulta tabla Tipo de Factura.
	$query_ = "select codigo_categoria, codigo, descripcion, existencia from catalogo_productos group by codigo_categoria, codigo, descripcion, existencia order by codigo_categoria";
	$result_ = $db_link -> query($query_);
	$num = 0; $salto = 0;
  $y = $pdf->GetY();
			 // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
					$codigo_categoria = trim($row_["codigo_categoria"]);
					$codigo = trim($row_["codigo"]);
					$descripcion = trim($row_["descripcion"]);
					$existencia = trim($row_["existencia"]);
          
          
					$num++; $salto++;
					$pdf->SetX(15);
					$pdf->Cell($ancho[0],$alto[0],$num,0,0,'C',$fill);
					$pdf->Cell($ancho[1],$alto[0],utf8_decode($codigo_categoria) . $codigo ,0,0,'C',$fill);
					$pdf->Cell($ancho[2],$alto[0],utf8_decode($descripcion),0,0,'L',$fill);
					$pdf->Cell($ancho[3],$alto[0],utf8_decode($existencia),0,1,'C',$fill);
					
          $y = $y+15;
          
					$fill=!$fill;
					if($salto == 40){
						$pdf->AddPage();
            $y = $pdf->GetY();
						$salto = 0;
						$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
					}
				 }

// Salida del pdf.
    $pdf->Output('I');
?>