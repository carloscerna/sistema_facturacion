<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
// variables
$codigo_producto = $_REQUEST["codigo_producto"];
$codigo_categoria = $_REQUEST["codigo_categoria"];
// armando el Query.
$query = "SELECT p_u_m.codigo_unidad_medida, p_u_m.codigo_producto, p_u_m.codigo_categoria,
         cat_u_m.codigo, cat_u_m.descripcion
         FROM productos_unidad_medida p_u_m
         INNER JOIN catalogo_unidad_medida cat_u_m ON cat_u_m.codigo = p_u_m.codigo_unidad_medida
         WHERE p_u_m.codigo_producto = '$codigo_producto' and p_u_m.codigo_categoria = '$codigo_categoria'
         ORDER BY p_u_m.codigo_unidad_medida";
// Ejecutamos el Query.
   $consulta = $dblink -> query($query);
// Inicializando el array
$datos=array(); $fila_array = 0;
// Recorriendo la Tabla con PDO::
   while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
	{
      // Nombres de los campos de la tabla.
         $codigo = trim($listado['codigo']); $descripcion = trim($listado['descripcion']);
      // Rellenando la array.
         $datos[$fila_array]["codigo"] = $codigo;
         $datos[$fila_array]["descripcion"] = ($descripcion);
         $fila_array++;
   }
// Enviando la matriz con Json.
echo json_encode($datos);	
?>