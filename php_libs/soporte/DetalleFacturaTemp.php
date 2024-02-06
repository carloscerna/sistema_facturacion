<?php
session_name('demoUI');
//session_start();
header("Content-Type: text/html;charset=iso-8859-1");
//header("Content-Type: text/html; charset=utf-8");
// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
$subtotal = 0; $sumas_ventas_exentas = 0; $sumas_ventas_gravadas = 0; $venta_total = 0; $precio_total_ventas_exentas = 0; $precio_total_ventas_gravadas = 0;
$iva = 0;
$total = 0;
$lista = "";
$descuento = 0;
$venta_total_descuento = 0;
$datos = array();
$fila_array = 0;
$numero_linea = 0;
$resultado = array();
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
				case 'VerDetalleFacturaTemp':
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_usuario = $_POST['codigo_usuario'];
					$porcentaje = number_format($_POST['descuento'] / 100,2);
						$respuestaOK = true;
						$mensajeError = "Si Registro";			
						DatosListado($codigo_usuario,$lista);
				break;
			
				case 'GuardarDetalleFacturaTemp':
					$ventas_linea = $_POST["numero_linea"];
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_usuario = $_POST['codigo_usuario'];
					$codigo_producto = $_POST['codigo_producto'];
					$cantidad = convertir_a_numero($_POST['cantidad']);
					$precio = convertir_a_numero($_POST['precio']);
					$producto_exento = $_POST["producto_exento"];
					$porcentaje = number_format($_POST['descuento'] / 100,2);
					// Armar query para verificar el número de líneas a imprimir.
					$query_l = "SELECT * FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_usuario'";
						$resultado_l = $dblink -> query($query_l); // Ejecutar la Consulta.
							$numero_linea = $resultado_l -> rowCount();
								if($ventas_linea == $numero_linea){
									$mensajeError = "No RegistroLinea";
									$respuestaOK = false;
								}else{
										// query para guaardar la información.
										$query = "INSERT INTO temp_detalle_factura (cantidad_temp, codigo_producto_temp, precio_venta_temp, id_session_usuario, producto_exento)
											VALUES ('$cantidad','$codigo_producto','$precio','$codigo_usuario','$producto_exento')";
										// Ejecutamos el query
										$resultadoQuery = $dblink -> query($query);
										// Evaluar el Query.
										if($resultadoQuery == true){
											$respuestaOK = true;
											$mensajeError = "Si Registro";						
											// Llamar a la Función DatosListado()
												DatosListado($codigo_usuario,$lista);
										}									
								}
							

				break;
			
				case 'editarDetalleFacturaTemp':
					$id_ = $_POST["id_"];
                    $codigo_producto = $_POST["codigo_producto"];
						// obtener los porcentajes de descuento.
						// armando el Query.
						$query = "SELECT pppv.id_pro_por_precio_venta, pppv.codigo_producto, pppv.codigo_categoria, pppv.codigo_cat_pro_por_venta, pppv.precio_venta+pppv.precio_ajuste as precio_venta,
									cppv.descripcion, cppv.porcentaje, cppv.iva, pppv.precio_venta + pppv.precio_ajuste as precio
									from productos_porcentaje_precio_venta pppv
									INNER JOIN catalogo_producto_porcentaje_venta cppv ON cppv.codigo = pppv.codigo_cat_pro_por_venta
									WHERE btrim(pppv.codigo_categoria || pppv.codigo_producto) = '$codigo_producto' order by cppv.codigo";
						// Ejecutamos el Query.
						   $consulta = $dblink -> query($query);
						// Recorriendo la Tabla con PDO::
							  while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
								{
								 // Nombres de los campos de la tabla.
									 $precio_venta = trim($listado['precio_venta']); $descripcion = trim($listado['descripcion']);
								 // Rellenando la array.
									 $datos[$fila_array]["precio_venta"] = $precio_venta;
									 $datos[$fila_array]["descripcion"] = ($descripcion);
									   $fila_array++;
								}
				break;
				
				case 'BuscarPorcentajeProducto':
					$codigo_producto = $_POST["codigo_producto"];
						// obtener los porcentajes de descuento.
						// armando el Query.
						$query = "SELECT pppv.id_pro_por_precio_venta, pppv.codigo_producto, pppv.codigo_categoria, pppv.codigo_cat_pro_por_venta, pppv.precio_venta+pppv.precio_ajuste as precio_venta,
									cppv.descripcion, cppv.porcentaje, cppv.iva, pppv.precio_venta + pppv.precio_ajuste as precio
									from productos_porcentaje_precio_venta pppv
									INNER JOIN catalogo_producto_porcentaje_venta cppv ON cppv.codigo = pppv.codigo_cat_pro_por_venta
									WHERE btrim(pppv.codigo_categoria || pppv.codigo_producto) = '$codigo_producto' order by cppv.codigo";
						// Ejecutamos el Query.
						   $consulta = $dblink -> query($query);
						// Recorriendo la Tabla con PDO::
							  while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
								{
								 // Nombres de los campos de la tabla.
									 $precio_venta = trim($listado['precio']); $descripcion = trim($listado['descripcion']);
								 // Rellenando la array.
									 $datos[$fila_array]["precio_venta"] = $precio_venta;
									 $datos[$fila_array]["descripcion"] = ($descripcion);
									   $fila_array++;
								}
				break;
            // BOTON QUE SE ENCUENTRA EN LA TABLA TEMPPRODUCTOS.
			case 'ActualizarTempDetalleFactura':
				$id_ = trim($_POST['id_']);
				$cantidad = trim($_POST['cantidad']);
				$precio_venta = convertir_a_numero($_POST['precio_venta']);
				$codigo_usuario = $_POST['codigo_usuario'];
				$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
				$porcentaje = number_format($_POST['descuento'] / 100,2);

				// Armar query para actualizar.
				$query = "UPDATE temp_detalle_factura SET cantidad_temp = '$cantidad', precio_venta_temp = '$precio_venta' WHERE id_temp = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Registro';
						DatosListado($codigo_usuario,$lista);
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
				}
			break;

			case 'ActualizarUnidadMedida':
				$id_ = trim($_POST['id_']);
				$codigo_unidad_medida = trim($_POST['valor']);
                $cantidad_por = trim($_POST['cantidad_por']);
				// Armar query para actualizar.
				$query = "UPDATE temp_detalle_factura SET codigo_unidad_medida = '$codigo_unidad_medida', cantidad_por = '$cantidad_por' WHERE id_temp = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Registro';
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
				}
				break;
			
				case 'GuardarFacturaVentas':				
					// Variables para la tabla FACTURAS_VENTAS.
						$codigo_cliente = $_POST['codigo_cliente'];
						$numero_factura = $_POST['numero_factura'];
						$fecha = $_POST["txtFechaVenta"];
						$codigo_vendedor = $_POST["lstCodigoVendedor"];
						$forma_pago = $_POST["lstFormaPago"];
						$codigo_tipo_factura = $_POST["lstTipoFactura"];
						$estado_factura = $_POST["estado_factura"];
						$total_venta = convertir_a_numero($_POST["txtTotalVenta"]);
                        $descuento = convertir_a_numero($_POST["txtTotalVentaDescuento"]);
						$codigo_descuento = $_POST["lstDescuentoSVT"];
                        $numero_factura_real = $_POST["numero_factura_real"];
                        // Operar Venta - Descuento.
                        //$total_venta = $total_venta - $descuento;
					// Variables para la tabla FACTURAS_DETALLES_VENTAS.
					// Extraerlo de la tabla que esta actualmente en base al codigo del venededor.
					$query_guardar_factura = "SELECT id_temp, cantidad_temp, codigo_producto_temp, precio_venta_temp, id_session_usuario, cantidad_por, codigo_unidad_medida
							FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_vendedor'";
					// Ejecutamos el query
					$resultadoDFT = $dblink -> query($query_guardar_factura);
                    // Numero de lineas
                    $numero_linea = $resultadoDFT -> rowCount();
                    
                    if($query_guardar_factura == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
						// Armar query guardar datos en la tabla FACTURAS_VENTAS.
						$query = "INSERT INTO facturas_ventas (codigo_cliente, numero_factura, fecha, codigo_vendedor, codigo_forma_pago, estado_factura, total_venta, codigo_tipo_factura, codigo_descuento, numero_factura_real)
						VALUES ('$codigo_cliente','$numero_factura','$fecha','$codigo_vendedor','$forma_pago','$estado_factura','$total_venta','$codigo_tipo_factura','$codigo_descuento','$numero_factura_real')";
						// Ejecutar Query- FATURA VENTAS.
						$resultadoFV = $dblink -> query($query);
						// RECORRER LA TABLA TEMP DETALLE VENTAS PARA GUARDAR Y ACTUALIZAR INFORMACIÓN.
					    while($DetalleFacturaTemp = $resultadoDFT -> fetch(PDO::FETCH_BOTH))
						{
							$cantidad = trim($DetalleFacturaTemp['cantidad_temp']);
							$codigo_producto = trim($DetalleFacturaTemp['codigo_producto_temp']);
							$precio_venta = convertir_a_numero($DetalleFacturaTemp['precio_venta_temp']);
							$cantidad_por = trim($DetalleFacturaTemp['cantidad_por']);
                            $codigo_unidad_medida = trim($DetalleFacturaTemp['codigo_unidad_medida']);
							
							// Query para guardar en la tabla DETALLE_FACTURA.
								$query_ = "INSERT INTO facturas_detalles_ventas (codigo_producto, numero_factura, cantidad, precio_venta, codigo_tipo_factura, cantidad_por, numero_factura_real, codigo_unidad_medida)
								VALUES ('$codigo_producto','$numero_factura','$cantidad','$precio_venta','$codigo_tipo_factura','$cantidad_por','$numero_factura_real','$codigo_unidad_medida')";
							// Ejecutamos el query
							$resultado_ = $dblink -> query($query_);
							// ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
										}
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}

											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia - {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
								}else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia - {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}
						}
						// ELIMINAR EL CONTENIDO DE LA FACTURA DETALLE TEMP.
							$query_e = "DELETE FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_vendedor'";
								$resultado_e = $dblink -> query($query_e);
					}		
					else{
						$mensajeError = "No Registro";
					}
					
				break;

				case 'VerificarNumeroFactura':
					$numero_factura = $_POST['numero_factura'];
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
                    $numero_factura_real = $_POST['numero_factura_real'];
					// Armar query.
					$query = "SELECT * FROM facturas_ventas WHERE codigo_tipo_factura = '$codigo_tipo_factura' and numero_factura = '$numero_factura' and numero_factura_real = '$numero_factura_real'";
					// Ejecutamos el query
					$resultado = $dblink -> query($query);					
					if($resultado == true){
						$nroFactura = $resultado -> rowCount();
						if($nroFactura > 0){
							$respuestaOK = true;
							$mensajeError = "Si Registro";
                            $contenidoOK = $query;
						}else{
						$respuestaOK = false;
						$mensajeError = "No Registro";
                        $contenidoOK = $query;}
					}
					else{
						$mensajeError = "No Registro";
						$respuestaOK = false;
                        $contenidoOK = $query;
					}
				break;
			
			case 'eliminarDetalleFacturaTemp':
				$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
				$codigo_usuario = $_POST['codigo_usuario'];
                $porcentaje = number_format($_POST['descuento'] / 100,2);
				// Armamos el query
				$query = sprintf("DELETE FROM temp_detalle_factura WHERE id_temp = %s", $_POST['id_temp']);
				// Ejecutamos el query
					$count = $dblink -> exec($query);
				// Validamos que se haya actualizado el registro
				if($count != 0){
					$respuestaOK = true;
					$mensajeError = 'Si Registro';
					//$contenidoOK = 'Se ha Eliminado '.$count.' Registro(s).';
                    // Actualizar el total de registros.
					$query_t = "SELECT * FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_usuario'";
					// Ejecutamos el query
					$resultado_t = $dblink -> query($query_t);
                    $numero_linea = $resultado_t -> rowCount();
					// Llamar a la Función DatosListado()
							DatosListado($codigo_usuario,$lista);
				}else{
					$mensajeError = 'No Registro';
				}
				break;

				case 'EliminarDetalleFacturaTempTodo':
				$codigo_usuario = $_POST['codigo_usuario'];
				// Armamos el query
				$query = sprintf("DELETE FROM temp_detalle_factura WHERE id_session_usuario = %s", $codigo_usuario);
				// Ejecutamos el query
					$count = $dblink -> exec($query);
				// Validamos que se haya actualizado el registro
				if($count != 0){
					$respuestaOK = true;
					$mensajeError = 'Si Registro';
					//$contenidoOK = 'Se ha Eliminado '.$count.' Registro(s).';
                    
                    // Actualizar el total de registros.
					$query_t = "SELECT * FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_usuario'";
					// Ejecutamos el query
					$resultado_t = $dblink -> query($query_t);
                    $numero_linea = $resultado_t -> rowCount();
					// Llamar a la Función DatosListado()
							DatosListado($codigo_usuario,$lista);
                            
				}else{
					$mensajeError = 'No Registro';
				}
				break;

				case 'BuscarVendedor':
                    $codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_vendedor = $_POST['codigo_vendedor'];
                    $codigo_usuario = $codigo_vendedor;
					// Armar query.
					$query = "SELECT * FROM temp_detalle_factura WHERE id_session_usuario = '$codigo_vendedor'";
					// Ejecutamos el query
					$resultado = $dblink -> query($query);
                    $numero_linea = $resultado -> rowCount();
					if($resultado == true){
						$numero_vendedor = $resultado -> rowCount();
						if($numero_vendedor > 0){
							$respuestaOK = true;
							$mensajeError = "Si Registro";
                            DatosListado($codigo_usuario,$lista);
						}else{
						$respuestaOK = false;
						$mensajeError = "No Registro";}
					}
					else{
						$mensajeError = "No Registro";
						$respuestaOK = false;
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
		"contenido" => $contenidoOK,
		"lista" => $lista,
		"subtotal" => $subtotal,
		"iva" => $iva,
		"total" => $total,
		"sumas_ventas_exentas" => $sumas_ventas_exentas,
		"sumas_ventas_gravadas" => $sumas_ventas_gravadas,
		"venta_total" => $venta_total,
		"descuento" => $descuento,
		"venta_total_descuento" => $venta_total_descuento,
		"numero_linea" => $numero_linea,
		);

