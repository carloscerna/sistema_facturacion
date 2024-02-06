<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexión a la base de datos
   include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
// Variables del Post.
   if(isset($_POST["codigo_tipo_factura"]))
   {
      $codigo_tipo_factura = $_POST["codigo_tipo_factura"];
   }else{
      $codigo_tipo_factura = "01";
   }
// armando el Query.
   $query = "SELECT * FROM informacion_institucion LIMIT 1";
// Ejecutamos el Query.
   $consulta = $dblink -> query($query);
// Inicializando el array
$datos=array(); $fila_array = 0;
// Recorriendo la Tabla con PDO::
      while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
	{
         // Nombres de los campos de la tabla.
         if($codigo_tipo_factura == "01"){
            $numero_linea_factura = trim($listado['numero_linea_factura_consumidor_final']);   
         }else{
            $numero_linea_factura = trim($listado['numero_linea_factura_credito_fiscal']);   
         }

	 // Rellenando la array.
         $datos[$fila_array]["numero_linea_factura"] = $numero_linea_factura;
         
	   $fila_array++;
        }
// Enviando la matriz con Json.
echo json_encode($datos);	
?>