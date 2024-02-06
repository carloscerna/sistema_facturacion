<?php
session_name('demoUI');
//session_start();
header("Content-Type: text/html;charset=iso-8859-1");
//header("Content-Type: text/html; charset=utf-8");
// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
$fila_array = 0;
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

// Validar conexión con la base de datos
if($errorDbConexion == false)
{
	// Validamos qe existan las variables post
	if(isset($_REQUEST) && !empty($_REQUEST))
	{
		if(!empty($_POST['accion_factura'])){
			$_POST['accion'] = $_POST['accion_factura'];
		}
		if(!empty($_POST['accion']))
		{
				// Verificamos las variables de acción
			switch ($_POST['accion']) {
				case 'VerProducto':
					// Armar query para verificar el número de líneas a imprimir.
					$query_l = "SELECT * FROM temp_codigo_barra";
						$resultado_l = $dblink -> query($query_l); // Ejecutar la Consulta.
							$numero_linea = $resultado_l -> rowCount();
								if($numero_linea !=0){
									$mensajeError = "Si Registro";
									$respuestaOK = true;
                                    DatosListado();
								}else{
									$mensajeError = "No Registro";
									$respuestaOK = false;
								}
				break;
			
				case 'GuardarDetalleCodigosBarra':
					$codigo_producto = $_POST['codigo_producto'];
					$cantidad = convertir_a_numero($_POST['cantidad']);;
					// Armar query para verificar el número de líneas a imprimir.
					$query_l = "SELECT * FROM temp_codigo_barra WHERE codigo_producto = '$codigo_producto'";
						$resultado_l = $dblink -> query($query_l); // Ejecutar la Consulta.
							$numero_linea = $resultado_l -> rowCount();
								if($numero_linea !=0){
									$mensajeError = "Registro Ya Existe";
									$respuestaOK = false;
								}else{
										// query para guaardar la información.
										$query = "INSERT INTO temp_codigo_barra (codigo_producto, cantidad)
											VALUES ('$codigo_producto','$cantidad')";
										// Ejecutamos el query
										$resultadoQuery = $dblink -> query($query);
										// Evaluar el Query.
										if($resultadoQuery == true){
											$respuestaOK = true;
											$mensajeError = "Si Registro";						
											// Llamar a la Función DatosListado()
												DatosListado();
										}									
								}
				break;
				
				case 'editarDetalleCantidad':
					$id_ = $_POST["id_"];
					// Armar query para verificar el número de líneas a imprimir.
					$query = "SELECT * FROM temp_codigo_barra WHERE id_ = '$id_'";
						$resultado = $dblink -> query($query); // Ejecutar la Consulta.
							// Evaluar el Query.
								if($resultado == true){
									$respuestaOK = true;
									$mensajeError = "Si Registro";
									
								    while($DetalleFacturaTemp = $resultado -> fetch(PDO::FETCH_BOTH))
											{
												$cantidad = trim($DetalleFacturaTemp['cantidad']);
												
												$datos[$fila_array]["cantidad"] = $cantidad;
												$fila_array++;
											}
								}
				break;
			
				case 'ActualizarCantidad':
					$id_ = trim($_POST['id_']);
					$cantidad = trim($_POST['cantidad']);
									
					// Armar query para actualizar.
					$query = "UPDATE temp_codigo_barra SET cantidad = '$cantidad' WHERE id_ = '$id_'";
					// Ejecutamos el Query.
					$consulta = $dblink -> query($query);
					// Verificar la consulta
					if($consulta == true){
						$respuestaOK = true;
						$contenidoOK = $query;
						$mensajeError =  'Si Registro';
							DatosListado();
					}else{
						$respuestaOK = false;
						$contenidoOK = $query;
						$mensajeError =  'No Registro';					
					}
				break;
		
				
			case 'eliminarDetalleCodigosBarra':
				// Armamos el query
				$query = sprintf("DELETE FROM temp_codigo_barra WHERE id_ = %s", $_POST['id_']);
				// Ejecutamos el query
					$count = $dblink -> exec($query);
				// Validamos que se haya actualizado el registro
				if($count != 0){
					$respuestaOK = true;
					$mensajeError = 'Si Registro';
					//$contenidoOK = 'Se ha Eliminado '.$count.' Registro(s).';
					// Llamar a la Función DatosListado()
							DatosListado();
				}else{
					$mensajeError = 'No Registro';
				}
				break;

				case 'EliminarTodos':
				// Armamos el query
				$query = sprintf("DELETE FROM temp_codigo_barra");
				// Ejecutamos el query
					$count = $dblink -> exec($query);
				// Validamos que se haya actualizado el registro
				if($count != 0){
					$respuestaOK = true;
					$mensajeError = 'Si Registro';
					// Llamar a la Función DatosListado()
							DatosListado();
				}else{
					$mensajeError = 'No Registro';
				}
				break;
			
			default:
				$mensajeError = 'Esta acción no se encuentra disponible';
			break;
			}
		}	// condición de la busqueda del nùmero de DUI.
	}
	else{
		$mensajeError = 'No se puede ejecutar la aplicación';
}
}
else{
	$mensajeError = 'No se puede establecer conexión con la base de datos';}

// Armamos array para convertir a JSON
$salidaJson = array("respuesta" => $respuestaOK,
		"mensaje" => $mensajeError,
		"contenido" => $contenidoOK
		);

if($_POST{'accion'} == 'editarDetalleCantidad'){
	echo json_encode($datos);
}else{
echo json_encode($salidaJson);
}
//////////////////////////////////////////////////////////////////////////////////////////////
// LISTADO PARA LOS DIFERENTES EVENTOS DE GUARDAR, MODIFICAR Y VER HISTORIAL.
//////////////////////////////////////////////////////////////////////////////////////////////
function DatosListado(){
	global $dblink, $respuestaOK, $mensajeError, $contenidoOK, $paginaActual, $lista, $num;
					$query_historial = "SELECT t.id_, t.codigo_producto, t.cantidad, cat_p.descripcion as nombre_producto
							FROM temp_codigo_barra t
							INNER JOIN catalogo_productos cat_p ON (cat_p.codigo_categoria || cat_p.codigo) = t.codigo_producto
                            ORDER BY t.codigo_producto";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_historial);
                            $num = 1;
                    ////////////////////////////////////////////////////////							
							    while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
							      {
								  // recopilar los valores de los campos.
								  $id_ = trim($listadoHistorial['id_']);
								  $codigo_producto = trim($listadoHistorial['codigo_producto']);
								  $nombre_producto = trim($listadoHistorial['nombre_producto']);
								  $cantidad = trim($listadoHistorial['cantidad']);

										$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_	
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
                                        .'<td class = centerTXT><a data-accion=editarDetalleCantidad class="btn btn-sm btn-info" href='.$listadoHistorial['id_'].' title="Editar"><span class="fa fa-edit"></span> </a>'
                                        .'<td><a data-accion=eliminarDetalleCodigosBarra class="btn btn-sm btn-warning" href='.$listadoHistorial['id_'].' title="Eliminar"><span class="fa fa-trash"></span> </a>'
										;
                                        $num++;
							      }
}
?>