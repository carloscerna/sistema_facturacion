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
   $query = "SELECT tiraje, numero_fin, codigo_estatus FROM facturas_tiraje WHERE codigo_estatus = '01' and codigo_tipo_factura = '$codigo_tipo_factura' LIMIT 1";
// Ejecutamos el Query.
   $consulta = $dblink -> query($query);
// Inicializando el array
$datos=array(); $fila_array = 0;
// Recorriendo la Tabla con PDO::
      while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
	{
         // Nombres de los campos de la tabla.
	 $tiraje = trim($listado['tiraje']);
    $numero_fin = trim($listado['numero_fin']);
    $codigo_estatus = trim($listado['codigo_estatus']);
	 // Rellenando la array.
         $datos[$fila_array]["numero_factura_real"] = $tiraje;
         $datos[$fila_array]["numero_fin"] = $numero_fin;
         $datos[$fila_array]["codigo_estatus"] = $codigo_estatus;
         
	   $fila_array++;
        }
// Enviando la matriz con Json.
echo json_encode($datos);	
?>