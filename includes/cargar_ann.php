<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// Incluimos el archivo de funciones y conexi�n a la base de datos
    include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
// Inicializando el array
    $datos=array(); $fila_array = 0;
    /*for($i=date('o'); $i<=2025; $i++){
        // Rellenando la array.
            $datos[$fila_array]["codigo"] = $i;
            $datos[$fila_array]["descripcion"] = $i;
            $fila_array++;
    }*/
    //
    for ($i = 0; $i < 4; $i++) {
            $year = date('o') - $i;
        // Rellenando la array.
            $datos[$fila_array]["codigo"] = $year;
            $datos[$fila_array]["descripcion"] = $year;
            $fila_array++;

        }
// Enviando la matriz con Json.
    echo json_encode($datos);	
?>