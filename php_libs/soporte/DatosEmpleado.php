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
$mensajeError = "No se puede ejecutar la aplicaci�n";
$contenidoOK = "";
$fila_array = 0;
$datos = array();
$arreglo = array();
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexi�n a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

// Validar conexi�n con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_POST['accion_buscar'])){
			$_POST['accion'] = $_POST['accion_buscar'];
		}
		// Verificamos las variables de acci�n
		switch ($_POST['accion']) {	
		case 'BuscarTodos':
				// Armamos el query.
				$query = "SELECT p.id_personal, p.apellidos, p.nombres, 
						TRIM(cat_estatus.descripcion) as nombre_estatus
                        FROM personal p
                        INNER JOIN catalogo_estatus cat_estatus ON cat_estatus.codigo = p.codigo_estatus
                        ORDER BY p.apellidos, p.nombres ASC";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Validar si hay registros.
				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$num = 0;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
						$arreglo["data"][] = $listado;						
					}
					$mensajeError = "Si Registro";
				}
				else{
					$respuestaOK = true;
					$contenidoOK = '';
					$mensajeError =  'No Registro';
				}
			break;			
	
			case 'GuardarRegistro':
                $nombres = trim($_POST['txtNombres']);
                $apellidos = trim($_POST['txtApellidos']);
                $fecha_nacimiento = trim($_POST['txtFechaNacimiento']);
                $codigo_genero = trim($_POST['lstGenero']);
                $codigo_estado_civil = trim($_POST['lstEstadoCivil']);
				$codigo_afp = trim($_POST['lstAfp']);
                $codigo_departamento = trim($_POST['lstDepartamento']);
                $codigo_municipio = trim($_POST['lstMunicipio']);
				$direccion = trim($_POST['txtDireccion']);
				$codigo_estatus = trim($_POST['lstEstatus']);
                /// Armar query. PARA GUARDAR EL NUEVO REGISTRO SI PASA LA PRIMERA EVALUACI�N.
                    ///
                    $query = "INSERT INTO personal (nombres, apellidos,fecha_nacimiento, codigo_genero, codigo_estado_civil, codigo_afp, codigo_departamento, codigo_municipio,
								direccion, codigo_estatus)
                            VALUES ('$nombres','$apellidos','$fecha_nacimiento','$codigo_genero','$codigo_estado_civil','$codigo_afp',
								'$codigo_departamento','$codigo_municipio','$direccion','$codigo_estatus')";
                    // Ejecutamos el Query.
                    $consulta = $dblink -> query($query);
                    // Verificar la consulta
                    if($consulta == true){
                        $respuestaOK = true;
                        $contenidoOK = $query;
                        $mensajeError =  'Registro guardado.';
                    }else{
                        $respuestaOK = false;
                        $contenidoOK = $query;
                        $mensajeError =  'No se puede guardar el registro.';}
			break;
		
			case 'EditarRegistro':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT * FROM personal WHERE id_personal = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Inicializando el array
				   $datos=array(); $fila_array = 0;
				// Recorriendo la Tabla con PDO::
					$num = 1;
					    if($consulta -> rowCount() != 0){		
						while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
						  {
						      // recopilar los valores de los campos.
						      $id_ = trim($listado['id_personal']);
						      $nombres = trim($listado['nombres']);
                              $apellidos = trim($listado['apellidos']);
                              $fecha_nacimiento = cambiaf_a_normal(trim($listado['fecha_nacimiento']));
                              $codigo_genero = trim($listado['codigo_genero']);
							  $codigo_estado_civil = trim($listado['codigo_estado_civil']);
							  $codigo_afp = trim($listado['codigo_afp']);
							  $codigo_departamento = trim($listado['codigo_departamento']);
							  $codigo_municipio = trim($listado['codigo_municipio']);
							  $direccion = trim($listado['direccion']);
							  $codigo_estatus = trim($listado['codigo_estatus']);
							  //
							  $datos[$fila_array]["id_"] = $id_;
                              $datos[$fila_array]["nombres"] = $nombres;
                              $datos[$fila_array]["apellidos"] = $apellidos;
                              $datos[$fila_array]["fecha_nacimiento"] = $fecha_nacimiento;
                              $datos[$fila_array]["codigo_genero"] = $codigo_genero;
                              $datos[$fila_array]["codigo_estado_civil"] = $codigo_estado_civil;
                              $datos[$fila_array]["codigo_afp"] = $codigo_afp;
							  $datos[$fila_array]["codigo_departamento"] = $codigo_departamento;
							  $datos[$fila_array]["codigo_municipio"] = $codigo_municipio;
							  $datos[$fila_array]["direccion"] = $direccion;
                              $datos[$fila_array]["codigo_estatus"] = $codigo_estatus;
						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    else{
							$datos[$fila_array]["no_registros"] = '<tr><td> No se encontraron registros.</td>';
					    }
			break;
		
			case 'ActualizarRegistro':
				$id_ = trim($_POST['id_']);
				$nombres = trim($_POST['txtNombres']);
                $apellidos = trim($_POST['txtApellidos']);
                $fecha_nacimiento = trim($_POST['txtFechaNacimiento']);
                $codigo_genero = trim($_POST['lstGenero']);
                $codigo_estado_civil = trim($_POST['lstEstadoCivil']);
				$codigo_afp = trim($_POST['lstAfp']);
                $codigo_departamento = trim($_POST['lstDepartamento']);
                $codigo_municipio = trim($_POST['lstMunicipio']);
				$direccion = trim($_POST['txtDireccion']);
				$codigo_estatus = trim($_POST['lstEstatus']);
				// Armar query para actualizar.
				$query = "UPDATE personal SET nombres = '$nombres', apellidos = '$apellidos',
							fecha_nacimiento = '$fecha_nacimiento', codigo_genero = '$codigo_genero', 
							codigo_estado_civil = '$codigo_estado_civil', codigo_afp = '$codigo_afp', 
							codigo_departamento = '$codigo_departamento', codigo_municipio = '$codigo_municipio', 
							direccion = '$direccion', codigo_estatus = '$codigo_estatus' 
								WHERE id_personal = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Registro Actualizado';
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'Registro No Registro';					
				}
			break;
		
			case 'EliminarRegistro':
				$id_ = trim($_POST['id_']);

                $query_ = "DELETE FROM personal WHERE id_personal = '$id_'";
                // Ejecutamos el Query.
                    $consulta_ = $dblink -> query($query_);				
                        if($consulta_ -> rowCount() > 0){
                            $respuestaOK = false;
                            $contenidoOK = $query_;
                            $mensajeError = "Registro Eliminado";
                        }else{
							$respuestaOK = true;
							$contenidoOK = $query;
							$mensajeError =  'Registro No Eliminado.';
                        }
			break;
			default:
				$mensajeError = 'Esta acci�n no se encuentra disponible';
			break;
		}
	}
	else{
		$mensajeError = 'No se puede ejecutar la aplicaci�n';}
}
else{
	$mensajeError = 'No se puede establecer conexi�n con la base de datos';}
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