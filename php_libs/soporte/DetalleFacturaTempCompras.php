<?php
session_name('demoUI');
//session_start();
header("Content-Type: text/html;charset=iso-8859-1");
//header("Content-Type: text/html; charset=utf-8");
// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
$subtotal = 0; $sumas_compras_exentas = 0; $sumas_compras_gravadas = 0; $compra_total = 0;
$iva = 0;
$total = 0;
$lista = "";
$descuento = 0;
$compra_total_descuento = 0;
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
				case 'VerDetalleFacturaTemp':
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_usuario = $_POST['codigo_usuario'];
						$respuestaOK = true;
						$mensajeError = "Si Registro";			
						DatosListado($codigo_usuario,$lista);
				break;
			
				case 'GuardarDetalleFacturaTemp':
					$compras_linea = $_POST["numero_linea"];
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
					$codigo_usuario = $_POST['codigo_usuario'];
					$codigo_producto = $_POST['codigo_producto'];
					$cantidad = convertir_a_numero($_POST['cantidad']);
					$precio = convertir_a_numero($_POST['precio']);
					$producto_exento = $_POST["producto_exento"];
					// Armar query para verificar el número de líneas a imprimir.
					$query_l = "SELECT * FROM temp_detalle_factura_compra WHERE id_session_usuario = '$codigo_usuario'";
						$resultado_l = $dblink -> query($query_l); // Ejecutar la Consulta.
							$numero_linea = $resultado_l -> rowCount();
								if($compras_linea == $numero_linea){
									$mensajeError = "No RegistroLinea";
									$respuestaOK = false;
								}else{
										// query para guaardar la información.
										$query = "INSERT INTO temp_detalle_factura_compra (cantidad_temp, codigo_producto_temp, precio_compra_temp, id_session_usuario, producto_exento)
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
					// Armar query para verificar el número de líneas a imprimir.
					$query = "SELECT * FROM temp_detalle_factura_compra WHERE id_temp = '$id_'";
						$resultado = $dblink -> query($query); // Ejecutar la Consulta.
							// Evaluar el Query.
								if($resultado == true){
									$respuestaOK = true;
									$mensajeError = "Si Registro";
									
								    while($DetalleFacturaTemp = $resultado -> fetch(PDO::FETCH_BOTH))
											{
												$cantidad = trim($DetalleFacturaTemp['cantidad_temp']);
												$precio_compra = number_format(trim($DetalleFacturaTemp['precio_compra_temp']),4);
												$codigo_producto = trim($DetalleFacturaTemp['codigo_producto_temp']);
												
												$datos[$fila_array]["cantidad"] = $cantidad;
												$datos[$fila_array]["precio_compra"] = $precio_compra;
												$fila_array++;
											}
								}
				break;
			
				case 'ActualizarTempDetalleFactura':
					$id_ = trim($_POST['id_']);
					$cantidad = trim($_POST['cantidad']);
					$precio_compra = trim($_POST['precio_compra']);
					$codigo_usuario = $_POST['codigo_usuario'];
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
									
					// Armar query para actualizar.
					$query = "UPDATE temp_detalle_factura_compra SET cantidad_temp = '$cantidad', precio_compra_temp = '$precio_compra' WHERE id_temp = '$id_'";
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
		
				case 'GuardarFacturaCompras':				
					// Variables para la tabla FACTURAS_VENTAS.
						$codigo_proveedor = $_POST['txtCodigoProveedorCompras'];
						$numero_factura = $_POST['txtNumeroFactura'];
						$fecha = $_POST["txtFechaCompra"];
						$codigo_vendedor = $_POST["lstCodigoVendedor"];
						$forma_pago = $_POST["lstFormaPago"];
						$codigo_tipo_factura = $_POST["lstTipoFactura"];
						$estado_factura = $_POST["estado_factura"];
                        // leemos el valor de $_POST['VALOR'] y le quitamos los .
                        $total_compra = convertir_a_numero($_POST['txtTotalCompra']);
						//$codigo_descuento = $_POST["lstDescuentoSVT"];
					// Armar query guardar datos en la tabla FACTURAS_VENTAS.
						$query = "INSERT INTO facturas_compras (codigo_proveedor, numero_factura, fecha, codigo_vendedor, codigo_forma_pago, estado_factura, total_compra, codigo_tipo_factura)
                        VALUES
                        ('$codigo_proveedor','$numero_factura','$fecha','$codigo_vendedor','$forma_pago','$estado_factura','$total_compra','$codigo_tipo_factura')";
					// Ejecutar Query
						$resultadoFV = $dblink -> query($query);
					// Variables para la tabla FACTURAS_DETALLES_VENTAS.
					// Extraerlo de la tabla que esta actualmente en base al codigo del venededor.
                        $query_guardar_factura = "SELECT id_temp, cantidad_temp, codigo_producto_temp, precio_compra_temp, id_session_usuario
							FROM temp_detalle_factura_compra WHERE id_session_usuario = '$codigo_vendedor'";
					// Ejecutamos el query
                        $resultadoDFT = $dblink -> query($query_guardar_factura);

					if($query_guardar_factura == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
					// INICIAL EL PROCESO DE GUARDAR LA FACTURA COMPRAS DE TEMP DETALLE FACTURAS COMPRAS.
					    while($DetalleFacturaTemp = $resultadoDFT -> fetch(PDO::FETCH_BOTH))
						{
							$cantidad = trim($DetalleFacturaTemp['cantidad_temp']);
							$codigo_producto = trim($DetalleFacturaTemp['codigo_producto_temp']);
							$precio_compra = trim($DetalleFacturaTemp['precio_compra_temp']);
							
							// Query para guardar en la tabla DETALLE_FACTURA.
								$query_ = "INSERT INTO facturas_detalles_compras (codigo_producto, numero_factura, cantidad, precio_compra, codigo_tipo_factura, codigo_proveedor)
                                VALUES ('$codigo_producto','$numero_factura','$cantidad','$precio_compra','$codigo_tipo_factura','$codigo_proveedor')";
							// Ejecutamos el query
							   $resultado_ = $dblink -> query($query_);
							// ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
                                            // obtener el precio actual.
                                            $precio_costo_actual = trim($listado['precio_costo']);
										}
                            // VALIDAR SI EL CODIGO ES CONSUMIDOR FINAL, CREDICTO FISCAL O NOTA DE CREDITO.
                            if($codigo_tipo_factura == '03'){
                                // RESTARA AL INVENTARIO
                                // 	validar la cantidada convertir.
                                    if($cantidad_convertir > 0){
                                        // Calcular la Existencia.
                                            $cantidad = ($cantidad * $cantidad_convertir);
                                        // Calcular el Nuevo Precio de Compra.
                                            $precio_compra = ($precio_compra / $cantidad_convertir);
                                                $query_existencia = "UPDATE catalogo_productos SET existencia = existencia - {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
                                                    $resultado_existencia = $dblink -> query($query_existencia);
                                    }else{
                                        // No se modifica la existencia ni el precio de costo.
                                        $query_existencia = "UPDATE catalogo_productos SET existencia = existencia - {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
                                        $resultado_existencia = $dblink -> query($query_existencia);}                                
                            }else{
                                // SUMARA AL INVENTARIO
                                // 	validar la cantidada convertir.
                                    if($cantidad_convertir > 0){
                                        // Calcular la Existencia.
                                            $cantidad = ($cantidad * $cantidad_convertir);
                                        // Calcular el Nuevo Precio de Compra.
                                            $precio_compra = ($precio_compra / $cantidad_convertir);
                                                $query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
                                                    $resultado_existencia = $dblink -> query($query_existencia);
								}else{
									// No se modifica la existencia ni el precio de costo.
									$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_existencia = $dblink -> query($query_existencia);}

                                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    // PROCESO PARA ACTUALIZAR LOS PRECIOS SEGUN EL PRODUCTOS_PORCENTAJE_PRECIO_VENTA
                                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    $query_por = "SELECT pppv.id_pro_por_precio_venta, pppv.codigo_producto, pppv.codigo_categoria, pppv.codigo_cat_pro_por_venta,
                                            cppv.descripcion, cppv.porcentaje, cppv.iva
                                            from productos_porcentaje_precio_venta pppv
                                            INNER JOIN catalogo_producto_porcentaje_venta cppv ON cppv.codigo = pppv.codigo_cat_pro_por_venta
                                            WHERE btrim(pppv.codigo_categoria || pppv.codigo_producto) = '$codigo_producto' order by cppv.codigo";
                                    // Ejecutamos el Query.
                                        $consulta_por = $dblink -> query($query_por);
                                    // Recorriendo la Tabla con PDO:: SE REPETIRA DEPENDIENDO CUANTOS REGISTRO TENGA EL PORCENTAJE DEL PRODUCTO.
                                        $calcular_uno = 0;
                                    // Preguntar si el producto existe.
                                        if($consulta_por == true){
                                                                                        //
                                            // Si no Existe Generar Escala.
                                            //
                                                while($listado = $consulta_por -> fetch(PDO::FETCH_BOTH))
                                                  {
                                                        /// PREGUNTAR SI HAY QUE MODFICA EL PRECIO DE COSTO
                                                        // EL CUAL CAMBIARA CUANDO SEA MAÑOR QUE EL PRECIO ACTUAL.
                                                            if($precio_compra > $precio_costo_actual){
                                                                  // Nombres de los campos de la tabla.
                                                                      $porcentaje = round($listado['porcentaje']/100,2); $iva = round($listado['iva']/100,2);
                                                                      $id_cppv = trim($listado['id_pro_por_precio_venta']);
                                                                  // Calcular el precio de venta. segun el primer porcentaje encontrado en la tabla productos porcentaje precio venta.
                                                                      $precio_venta_iva = ($precio_compra + ($precio_compra * $iva));
                                                                      $precio_venta = round($precio_venta_iva + ($precio_venta_iva * $porcentaje),2);                                                    
                                                                
                                                                // armar query para actualizar catalogo_productos PRECIO_VENTA, PRECIO COSTO.
                                                                      $query_uno_porcentaje = "UPDATE catalogo_productos SET precio_venta = {$precio_venta}, precio_costo = {$precio_compra} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
                                                                          $consulta_uno = $dblink -> query($query_uno_porcentaje);
                                                            }
                                                  }                                            
                                        }else{
                                            //
                                            // Si no Existe Generar Escala.
                                            //
                                                while($listado = $consulta_por -> fetch(PDO::FETCH_BOTH))
                                                  {
                                                      // Nombres de los campos de la tabla.
                                                          $porcentaje = round($listado['porcentaje']/100,2); $iva = round($listado['iva']/100,2);
                                                          $id_cppv = trim($listado['id_pro_por_precio_venta']);
                                                      // Calcular el precio de venta. segun el primer porcentaje encontrado en la tabla productos porcentaje precio venta.
                                                          $precio_venta_iva = ($precio_compra + ($precio_compra * $iva));
                                                          $precio_venta = round($precio_venta_iva + ($precio_venta_iva * $porcentaje),2);
                                                      // Sólo para actulizar un registro. de catalogo productos.
                                                      if($calcular_uno === 0){
                                                          // armar query para actualizar catalogo_productos PRECIO_VENTA, PRECIO COSTO.
                                                          $query_uno_porcentaje = "UPDATE catalogo_productos SET precio_venta = {$precio_venta}, precio_costo = {$precio_compra} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
                                                              $consulta_uno = $dblink -> query($query_uno_porcentaje);
                                                          // armar query para actualizar PRODUCTOS PORCENTAJE PRECIO VENTA, precio_venta.
                                                              $query_dos_porcentaje = "UPDATE productos_porcentaje_precio_venta SET precio_venta = {$precio_venta} WHERE (codigo_categoria || codigo_producto) = '$codigo_producto'";
                                                                  $consulta_dos = $dblink -> query($query_dos_porcentaje);
                                                      }
                                                          // armar query para actualizar PRODUCTOS PORCENTAJE PRECIO VENTA, precio_venta.
                                                              $query_dos_porcentaje = "UPDATE productos_porcentaje_precio_venta SET precio_venta = {$precio_venta} WHERE id_pro_por_precio_venta = '$id_cppv'";
                                                                  $consulta_dos = $dblink -> query($query_dos_porcentaje);
                                                      // variable para calcular el primer dato.
                                                      $calcular_uno++;
                                                  }                                            
                                        }
                            }   // condicion else que suma al inventario cuando el codigo tipo factura es igual a '01' o '02'
						}   // fin del while que recorre TEMP DETALLE FACTURA COMPRAS
                        /////////////////////////////////////////////////////
						// ELIMINAR EL CONTENIDO DE LA FACTURA DETALLE TEMP.
                        /////////////////////////////////////////////////////
							$query_e = "DELETE FROM temp_detalle_factura_compra WHERE id_session_usuario = '$codigo_vendedor'";
								$resultado_e = $dblink -> query($query_e);
					}		
					else{
						$mensajeError = "No Registro";
					}
					
				break;

				case 'VerificarNumeroFactura':
					$numero_factura = $_POST['numero_factura'];
					$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
                    $codigo_proveedor = $_POST['codigo_proveedor'];
					// Armar query.
					$query = "SELECT * FROM facturas_compras WHERE codigo_tipo_factura = '$codigo_tipo_factura' and numero_factura = '$numero_factura' and codigo_proveedor = '$codigo_proveedor'";
					// Ejecutamos el query
					$resultado = $dblink -> query($query);					
					if($resultado == true){
						$nroFactura = $resultado -> rowCount();
						if($nroFactura > 0){
							$respuestaOK = true;
							$mensajeError = "Si Registro";
						}else{
						$respuestaOK = false;
						$mensajeError = "No Registro";}
					}
					else{
						$mensajeError = "No Registro";
						$respuestaOK = false;
					}
				break;
			
			case 'eliminarDetalleFacturaTemp':
				$codigo_tipo_factura = $_POST['codigo_tipo_factura'];
				$codigo_usuario = $_POST['codigo_usuario'];
				// Armamos el query
				$query = sprintf("DELETE FROM temp_detalle_factura_compra WHERE id_temp = %s", $_POST['id_temp']);
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
		"contenido" => $contenidoOK,
		"lista" => $lista,
		"subtotal" => $subtotal,
		"iva" => $iva,
		"total" => $total,
		"sumas_compras_exentas" => $sumas_compras_exentas,
		"sumas_compras_gravadas" => $sumas_compras_gravadas,
		"compra_total" => $compra_total,
		"descuento" => $descuento,
		"compra_total_descuento" => $compra_total_descuento,
		);

