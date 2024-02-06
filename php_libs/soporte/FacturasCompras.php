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
// variables para la tabla editar compra
$codigo_proveedor = "";
$nombre_proveedor = "";
$total_compra = 0;
$numero_factura = "";
$cantidad_calculada = 0;
$codigo_tipo_factura = "";
$fecha = "";
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_POST['accion_buscar'])){
			$_POST['accion'] = $_POST['accion_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {	
		case 'BuscarTodos':
				// Armamos el query.
				$query = "SELECT fac_c.id_compras, to_char(fac_c.fecha,'DD/MM/YYYY') as fecha, fac_c.numero_factura, fac_c.codigo_tipo_factura,
                        to_char(fac_c.total_compra,'$9,999,999.00') as total_compra, fac_c.estado_factura, fac_c.codigo_proveedor,
                        CONCAT(p.nombre,' ',p.nombre_empresa) as nombre_completo, fac_c.codigo_proveedor,
                            CASE
                            	WHEN(fac_c.codigo_tipo_factura = '01') THEN btrim(fac_c.codigo_tipo_factura || '-CF')
                                WHEN(fac_c.codigo_tipo_factura = '02') THEN btrim(fac_c.codigo_tipo_factura || '-CCF')
                                WHEN(fac_c.codigo_tipo_factura = '03') THEN btrim(fac_c.codigo_tipo_factura || '-NC')
                            END AS c_tipo_f
                        FROM facturas_compras fac_c
                        INNER JOIN proveedores p ON p.codigo = fac_c.codigo_proveedor
                        ORDER BY fac_c.fecha ASC";
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
        
            case 'ActualizarFecha':
                $id_ = trim($_POST['id_']);
                $fecha = trim($_POST['fecha']);
            // actualizar fecha
        		$query_c = "UPDATE facturas_compras SET fecha = '$fecha' WHERE id_compras = '$id_'";
                $resultado_c = $dblink -> query($query_c);
            
                if($resultado_c == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
                        $contenidoOK = $query_c;
                }
                else{
						$respuestaOK = true;
						$mensajeError = "No Registro";
                        $contenidoOK = $query_c;
                }
            break;
	
			case 'GuardarDetalleFacturaCompra':
				$numero_factura = trim($_POST['numero_factura']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
				$cantidad = trim($_POST['cantidad']);
                $precio = convertir_a_numero($_POST['precio']);
				$codigo_producto = trim($_POST['codigo_producto']);
                $codigo_tipo_factura = trim($_POST['codigo_tipo_factura']);
                
                $query = "INSERT INTO facturas_detalles_compras (numero_factura, codigo_proveedor, cantidad, precio_compra, codigo_producto, codigo_tipo_factura)
                        VALUES ('$numero_factura','$codigo_proveedor','$cantidad','$precio','$codigo_producto','$codigo_tipo_factura')";
                $consulta = $dblink -> query($query);
                if($query == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
                        
                            // ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
										}
                            if($codigo_tipo_factura == "03"){
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
                                    }else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }else{
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
								}else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }   // ELSE que valida si es nota de credito.
                                // refrescar la tabla.    
                                DatosFacturasCompras();
                }
			break;
            
			case 'EditarRegistro':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT id_compras, fecha, numero_factura, estado_factura FROM facturas_compras WHERE id_compras = '$id_'
					";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Inicializando el array
				   //$datos=array(); $fila_array = 0;
				// Recorriendo la Tabla con PDO::
					$num = 1;
					    if($consulta -> rowCount() != 0){		
						while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
						  {
						      // recopilar los valores de los campos.
						      $id_compras = trim($listado['id_compras']);
						      $fecha = trim($listado['fecha']);
							  $numero_factura = trim($listado['numero_factura']);
							  $estado_factura = trim($listado['estado_factura']);
							  //
							  $datos[$fila_array]["id_compras"] = $id_compras;
							  $datos[$fila_array]["fecha"] = $fecha;
							  $datos[$fila_array]["numero_factura"] = $numero_factura;
							  $datos[$fila_array]["estado_factura"] = $estado_factura;
						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    else{
							$datos[$fila_array]["no_registros"] = '<tr><td> No se encontraron registros.</td>';
					    }
			break;

            // Se Utiliza para eliminar la factura.
			case 'EliminarRegistro':
				$id_ = trim($_POST['id_']);
				$numero_factura = trim($_POST['numero_factura']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
                $cantidad_por = 0;
                
				// Armar query. PARA ELIMINAR LA FACTURA DE FACTURAS VENTAS.
				$query = "DELETE FROM facturas_compras WHERE id_compras = '$id_' and numero_factura = '$numero_factura'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);				
				// Variables para la tabla FACTURAS_DETALLES_VENTAS.
					// buscarmos los registros existentes en la tabla.
					$query_buscar_factura = "SELECT codigo_producto, cantidad, codigo_tipo_factura
							FROM facturas_detalles_compras WHERE numero_factura = '$numero_factura' and codigo_proveedor = '$codigo_proveedor'";
					// Ejecutamos el query
					$resultadoDFT = $dblink -> query($query_buscar_factura);

					if($query_buscar_factura == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
						
					    while($DetalleFacturaTemp = $resultadoDFT -> fetch(PDO::FETCH_BOTH))
						{
							$cantidad = trim($DetalleFacturaTemp['cantidad']);
							$codigo_producto = trim($DetalleFacturaTemp['codigo_producto']);
                            $codigo_tipo_factura = trim($DetalleFacturaTemp['codigo_tipo_factura']);

							// ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
										}
                            if($codigo_tipo_factura == "03"){
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
                                    }else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }else{
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
                            }   // ELSE que valida si es nota de credito.
						}   // recorre la tabla TEMP DETALLE COMPRAS
						// ELIMINAR EL CONTENIDO DE LA FACTURA DETALLES VENTAS.
							$query_e = "DELETE FROM facturas_detalles_compras WHERE numero_factura = '$numero_factura' and codigo_proveedor = '$codigo_proveedor'";
								$resultado_e = $dblink -> query($query_e);
					}		
					else{
						$mensajeError = "No Registro";
					}
			break;
        ///
        /// ACCIONES PARA EL DETALLE DE LA FACTURA
        ///
			case 'VerFacturaCompra':
				$numero_factura = trim($_POST['numero_factura']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
                    DatosFacturasCompras();
			break;
        
            case 'ActualizarCodigoProveedor':
                $id_detalle_factura_compra = trim($_POST['id_detalle_factura_compra']);
                $nuevo_codigo_proveedor = trim($_POST['nuevo_codigo_proveedor']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
                $numero_factura = trim($_POST['numero_factura']);
                
                $query = "UPDATE facturas_detalles_compras SET codigo_proveedor = '$nuevo_codigo_proveedor' WHERE id_detalle = '$id_detalle_factura_compra'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
                DatosFacturasCompras();
            break;
        
            case 'VerProductoFactura':
                $id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT  fac_d_c.codigo_producto, cat_pro.descripcion, fac_d_c.cantidad, fac_d_c.id_detalle, fac_d_c.precio_compra
                            FROM facturas_detalles_compras fac_d_c
                            INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = fac_d_c.codigo_producto
                            WHERE fac_d_c.id_detalle = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Inicializando el array
				   //$datos=array(); $fila_array = 0;
				// Recorriendo la Tabla con PDO::
					$num = 1;
					    if($consulta -> rowCount() != 0){		
						while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
						  {
						      // recopilar los valores de los campos.
						      $id_detalle = trim($listado['id_detalle']);;
                              $codigo_producto = trim($listado['codigo_producto']);;
                              $descripcion_producto = trim($listado['descripcion']);;
							  $cantidad = trim($listado['cantidad']);;
                              $precio_compra = trim($listado['precio_compra']);;
                              //
							  $datos[$fila_array]["id_detalle"] = $id_detalle;
                              $datos[$fila_array]["codigo_producto"] = $codigo_producto;
                              $datos[$fila_array]["descripcion_producto"] = $descripcion_producto;
                              $datos[$fila_array]["cantidad"] = $cantidad;
                              $datos[$fila_array]["precio_compra"] = $precio_compra;
						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    else{
							$datos[$fila_array]["no_registros"] = '<tr><td> No se encontraron registros.</td>';
					    }                
            break;
        
            case 'EliminarProducto':
                $id_ = trim($_POST['id_detalle_factura_compra']);
				$numero_factura = trim($_POST['numero_factura']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
                $cantidad_por = 0;

							$cantidad = trim($_POST['cantidad_producto']);
							$codigo_producto = trim($_POST['codigo_producto']);
                            $codigo_tipo_factura = trim($_POST['codigo_tipo_factura']);

							// ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
										}
                            if($codigo_tipo_factura == "03"){
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
                                    }else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }else{
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
								}else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }   // ELSE que valida si es nota de credito.
						// ELIMINAR EL CONTENIDO DE LA FACTURA DETALLES VENTAS.
							$query_e = "DELETE FROM facturas_detalles_compras WHERE id_detalle = '$id_'";
								$resultado_e = $dblink -> query($query_e);
                            DatosFacturasCompras();
            break;
            case 'ActualizarProducto':
                $id_ = trim($_POST['id_detalle_factura_compra']);
                $id_factura_compra = trim($_POST['id_factura_compra']);
				$numero_factura = trim($_POST['numero_factura']);
                $codigo_proveedor = trim($_POST['codigo_proveedor']);
                $cantidad_nueva = trim($_POST['cantidad']);
                $cantidad_actual = trim($_POST['cantidad_actual']);
                $precio_compra = convertir_a_numero($_POST['precio_compra']);
                $cantidad_por = 0;
                // Decisión para la cantidad.
                    if($cantidad_actual == $cantidad_nueva){
                        $cantidad = 0;
                    }
                    if($cantidad_actual <> $cantidad_nueva){
                        $cantidad = $cantidad_nueva - $cantidad_actual;
                        $cantidad_calculada = $cantidad;
                    }

							$codigo_producto = trim($_POST['codigo_producto']);
                            $codigo_tipo_factura = trim($_POST['codigo_tipo_factura']);

							// ACTUALIZAR LA EXISTENCIA DEL PRODUCTO.
							// VERIFICAR SI EL PRODUCTO TIENE CONVERSION DE CANTIDADES Y ACTUALIZAR EL PRECIO DE COSTO.
								$query_cantidad_convertir = "SELECT * FROM catalogo_productos WHERE (codigo_categoria || codigo) = '$codigo_producto'";
									$resultado_cantidad_convertir = $dblink -> query($query_cantidad_convertir);
									while($listado = $resultado_cantidad_convertir -> fetch(PDO::FETCH_BOTH))
										{
											$cantidad_convertir = trim($listado['convertir_cantidad']);
										}
                            if($codigo_tipo_factura == "03"){
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
                                    }else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}                                
                            }else{
							// 	validar la cantidada convertir.
								if($cantidad_convertir > 0){
									if($cantidad_por == 1){
										// Calcular la Existencia.
											$cantidad = ($cantidad * $cantidad_convertir);										
									}
                                        // Compprobar si cantidad es negativo o positivo.
                                                $query_existencia = "UPDATE catalogo_productos SET existencia = existencia + ($cantidad_nueva-$cantidad_actual) WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
											
								}else{
                                        // Compprobar si cantidad es negativo o positivo.
                                                $query_existencia = "UPDATE catalogo_productos SET existencia = existencia + ($cantidad_nueva-$cantidad_actual) WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);                                        
                                }
                            }   // ELSE que valida si es nota de credito.
                            // Actualizar cantidad de compra del producto
                                  // Decisión para la cantidad. en detalle de la compra
                                        if($cantidad_actual == $cantidad_nueva){
                                            $cantidad = $cantidad_actual;
                                        }elseif($cantidad_actual > $cantidad_nueva){
                                            $cantidad = $cantidad_nueva;
                                        }elseif($cantidad_actual < $cantidad_nueva){
                                            $cantidad = $cantidad_nueva;
                                        }
                                        // actualizar cantidad y precio_compra
										$query_d = "UPDATE facturas_detalles_compras SET cantidad = '$cantidad', precio_compra = '$precio_compra' WHERE id_detalle = '$id_'";
										$resultado_d = $dblink -> query($query_d);
                                            DatosFacturasCompras();
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
	}elseif($_POST["accion"] === "BuscarCodigo" or $_POST["accion"] === "GenerarCodigoNuevo" or $_POST["accion"] === "EditarRegistro" or $_POST["accion"] === "VerProductoFactura"){
		echo json_encode($datos);
		}
	else{
		// Armamos array para convertir a JSON
		$salidaJson = array("respuesta" => $respuestaOK,
			"mensaje" => $mensajeError,
			"contenido" => $contenidoOK,
            "codigo_proveedor" => $codigo_proveedor,
            "nombre_proveedor" => $nombre_proveedor,
            "codigo_tipo_factura" => $codigo_tipo_factura,
            "total_compra" => $total_compra,
            "numero_factura" => $numero_factura,
            "cantidad_calculada" => $cantidad_calculada,
            "fecha" => $fecha);
		echo json_encode($salidaJson);
	}
