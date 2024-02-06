<?php
//session_name('demoUI');
//session_start();
// limpiar cache.
clearstatcache();
// Script para ejecutar AJAX
// cambiar a utf-8.
header("Content-Type: text/html;charset=iso-8859-1");
// Insertar y actualizar tabla de usuarios
sleep(0);

// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
$fila_array = 0;
$datos = array();
$arreglo = array();
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_POST['accion_unidad_medida'])){
			$_POST['accion'] = $_POST['accion_unidad_medida'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {	
			case 'GuardarRegistro':
                // variable para la tabla PRODUCTO UNIDAD DE MEDIDA.
                if(isset($_POST['codigo_unidad_medida'])){
                    $codigo_producto_unidad_medida = $_POST['codigo_unidad_medida'];
                    $codigo_producto = trim($_POST['codigo_producto']);
                    $codigo_categoria = trim($_POST['codigo_categoria']);
                    // ver si el registro existe
                    $query = "SELECT * FROM productos_unidad_medida WHERE codigo_producto = '$codigo_producto' and codigo_categoria = '$codigo_categoria' and codigo_unidad_medida = '$codigo_producto_unidad_medida[0]'";
                    // Ejecutamos el Query.
                    $consulta = $dblink -> query($query);
                    // Verificar la consulta
                    if($consulta -> rowCount() > 0){
                        $respuestaOK = false;
                        $contenidoOK = $query;
                        $mensajeError =  'Ya Existe';
                    }else{
                        // query PRODUCTO UNIDAD MEDIDIA.
                        $query_u = "INSERT INTO productos_unidad_medida (codigo_categoria, codigo_producto, codigo_unidad_medida) VALUES ('$codigo_categoria','$codigo_producto','$codigo_producto_unidad_medida[0]')";    
                        // Ejecutamos el Query.
                        $consulta_u = $dblink -> query($query_u);
                        $respuestaOK = true;
                        $contenidoOK = $query_u;
                        $mensajeError =  'Si Registro';					
                    }				
                }else{
                        $respuestaOK = false;
                        $contenidoOK = "";
                        $mensajeError = "No Seleccionado";                    
                }
                
			break;
						
			case 'EliminarRegistro':
                // variable para la tabla PRODUCTO UNIDAD DE MEDIDA.
                if(isset($_POST['codigo_unidad_medida'])){
                    $codigo_producto_unidad_medida = $_POST['codigo_unidad_medida'];
                    $codigo_producto = trim($_POST['codigo_producto']);
                    $codigo_categoria = trim($_POST['codigo_categoria']);
                    // ver si el registro existe
                    $query = "DELETE FROM productos_unidad_medida WHERE codigo_producto = '$codigo_producto' and codigo_categoria = '$codigo_categoria' and codigo_unidad_medida = '$codigo_producto_unidad_medida[0]'";
                    // Ejecutamos el Query.
                    $consulta = $dblink -> query($query);
                    // Verificar la consulta
                    if($consulta == true){
                        $respuestaOK = true;
                        $contenidoOK = $query;
                        $mensajeError =  'Si Eliminado';
                    }else{
                        $respuestaOK = false;
                        $contenidoOK = $query;
                        $mensajeError =  'No Eliminado';					
                    }				
                }else{
                        $respuestaOK = false;
                        $contenidoOK = "";
                        $mensajeError = "No Seleccionado";                    
                }
			break;

			default:
				$mensajeError = 'Esta acción no se encuentra disponible';
			break;
		}
	}
	else{
		$mensajeError = 'No se puede ejecutar la aplicación';}
}
else{
	$mensajeError = 'No se puede establecer conexión con la base de datos';}
// Salida de la Array con JSON.
	if($_POST["accion"] === "BuscarTodos" or $_POST["accion"] === "BuscarTodosCodigo"){
		echo json_encode($arreglo);	
	}elseif($_POST["accion"] === "BuscarCodigo" or $_POST["accion"] === "GenerarCodigoNuevo" or $_POST["accion"] === "EditarRegistro"){
		echo json_encode($datos);
		}
	else{
		// Armamos array para convertir a JSON
		$salidaJson = array("respuesta" => $respuestaOK,
			"mensaje" => $mensajeError,
			"contenido" => $contenidoOK);
		echo json_encode($salidaJson);
	}
?>