if($_POST{'accion'} == 'editarDetalleFacturaTemp'){
	echo json_encode($datos);
}else{
echo json_encode($salidaJson);
}
//////////////////////////////////////////////////////////////////////////////////////////////
// LISTADO PARA LOS DIFERENTES EVENTOS DE GUARDAR, MODIFICAR Y VER HISTORIAL.
//////////////////////////////////////////////////////////////////////////////////////////////
function DatosListado($codigo_usuario,$lista){
	global $dblink, $respuestaOK, $mensajeError, $contenidoOK, $paginaActual, $lista,$subtotal, $iva, $total,$codigo_tipo_factura, $sumas_compras_exentas, $sumas_compras_gravadas, $compra_total, $descuento, $porcentaje, $compra_total_descuento;
					$query_historial = "SELECT t.id_temp, t.cantidad_temp, t.codigo_producto_temp, t.precio_compra_temp, t.precio_compra_temp as compra_exenta, t.id_session_usuario, t.producto_exento, cat_p.descripcion as nombre_producto_temp
							FROM temp_detalle_factura_compra t
							INNER JOIN catalogo_productos cat_p ON (cat_p.codigo_categoria || cat_p.codigo) = t.codigo_producto_temp
							WHERE t.id_session_usuario = '$codigo_usuario' ORDER BY t.id_temp";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_historial);	
						// Recorriendo la Tabla con PDO::
							$verdadero = ""; $num_registros = 0; $precio_unitario = 0; $compra_exenta = 0; $sumas_compras_exentas_procesar = 0; $sumas_compras_gravadas = 0;
                            $precio_unitario_sin_iva_procesar = 0; $precio_total_compras_gravadas_procesar = 0; $sumas_compras_gravadas_procesar =0; $sumas_compras_exentas = 0;
                            $precio_total_compras_exentas_procesar = 0;
                            $compra_total_procesar = 0; $iva_procesar = 0;
							$num_registros = $consulta_historial -> rowCount();
							$num = 1;
                    // FORMATO DE MONEDA.//////////////////////////////////////////////////////////////////////////////////////////////////////////
                            setlocale(LC_MONETARY,"en_US");
                    ////////////////////////////////////////////////////////
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
								  $precio_unitario = trim($listadoHistorial['precio_compra_temp']);
								  $compra_exenta = number_format(trim($listadoHistorial['compra_exenta']),4);
								  $producto_exento = trim($listadoHistorial['producto_exento']);
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_unitario = 0;}
									else{
										$compra_exenta = 0;}
								  // Calcula rel 13% depende del Tipo de Factura.
								  //	CONSUMIDOR FINAL ////////////////////////////////////////////////////////////////////////////////////
								  if($codigo_tipo_factura === "01"){
									// Pasar el precio a dos decimales.
									$precio_unitario = ($precio_unitario);
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_compras_exentas_procesar = $cantidad * $compra_exenta;
                                    $precio_total_compras_exentas = number_format($precio_total_compras_exentas_procesar,2,'.',',');
                                    // SEMAS EXENTAS
                                    $sumas_compras_exentas_procesar = $sumas_compras_exentas_procesar + $precio_total_compras_exentas_procesar;
									$sumas_compras_exentas = number_format($sumas_compras_exentas_procesar,2,'.',',');
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_total_compras_gravadas_procesar = $cantidad * $precio_unitario;
                                    $precio_total_compras_gravadas = number_format($precio_total_compras_gravadas_procesar,2,'.',',');
                                    /// SUMAS GRAVAS
                                    $sumas_compras_gravadas_procesar = ($sumas_compras_gravadas_procesar + $precio_total_compras_gravadas_procesar);
                                    $sumas_compras_gravadas = number_format($sumas_compras_gravadas_procesar,2,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$compra_total_procesar = ($sumas_compras_exentas_procesar + $sumas_compras_gravadas_procesar);
                                    $compra_total = number_format($compra_total_procesar,2,'.',',');                                   
								  // Validar cuando el producto es exento de iva.
								  if($producto_exento == "01"){
										$precio_total = $precio_total_compras_exentas_procesar;}
									else{
										$precio_total = $precio_total_compras_gravadas_procesar;}									
								  }else{
								//	CREDITO FISCAL ////////////////////////////////////////////////////////////////////////////////////
									// CALCULO DE VENTAS EXENTAS.
									$precio_total_compras_exentas_procesar = $cantidad * $compra_exenta;
                                    $precio_total_compras_exentas = number_format($precio_total_compras_exentas_procesar,2,'.',',');
                                    // SUMAS EXENTAS.
									$sumas_compras_exentas_procesar = ($sumas_compras_exentas_procesar + $precio_total_compras_exentas);
                                    $sumas_compras_exentas = number_format($sumas_compras_exentas_procesar,2,'.',',');
									// CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
									$precio_unitario_sin_iva_procesar = round($precio_unitario * 0.13,4);
                                    $precio_unitario_sin_iva = number_format(round($precio_unitario * 0.13,4),4,'.',',');
									$precio_total_compras_gravadas_procesar = round($cantidad * $precio_unitario,4);
                                    $precio_total_compras_gravadas = number_format($precio_total_compras_gravadas_procesar,4,'.',',');
                                    
									$sumas_compras_gravadas_procesar = ($sumas_compras_gravadas_procesar + $precio_total_compras_gravadas_procesar);
                                    $sumas_compras_gravadas = number_format($sumas_compras_gravadas_procesar,4,'.',',');
									$iva_procesar = $iva_procesar + (($precio_unitario_sin_iva_procesar) * $cantidad);
                                    $iva = number_format($iva_procesar,4,'.',',');
									// CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
									$compra_total_procesar = $sumas_compras_exentas_procesar + $sumas_compras_gravadas_procesar + $iva_procesar;
                                    $compra_total = number_format($compra_total_procesar,2,'.',',');
									// Validar cuando el producto es exento de iva.
									if($producto_exento == "01"){
                                            //money_format("%.2n", $cadena_numerica);
										  $precio_total = $precio_total_compras_exentas;}
									  else{
										  $precio_total = $precio_total_compras_gravadas;}
								  }
								  
								  // Antes de imprimir en pantalla evaluar si los valores estan a cero para dejar el espeacio en blanco.
								  if($precio_unitario == 0){$precio_unitario = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"> ';}else{$precio_unitario = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_unitario;}
								  if($compra_exenta == 0){$compra_exenta = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"> ';}else{$compra_exenta = '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$compra_exenta;}
								  // pasar a la matriz.
								  // VALIDAR EN QUE COLUMNA SE VA PRESENTAR EN PANTALLA.
								if($producto_exento == "01"){
										$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_temp	
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
										.$compra_exenta
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_total
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'
										.'<td class = centerTXT><a data-accion=editarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Editar"><span class="fa fa-edit"></span> </a>'
										.'<td><a data-accion=eliminarDetalleFacturaTemp class="btn btn-sm btn-warning" href='.$listadoHistorial['id_temp'].' title="Eliminar"><span class="fa fa-trash"></span> </a>'
										;}
								else{
										$contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$id_temp	
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo_producto
										.'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_producto
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$cantidad
										.$precio_unitario
										.$compra_exenta
										.'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$precio_total
										.'<td class = centerTXT><a data-accion=editarDetalleFacturaTemp class="btn btn-sm btn-info" href='.$listadoHistorial['id_temp'].' title="Editar"><span class="fa fa-edit"></span> </a>'
										.'<td><a data-accion=eliminarDetalleFacturaTemp class="btn btn-sm btn-warning" href='.$listadoHistorial['id_temp'].' title="Eliminar"><span class="fa fa-trash"></span> </a>'
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