if($_POST['accion'] == 'editarDetalleFacturaTemp' or $_POST['accion'] == 'BuscarPorcentajeProducto' or $_POST['accion'] == 'ActualizarCantidadPorCheck'){
	echo json_encode($datos);
}else{
	echo json_encode($salidaJson);
}
//////////////////////////////////////////////////////////////////////////////////////////////
// LISTADO PARA LOS DIFERENTES EVENTOS DE GUARDAR, MODIFICAR Y VER HISTORIAL.
//////////////////////////////////////////////////////////////////////////////////////////////
function DatosListado($codigo_usuario,$lista){
	global $venta_exenta, $dblink, $respuestaOK, $mensajeError, $contenidoOK, $paginaActual, $lista,$subtotal, $iva, $iva_procesar, $total, $numero_linea;
    global $codigo_tipo_factura, $sumas_ventas_exentas, $sumas_ventas_gravadas, $venta_total, $descuento, $porcentaje, $venta_total_descuento;
    global $precio_total_ventas_gravadas, $precio_total_ventas_exentas, $sumas_ventas_exentas_procesar, $sumas_ventas_gravadas_procesar;

					$query_historial = "SELECT t.id_temp, t.cantidad_temp, t.codigo_producto_temp, t.precio_venta_temp, t.precio_venta_temp as venta_exenta, t.id_session_usuario, t.producto_exento, cat_p.descripcion as nombre_producto_temp, t.cantidad_por, t.codigo_unidad_medida
							FROM temp_detalle_factura t
							INNER JOIN catalogo_productos cat_p ON (cat_p.codigo_categoria || cat_p.codigo) = t.codigo_producto_temp
							WHERE t.id_session_usuario = '$codigo_usuario' ORDER BY t.id_temp";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_historial);	
							$numero_linea = $consulta_historial -> rowCount();
						// Recorriendo la Tabla con PDO::
							$verdadero = ""; $num_registros = 0; $precio_unitario = 0; $venta_exenta = 0;
							$num_registros = $consulta_historial -> rowCount();
							$num = 1;

							if($num_registros !=0){
							// cambiar el valor de las variables
								$fondo = array("info","success"); $num_fondo = 0;
								$respuestaOK = true;
								$mensajeError = "Si Registro";
								
							    while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
							      {
									// color del fondo de cada fila.
									if($num_fondo == 0){$num_fondo = 1;}else{$num_fondo = 0;}
								  // recopilar los valores de los campos.
								  $id_temp = trim($listadoHistorial['id_temp']);
								  $codigo_producto = trim($listadoHistorial['codigo_producto_temp']);
								  $nombre_producto = trim($listadoHistorial['nombre_producto_temp']);
								  $cantidad = trim($listadoHistorial['cantidad_temp']);
								  $precio_unitario = trim($listadoHistorial['precio_venta_temp']);
								  $venta_exenta = number_format(trim($listadoHistorial['venta_exenta']),4);
								  $producto_exento = trim($listadoHistorial['producto_exento']);
                                  $codigo_unidad_medida = trim($listadoHistorial['codigo_unidad_medida']);
                                  // RELLENAR SELECT POR PORDUCTO. UNIDAD DE MEDIDA.
                                  $query_unidad_medida = "select pum.codigo_categoria, pum.codigo_producto,  pum.codigo_unidad_medida, cat_um.codigo, cat_um.descripcion
                                                            from productos_unidad_medida pum 
                                                            INNER JOIN catalogo_unidad_medida cat_um ON cat_um.codigo = pum.codigo_unidad_medida 
                                                            where btrim(pum.codigo_categoria || pum.codigo_producto) = '$codigo_producto'";
                                                            
                                  $select_u = '<select class="form-control form-control-sm" name='.$id_temp.' id=c'.$id_temp.' data-accion-um=ActualizarUnidadMedida>';
                                    $consulta_unidad_medida = $dblink -> query($query_unidad_medida);
                                  	    while($listadoUM = $consulta_unidad_medida -> fetch(PDO::FETCH_BOTH))
                                        {
                                            $codigo = trim($listadoUM['codigo']);
                                            $descripcion = trim($listadoUM['descripcion']);
                                            
                                            if($codigo_unidad_medida == $codigo){
                                                $select_u .="<option value=$codigo selected>".$descripcion;
                                            }else{
                                                $select_u .="<option value=$codigo>".$descripcion;
                                            }
                                        }
                                    $select_u .='</select>';
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_unitario = 0;}
									else{
										$venta_exenta = 0;}
								  // Calcula rel 13% depende del Tipo de Factura.
								  //	CONSUMIDOR FINAL ////////////////////////////////////////////////////////////////////////////////////
								  if($codigo_tipo_factura === "01"){
									// Pasar el precio a dos decimales.
									$precio_unitario = ($precio_unitario);
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_ventas_exentas_procesar = $cantidad * $venta_exenta;
                                    $precio_total_ventas_exentas = number_format($precio_total_ventas_exentas_procesar,2,'.',',');
                                    // SEMAS EXENTAS
                                    $sumas_ventas_exentas_procesar = $sumas_ventas_exentas_procesar + $precio_total_ventas_exentas_procesar;
									$sumas_ventas_exentas = number_format($sumas_ventas_exentas_procesar,2,'.',',');
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_total_ventas_gravadas_procesar = $cantidad * $precio_unitario;
                                    $precio_total_ventas_gravadas = number_format($precio_total_ventas_gravadas_procesar,2,'.',',');
                                    /// SUMAS GRAVAS
                                    $sumas_ventas_gravadas_procesar = ($sumas_ventas_gravadas_procesar + $precio_total_ventas_gravadas_procesar);
                                    $sumas_ventas_gravadas = number_format($sumas_ventas_gravadas_procesar,2,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$venta_total_procesar = ($sumas_ventas_exentas_procesar + $sumas_ventas_gravadas_procesar);
                                    $venta_total = number_format($venta_total_procesar,2,'.',',');                                        
                                    
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$descuento = number_format($venta_total_procesar * $porcentaje,2);
									$venta_total_descuento = number_format($venta_total_procesar - $descuento,2);
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_total = $precio_total_ventas_exentas;}
									else{
										$precio_total = $precio_total_ventas_gravadas;}									
								  }else{
								//	CREDITO FISCAL ////////////////////////////////////////////////////////////////////////////////////
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_ventas_exentas_procesar = $cantidad * $venta_exenta;
                                    $precio_total_ventas_exentas = number_format($precio_total_ventas_exentas_procesar,2,'.',',');
                                    // SEMAS EXENTAS
                                    $sumas_ventas_exentas_procesar = $sumas_ventas_exentas_procesar + $precio_total_ventas_exentas_procesar;
									$sumas_ventas_exentas = number_format($sumas_ventas_exentas_procesar,2,'.',',');                                    
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_unitario_sin_iva_procesar = round($precio_unitario / 1.13,4);
                                    $precio_unitario_sin_iva = number_format($precio_unitario_sin_iva_procesar,4,'.',',');
									$precio_total_ventas_gravadas_procesar = round($cantidad * $precio_unitario_sin_iva_procesar,4);
                                    $precio_total_ventas_gravadas = number_format($precio_total_ventas_gravadas_procesar,4,'.',',');
                                    
									$sumas_ventas_gravadas_procesar = ($sumas_ventas_gravadas_procesar + $precio_total_ventas_gravadas_procesar);
                                    $sumas_ventas_gravadas = number_format($sumas_ventas_gravadas_procesar,4,'.',',');
                                    $iva_procesar = $iva_procesar + ($precio_total_ventas_gravadas_procesar * 0.13);
                                    $iva = number_format($iva_procesar,4,'.',',');
									$precio_unitario = $precio_unitario_sin_iva_procesar;
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$venta_total_procesar = ($sumas_ventas_exentas_procesar + $sumas_ventas_gravadas_procesar + $iva_procesar);
                                    $venta_total = number_format($venta_total_procesar,2,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$descuento = number_format($venta_total_procesar * $porcentaje,2);
									$venta_total_descuento = number_format($venta_total_procesar - $descuento,2);
									// Validar cuando el producto es exento de iva.
									if($producto_exento == "01"){
										  $precio_total = $precio_total_ventas_exentas;}
									  else{
										  $precio_total = $precio_total_ventas_gravadas;}
								  }
								  
								  // Antes de imprimir en pantalla evaluar si los valores estan a cero para dejar el espeacio en blanco.
								  if($precio_unitario == 0){$precio_unitario = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"> ';}else{$precio_unitario = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_unitario;}
								  if($venta_exenta == 0){$venta_exenta = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"> ';}else{$venta_exenta = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$venta_exenta;}								  
								// pasar a la matriz.
								// VALIDAR EN QUE COLUMNA SE VA PRESENTAR EN PANTALLA.
								if($producto_exento == "01"){
                                    	$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_temp	
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
										.'<td align=center class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$select_u
										.$venta_exenta
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_total
										.'<td>'
										.'<td class = centerTXT><a data-accion=editarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Editar"><span class="fa fa-edit"></span> </a>'
										.'<td><a data-accion=eliminarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Eliminar"><span class="fa fa-trash"></span> </a>'
										;}
								else{
                                    	$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_temp	
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
										.'<td align=center class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
                                        .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$select_u
										.$precio_unitario
										.$venta_exenta
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_total
										.'<td class = centerTXT><a data-accion=editarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Editar"><span class="fa fa-edit"></span> </a>'
										.'<td><a data-accion=eliminarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Eliminar"><span class="fa fa-trash"></span> </a>'
										;									
								}
										$num++;									
										  }
							}
							else{
								$contenidoOK = 'No hay registros de este usuario...';
								$mensajeError = "No Registro";
							}
}
?>