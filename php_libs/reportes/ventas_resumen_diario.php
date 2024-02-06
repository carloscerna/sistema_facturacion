<?php
sleep(0);
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
    include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
// Llamar a la libreria fpdf
    include($path_root."/sistema_facturacion/php_libs/fpdf/fpdf.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
	$fecha = $_REQUEST["fecha"];
  $db_link = $dblink;
  $total_ = 0;
  $subtotal_ = 0;
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
          $pdf->AddPage();
        $pdf->SetX(10);
      /////////////////////////////////////////////////////////////////////////////////////////
      // ARMAR EL ENCABEZADO
          $alto=array(6); //determina el ancho de las columnas
          $ancho=array(120,40,10); //determina el ancho de las columnas
      // Encabezado
        $pdf->SetFont('Comic','','16');
        $pdf->Cell($ancho[0],$alto[0],'LIBRERIA Y PAPELERIA PRIMAVERA',0,1,'C');
      // Encabezado
        $pdf->SetFont('Comic','','14');
        $pdf->Cell($ancho[0],$alto[0],'Resumen de Ventas Diarias',0,1,'C');
      // Encabezado
        $pdf->SetFont('Comic','','12');
        $pdf->Cell($ancho[0],$alto[0],'Tipo de Factura y Forma de Pago',0,1,'C');
        // Encabezado
        $pdf->SetFont('Comic','','10');
        $pdf->Cell($ancho[0],$alto[0],'Fecha: '. ($fecha),0,1,'R');
        //$pdf->SetXY(10,50);
      /////////////////////////////////////////////////////////////////////////////////////////
      // declara matriz para TIPO DE FACTURA Y FORMA DE PAGO.
        $tipo_factura_a = array(); $forma_pago = array(); $salto_i = 0; $total_ = 0; $subtotal_ = 0; $total_dia = 0;
        $codigo_tipo_factura = array(); $codigo_forma_pago = array();
      //	Consulta tabla Tipo de Factura.
         $query_tipo_factura = "SELECT * FROM catalogo_tipo_factura ORDER BY codigo";
      //	Consulta tabla Forma de Pago.
        $query_forma_pago = "SELECT * FROM catalogo_forma_pago ORDER BY codigo";
      //	Ejecturar la consulta.
         $result_tipo_factura = $db_link -> query($query_tipo_factura);
         $result_forma_pago = $db_link -> query($query_forma_pago);
      // Extraer valore de la consulta.
        while($row_tipo_factura = $result_tipo_factura -> fetch(PDO::FETCH_BOTH))
        {
          $tipo_factura_a[] = trim($row_tipo_factura["descripcion"]);
          $codigo_tipo_factura[] = trim($row_tipo_factura["codigo"]);	
        }
      // Extraer valore de la consulta.
        while($row_forma_pago = $result_forma_pago -> fetch(PDO::FETCH_BOTH))
        {
          $forma_pago[] = trim($row_forma_pago["descripcion"]);
          $codigo_forma_pago[] = trim($row_forma_pago["codigo"]);	
        }
      ///////////////////////////////////////////////////////////////////////////////////////////////////
      //  INICIO PARA MOSTRAR LOS DATOS DE LA TABLA.
      //	Recorrer la tabla en donde se encuentra el nombre del encargado.
        $pdf->SetXY(15,50);
        for($i=0;$i<count($tipo_factura_a);$i++)
        {
          $pdf->SetX(15);
          for($j=0;$j<count($forma_pago);$j++)
          {
            $pdf->SetFont('Comic','','10');
            if($salto_i == 0){
              $pdf->Cell($ancho[1],$alto[0],utf8_decode($tipo_factura_a[$i]),1,1,'L');
      
              $query_ = "SELECT (fac_v.total_venta) as total_venta_dia
                          FROM facturas_ventas fac_v 
                          INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento            
                          WHERE fecha = '$fecha' and codigo_tipo_factura = '$codigo_tipo_factura[$i]' and codigo_forma_pago='$codigo_forma_pago[$j]'";
                          
                                  /*$query_ = "SELECT (fac_v.total_venta-(fac_v.total_venta*(cat_des.descripcion/100))) as total_venta_dia
                          FROM facturas_ventas fac_v 
                          INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento            
                          WHERE fecha = '$fecha' and codigo_tipo_factura = '$codigo_tipo_factura[$i]' and codigo_forma_pago='$codigo_forma_pago[$j]'";*/
              $result_ = $db_link -> query($query_);
             // Extraer valore de la consulta.
               while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
               {
                 $total_fac = round($row_["total_venta_dia"],2);
                 $total_ = $total_ + $total_fac;
                 $subtotal_ = $subtotal_ + $total_fac;
               }
      
              $pdf->SetX(25);
              $pdf->Cell($ancho[1],$alto[0],utf8_decode($forma_pago[$j]),0,0,'L');
              if($total_ == null){$total_ = 0;$pdf->Cell($ancho[2],$alto[0],'$ ',0,1,'R');}else{$pdf->Cell($ancho[2],$alto[0],'$ ' . number_format($total_,2),0,1,'R');}
                $salto_i = 1;
            }else{
              $pdf->SetX(25);
              $query_ = "SELECT sum(fac_v.total_venta) as total_venta_dia FROM facturas_ventas fac_v WHERE fecha = '$fecha' and codigo_tipo_factura = '$codigo_tipo_factura[$i]' and codigo_forma_pago='$codigo_forma_pago[$j]'";
              $result_ = $db_link -> query($query_);
             // Extraer valore de la consulta.
             
               while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
               {
                if(is_null($row_["total_venta_dia"])){
                  $total_ = 0;
                  }
                  else{
                 $total_ = round($row_["total_venta_dia"],2);
                 $subtotal_ = $subtotal_ + $total_;
                  }
               }
                               
              $pdf->SetX(25);
              $pdf->Cell($ancho[1],$alto[0],utf8_decode($forma_pago[$j]),0,0,'L');
              if($total_ == null){$total_ = 0;$pdf->Cell($ancho[2],$alto[0],'$ ',0,1,'R');}else{$pdf->Cell($ancho[2],$alto[0],'$ ' . number_format($total_,2),0,1,'R');}

            }
          }
          //	IMPRIMIR SUBTOTAL DE LA PRIMERA ENCONTRADA.
            $pdf->SetX(75);
            $pdf->Cell($ancho[1],$alto[0],'Sub-Total $ ' . number_format($subtotal_,2),1,1,'R');
          // Obtener el total del día.
            $total_dia = $total_dia  + $subtotal_;
          // regresar salto a cero
              $salto_i = 0; $subtotal_ = 0;
        }
          //	IMPRIMIR SUBTOTAL DE LA PRIMERA ENCONTRADA.
            $pdf->SetX(75);
            $pdf->Ln(2);
            $pdf->SetX(75);
            $pdf->Cell($ancho[1],$alto[0],'Total $ ' . number_format($total_dia,2),1,1,'R');
      
      // Salida del pdf.
          $pdf->Output('I');      
?>