<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
// armando el Query.
$query = "select u.codigo_personal, u.codigo_perfil, p.nombres, p.apellidos, p.codigo_estatus
			from usuarios u 
			INNER JOIN personal p ON p.Id_personal = u.codigo_personal
				where u.codigo_perfil = '04' and p.codigo_estatus = '01'";
// Ejecutamos el Query.
   $consulta = $dblink -> query($query);
// Inicializando el array
$datos=array(); $fila_array = 0;
// Recorriendo la Tabla con PDO::
      while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
	{
         // Nombres de los campos de la tabla.
	 $codigo = trim($listado['codigo_personal']); $descripcion = trim($listado['nombres']) . ' ' . trim($listado['apellidos']);
	 // Rellenando la array.
         $datos[$fila_array]["codigo"] = $codigo;
		$datos[$fila_array]["descripcion"] = $descripcion;
	   $fila_array++;
        }
// Enviando la matriz con Json.
echo json_encode($datos);	
?>