/// FUNCION PARA MOSTRAR LAS COMPRAS EN CUALQUIER MOMENTO.
function DatosFacturasCompras(){
    global $numero_factura, $codigo_proveedor, $dblink, $total_compra, $nombre_proveedor, $codigo_proveedor, $codigo_tipo_factura, $contenidoOK, $respuestaOK, $mensajeError, $numero_factura, $fecha;
  // Armar Query.
				$query = "SELECT  fac_d_c.codigo_producto, cat_pro.descripcion, fc.fecha, fc.numero_factura, fc.codigo_proveedor, fc.id_compras, fac_d_c.cantidad, fc.codigo_tipo_factura,
                            fac_d_c.precio_compra, fac_d_c.cantidad * fac_d_c.precio_compra as total_compra, fac_d_c.id_detalle, cat_pro.producto_exento,
                            CONCAT(pro.nombre,' ',pro.nombre_empresa) as nombre_completo
                            FROM facturas_compras fc
                            INNER JOIN facturas_detalles_compras fac_d_c ON fac_d_c.numero_factura = fc.numero_factura and fac_d_c.codigo_proveedor = fc.codigo_proveedor
                            INNER JOIN catalogo_productos cat_pro ON btrim(cat_pro.codigo_categoria || cat_pro.codigo) = fac_d_c.codigo_producto
                            INNER JOIN proveedores pro ON pro.codigo = fc.codigo_proveedor
                            WHERE fc.numero_factura = $numero_factura and fac_d_c.numero_factura = $numero_factura and fc.codigo_proveedor = '$codigo_proveedor' and fac_d_c.codigo_proveedor = '$codigo_proveedor'
                                ORDER BY fac_d_c.id_detalle ASC";

				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Inicializando el array

				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$num = 0; $venta_total = 0; $iva = 0;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
						$num++;
						$id_detalle = $listado['id_detalle'];
                        $numero_factura = $listado['numero_factura'];
                        $codigo_producto = $listado['codigo_producto'];
                        $descripcion = $listado['descripcion'];
                        $cantidad = $listado['cantidad'];
                        $precio_compra = $listado['precio_compra'];
                        $codigo_proveedor = $listado['codigo_proveedor'];
                        $codigo_tipo_factura = $listado['codigo_tipo_factura'];
                        $nombre_proveedor = $listado['nombre_completo'];
                        $producto_exento = $listado['producto_exento'];
                        $fecha = $listado['fecha'];
                        // Calcular el iva si el producto es exento o no
                        if($producto_exento == "01"){
                                $producto_exento = "Si";
                                $total_compra = $total_compra + (($cantidad * $precio_compra));
                            }else{
                                $producto_exento = "No";
                                $iva = ($cantidad * $precio_compra) * 0.13;
                                $total_compra = $total_compra + (($cantidad * $precio_compra) + $iva);
                            }
                        
						$contenidoOK .= '<tr>'
							.'<td class=centerTXT>'.$id_detalle
                            .'<td class=centerTXT>'.$codigo_producto
                            .'<td class=centerTXT>'.$descripcion
                            .'<td class=centerTXT>'.$cantidad
                            .'<td class=centerTXT>'.$precio_compra
							.'<td><a data-accion=ActualizarCodigoProveedor class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="Editar Codigo Proveedor" href='.$listado['id_detalle'].'><span class="fa fa-edit"></span></a>'
							.'<td><a data-accion=EliminarProducto class="btn btn-sm btn-warning" title="Eliminar Producto" href='.$listado['id_detalle'].'><span class="fa fa-trash"></span></a>'
                            .'<td><a data-accion=EditarProducto class="btn btn-sm btn-secondary" title="Editar Producto" href='.$listado['id_detalle'].'><span class="fa fa-edit"></span></a>'
							;
					}
					$mensajeError = "Si Registro";
                    // ACTULIAR EL TOTAL DE LA COMPRA
                        $query_compra = "UPDATE facturas_compras SET total_compra = '$total_compra' WHERE numero_factura = '$numero_factura' and codigo_proveedor = '$codigo_proveedor'";
                    // Ejecutamos el Query.
                        $consulta_compra = $dblink -> query($query_compra);
				}
				else{
					$respuestaOK = false;
					$contenidoOK = '
						<tr id="sinDatos">
							<td colspan="8" class="centerTXT">No Hay Registros...</td>
						</tr>
					'.$query;
                    $mensajeError = "No Registro";
                    $codigo_proveedor = "";
                    $nombre_proveedor = "";
                    $total_compra = "";
				}  
}
?>