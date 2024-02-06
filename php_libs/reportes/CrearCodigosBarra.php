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
    include($path_root."/sistema_facturacion/php_libs/barcode/barcode.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
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
function RotatedTextMultiCell($x,$y,$txt,$angle)
{
  global $fill;
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->SetXY($x,$y);
	$this->MultiCell(50,4,$txt,0,'L',$fill);
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
		$header=array('Código Barra','Descripción','Código Barra','Descripción');
		$alto=array(15); //determina el ancho de las columnas
		$ancho=array(40,50,40,50); //determina el ancho de las columnas

/////////////////////////////////////////////////////////////////////////////////////////
	//$pdf->FancyTable($header); // Solo carge el encabezado de la tabla porque medaba error el cargas los datos desde la consulta.
	$fill = false;
//	Consulta tabla Tipo de Factura.
$query_codigos_barra = "SELECT t.id_, t.codigo_producto, t.cantidad, cat_p.descripcion as nombre_producto
							FROM temp_codigo_barra t
							INNER JOIN catalogo_productos cat_p ON (cat_p.codigo_categoria || cat_p.codigo) = t.codigo_producto
              ORDER BY t.codigo_producto";
	$result_ = $db_link -> query($query_codigos_barra);
	$num = 0; $salto = 0; $ii = 0;
  $y = $pdf->GetY(); $x = $pdf->GetX();
  $y_descripcion = $pdf->GetY()-1;
  $x_descripcion = 12; $x_codigo_barra = 10;
			 // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
              $codigo_producto = trim($row_["codigo_producto"]);
              $cantidad = trim($row_["cantidad"]);
              $codigo_barra = $codigo_producto;
              $descripcion = substr(trim($row_["nombre_producto"]),0,26);
              // Crear los códigos de barra.
              barcode($_SERVER['DOCUMENT_ROOT'].'/sistema_facturacion/img/codigos/'.$codigo_barra.'.png', $codigo_barra, 20, 'horizontal', 'code128', true);

            // Imprimir los valores
             $pdf->SetFont('Comic','','6');
             for($i=0;$i<$cantidad;$i++){
              $ii++;
               $pdf->RotatedText($x_descripcion,$y_descripcion,utf8_decode($descripcion),0);
               $pdf->Image($_SERVER['DOCUMENT_ROOT'].'/sistema_facturacion/img/codigos/'.$codigo_barra.'.png',$x_codigo_barra,$y,40,0,'PNG');
               
               $y = $y+17;
               $y_descripcion = $y_descripcion + 17; 
               $fill=!$fill;
               
               if($ii == 16 || $ii == 32 || $ii == 48 || $ii == 64){
                 $x_codigo_barra = $x_codigo_barra + 40;
                 $x_descripcion = $x_descripcion + 40;
                 $y = 5;
                 $y_descripcion = 4;
                 }
                 
                 if($ii > 79){
                  $pdf->AddPage();                  
                  $y = $pdf->GetY(); $x = $pdf->GetX();
                  $y_descripcion = $pdf->GetY()-1;
                  $x_descripcion = 12; $x_codigo_barra = 10;
                  $ii = 0;
                 }
             } // FIN DEL FOR
				 }  // FIN DEL WHILE         

// Salida del pdf.
    $pdf->Output('I');
?>