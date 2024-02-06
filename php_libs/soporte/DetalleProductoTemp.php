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
$tabla = "";
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
				case 'verDetalleProducto':
                        $query = "SELECT * FROM catalogo_productos";
                        $result_i = $dblink -> query($query);
                            if($result_i -> rowCount() != 0){
                                $respuestaOK = true;
                                $mensajeError = "Si Registro";			                                
                            }

				break;
			
				case 'GuardarDetalleProducto':
					$codigo_producto = $_POST['codigo_producto'];
                    $fecha = $_POST['fecha'];
                    $partes = explode('/', $fecha);
                    $tabla = $_POST['tabla'];
                    
                    // LIMPIAR TABLA
                        $query_limpiar = "DELETE FROM temp_detalle_producto";
                        $result_limpiar = $dblink -> query($query_limpiar);						
                    //
                     // CONSULTA LA TABLA INVENTARIO AJUSTE
                     //
                     if($tabla == "ajuste"){
                        $query_i = "SELECT pi.codigo_producto, pi.descripcion, pi.fecha, pi.cantidad, pi.precio, cat_pro.descripcion as nombre_producto
                                  FROM productos_inventario_ajuste pi
                                  INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = '$codigo_producto'
                                  WHERE pi.codigo_producto = '$codigo_producto' and extract(year from fecha) = $partes[2]";
                     }
                     
                     if($tabla == "detalle-venta"){
                        $query_i = "SELECT * FROM catalogo_productos where btrim(codigo_categoria || codigo) = '$codigo_producto'";
                                  
                        }
                        
                      $result_i = $dblink -> query($query_i);
                      
                      if($result_i -> rowCount() != 0){
                        // Extraer saldoe de la consulta.
                           while($row_ = $result_i -> fetch(PDO::FETCH_BOTH))
                            {
                                // TABLA PRODUCTOS INVENTARIO AJUSTE.
                                if($tabla == "ajuste"){
                                    $codigo_producto = trim($row_["codigo_producto"]);
                                    $descripcion = (trim($row_["descripcion"]));
                                    $descripcion_inventario = (trim($row_["descripcion"]));
                                    $fecha = trim($row_["fecha"]);
                                    $existencia = (int)$row_["cantidad"];
                                        //
                                        //  Grabar en la tabla temp_detalle_producto.
                                        //
                                          $query_inventario = "INSERT INTO temp_detalle_producto (fecha, codigo_producto, descripcion, cantidad)
                                                            VALUES ('$fecha','$codigo_producto','$descripcion','$existencia')";
                                          $result_inventario = $dblink -> query($query_inventario);                                    
                                }
                                
                                // TABLA PRODUCTOS INVENTARIO AJUSTE.
                                if($tabla == "detalle-venta"){
                                    $codigo_producto = trim($row_["codigo_categoria"]) . trim($row_["codigo"]);;
                                    $descripcion = (trim($row_["descripcion"]));
                                    $descripcion_inventario = "Sòlo consulta tabla Ventas y Compras";
                                    $existencia = (int)$row_["existencia"];
                                        //
                                        //  Grabar en la tabla temp_detalle_producto.
                                        //
                                          $query_inventario = "INSERT INTO temp_detalle_producto (fecha, codigo_producto, descripcion, cantidad)
                                                            VALUES ('$fecha','$codigo_producto','$descripcion','$existencia')";
                                          $result_inventario = $dblink -> query($query_inventario);                                    
                                }
                                
                            }   //  FIN DEL WHILE de PRODUCTOS INVENTARIO AJUSTE.
                         
                         	$respuestaOK = true;
                            $mensajeError = "Si Registro";
                            DatosListado();
                         } // DEL WHILE INVENTARIO AJUSTE.
                            
				break;
				
				case 'editarDetalleCantidad':
					$id_ = $_POST["id_"];
					// Armar query para verificar el número de líneas a imprimir.
					$query = "SELECT * FROM temp_detalle_producto WHERE id_detalle_producto = '$id_'";
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
					$query = "UPDATE temp_detalle_producto SET cantidad = '$cantidad' WHERE id_detalle_producto = '$id_'";
					// Ejecutamos el Query.
					$consulta = $dblink -> query($query);
					// Verificar la consulta
					if($consulta == true){
						$respuestaOK = true;
						$contenidoOK = $query;
						$mensajeError =  'Si Registro';
                            //  Actualizar PRODUCTOS INVENTARIO AJUSTES.
                            $query = "SELECT * FROM temp_detalle_producto WHERE id_detalle_producto = '$id_'";
                            // Ejecutamos el Query.
                            $resultado = $dblink -> query($query);
								    while($DetalleProducto = $resultado -> fetch(PDO::FETCH_BOTH))
											{
												$cantidad = trim($DetalleProducto['cantidad']);
												$codigo_producto = trim($DetalleProducto['codigo_producto']);
                                                $fecha = trim($DetalleProducto['fecha']);
                                                
                                                $query_u = "UPDATE productos_inventario_ajuste SET cantidad = '$cantidad' WHERE codigo_producto = '$codigo_producto' and fecha = '$fecha'";
                                                // Ejecutamos el Query.
                                                $resultado_u = $dblink -> query($query_u);                                                
											}					
                    
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

				case 'EliminarDetalleFacturaTempTodo':
				$codigo_usuario = $_POST['codigo_usuario'];
				// Armamos el query
				$query = sprintf("DELETE FROM temp_detalle_factura_compra WHERE id_session_usuario = %s", $codigo_usuario);
				// Ejecutamos el query
					$count = $dblink -> exec($query);
				// Validamos que se haya actualizado el registro
				if($count != 0){
					$respuestaOK = true;
					$mensajeError = 'Si Registro';
					//$contenidoOK = 'Se ha Eliminado '.$count.' Registro(s).';
					// Llamar a la Función DatosListado()
							DatosListado($codigo_usuario,$lista);
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
	global $dblink, $respuestaOK, $mensajeError, $contenidoOK, $paginaActual, $lista, $num, $tabla;
					$query_historial = "SELECT t.id_detalle_producto, t.fecha, t.codigo_producto, t.cantidad, t.descripcion as descripcion_movimiento, cat_p.descripcion as nombre_producto
							FROM temp_detalle_producto t
							INNER JOIN catalogo_productos cat_p ON (cat_p.codigo_categoria || cat_p.codigo) = t.codigo_producto
                            ORDER BY t.codigo_producto";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_historial);
                            $num = 1;
                    ////////////////////////////////////////////////////////							
							    while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
							      {
								  // recopilar los valores de los campos.
                                    $id_ = trim($listadoHistorial['id_detalle_producto']);
                                    $fecha = trim($listadoHistorial['fecha']);
                                    $codigo_producto = trim($listadoHistorial['codigo_producto']);
                                    $descripcion = trim($listadoHistorial['descripcion_movimiento']);  
                                    $nombre_producto = trim($listadoHistorial['nombre_producto']);
                                    $cantidad = trim($listadoHistorial['cantidad']);

										$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_
                                        .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$fecha
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
                                        .'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$descripcion
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
                                        .'<td class = centerTXT><a data-accion=editarDetalleCantidad class="btn btn-sm btn-info" href='.$listadoHistorial['id_detalle_producto'].' title="Editar"><span class="fa fa-edit"></span> </a>'
                                        .'<td class = centerTXT><a data-accion=verDetalleProducto class="btn btn-sm btn-info" href='.$listadoHistorial['codigo_producto'].' title="Editar"><span class="fa fa-search"></span> </a>'
										;
                                        $num++;
							      }
}
?>