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
		if(!empty($_POST['accion_productos_buscar'])){
			$_POST['accion'] = $_POST['accion_productos_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
		case 'GenerarCodigoNuevo':
				$codigo_categoria = trim($_POST['codigo_categoria']);
				$query = "SELECT id_productos, codigo, substring(codigo from 1 for 3)::int as codigo_cargo_numero_entero
								FROM catalogo_productos WHERE codigo_categoria = '$codigo_categoria' ORDER BY codigo_cargo_numero_entero DESC LIMIT 1";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar si existen registros.
				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
						$codigo_entero = trim($listado['codigo_cargo_numero_entero']) + 1;
						$codigo_string = (string) $codigo_entero;
						$codigo_nuevo = codigos_nuevos_productos($codigo_string);
						// retornar variable que contendrá el nuevo código.
						$datos[$fila_array]["codigo_nuevo"] = $codigo_nuevo;
						
					}
					$mensajeError = "Si Registro";
				}
				else{
						$codigo_nuevo = "001";
						// retornar variable que contendrá el nuevo código.
						$datos[$fila_array]["codigo_nuevo"] = $codigo_nuevo;
						
					$respuestaOK = true;
					$contenidoOK = '';
					$mensajeError =  'No Registro';
				}
			break;
		
		case 'BuscarTodos':
            if(isset($_REQUEST["codigos_activos"])){
                $codigos_activos = trim($_REQUEST['codigos_activos']);
            }else{
                $codigos_activos = 0;
            }
				// Armamos el query.
                if($codigos_activos == 1){
                    $query = "SELECT id_productos, (codigo_categoria || codigo) as codigo_producto, codigo_barra, descripcion, precio_venta, precio_ajuste, 
                                precio_costo, producto_exento, existencia, existencia_minima, precio_venta + precio_ajuste as precio, codigo_estatus
                                FROM catalogo_productos ORDER BY codigo_producto";                    
                }else{
                    $query = "SELECT id_productos, (codigo_categoria || codigo) as codigo_producto, codigo_barra, descripcion, precio_venta, precio_ajuste, 
                            precio_costo, producto_exento, existencia, existencia_minima, precio_venta + precio_ajuste as precio, codigo_estatus
                                FROM catalogo_productos WHERE codigo_estatus = '01' ORDER BY codigo_producto";
                }
				
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
                //string con comillas simples para la descripción del producto.
                $descripcion = pg_escape_string(trim($_POST['txtDescripcionProducto']));
				$codigo = trim($_POST['txtCodigoProducto']);
                $codigo_estatus = trim($_POST['lstCodigoEstatus']);
                $codigo_barra = pg_escape_string(trim($_POST['txtCodigoBarra']));
				$precio_venta = convertir_a_numero(trim($_POST['txtPrecioVenta']));
				$precio_costo = convertir_a_numero(trim($_POST['txtPrecioCosto']));
				$precio_venta_ajuste = convertir_a_numero(trim($_POST['txtPrecioVentaAjuste']));
				$codigo_categoria = trim($_POST['txtCodigoCategoria']);
				//$comentario = pg_escape_string(trim($_POST['txtComentario']));
				$producto_exento = trim($_POST['lstProductoExento']);
				$existencia = trim($_POST['txtExistencia']);
				$existencia_minima = trim($_POST['txtExistenciaMinima']);
				$convertir_cantidad = trim($_POST['txtConvertirCantidad']);
                // variable para la tabla PRODUCTO UNIDAD DE MEDIDA.
                $codigo_producto_unidad_medida = trim($_POST['lstUnidadMedida']);
                // query PRODUCTO UNIDAD MEDIDIA.
                $query_u = "INSERT INTO productos_unidad_medida (codigo_categoria, codigo_producto, codigo_unidad_medida) VALUES ('$codigo_categoria','$codigo','$codigo_producto_unidad_medida')";
				// Armar query.
				$query = "INSERT INTO catalogo_productos (codigo, codigo_barra, descripcion, precio_venta, codigo_categoria, producto_exento, existencia, existencia_minima, precio_costo, precio_ajuste, convertir_cantidad, codigo_estatus) VALUES ('$codigo','$codigo_barra','$descripcion','$precio_venta','$codigo_categoria','$producto_exento','$existencia','$existencia_minima','$precio_costo','$precio_venta_ajuste','$convertir_cantidad','$codigo_estatus')";
                // Evaluar si el codigo categoria es igual a 000
                if($codigo_categoria == '000')
                {
                    $respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
                }else{
                    // Ejecutamos el Query.
                    $consulta = $dblink -> query($query);
                    $consulta_u = $dblink -> query($query_u);
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
                }
			break;
		
			case 'EditarRegistro':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT id_productos, codigo, codigo_barra, descripcion, precio_venta, precio_costo, precio_ajuste, codigo_categoria, comentario, producto_exento, existencia, existencia_minima, convertir_cantidad, codigo_estatus FROM catalogo_productos WHERE id_productos = '$id_'
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
						      $id_productos = trim($listado['id_productos']);
						      $codigo = trim($listado['codigo']);
                              $codigo_estatus = trim($listado['codigo_estatus']);
                              $codigo_barra = trim($listado['codigo_barra']);
							  $descripcion = trim($listado['descripcion']);
							  $precio_venta = trim($listado['precio_venta']);
							  $precio_costo = trim($listado['precio_costo']);
							  if($precio_costo == null){$precio_costo = 0;}
							  $precio_ajuste = trim($listado['precio_ajuste']);
							  if($precio_ajuste == null){$precio_ajuste = 0;}

							  $codigo_categoria = trim($listado['codigo_categoria']);
							  ////$comentario = trim($listado['comentario']);
							  $producto_exento = trim($listado['producto_exento']);
							  $existencia = trim($listado['existencia']);
							  $existencia_minima = trim($listado['existencia_minima']);
							  $convertir_cantidad = trim($listado['convertir_cantidad']);
							  //
							  $datos[$fila_array]["id_productos"] = $id_productos;
							  $datos[$fila_array]["codigo_productos"] = $codigo;
                              $datos[$fila_array]["codigo_estatus"] = $codigo_estatus;
                              $datos[$fila_array]["codigo_barra"] = $codigo_barra;
							  $datos[$fila_array]["codigo_categoria"] = $codigo_categoria;
							  $datos[$fila_array]["precio_venta"] = $precio_venta;
							  $datos[$fila_array]["precio_costo"] = $precio_costo;
							  $datos[$fila_array]["precio_ajuste"] = $precio_ajuste;
							  $datos[$fila_array]["descripcion"] = $descripcion;
							  //$datos[$fila_array]["comentario"] = $comentario;
							  $datos[$fila_array]["producto_exento"] = $producto_exento;
							  $datos[$fila_array]["existencia"] = $existencia;
							  $datos[$fila_array]["existencia_minima"] = $existencia_minima;
							  $datos[$fila_array]["convertir_cantidad"] = $convertir_cantidad;
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
				$descripcion = pg_escape_string(trim($_POST['txtDescripcionProducto']));
				$codigo_categoria = trim($_POST['txtCodigoCategoria']);
                $codigo_producto = trim($_POST['txtCodigoProducto']);
                $codigo_estatus = trim($_POST['lstCodigoEstatus']);
                $codigo_barra = pg_escape_string(trim($_POST['txtCodigoBarra']));
				$precio_venta = convertir_a_numero(trim($_POST['txtPrecioVenta']));
				$precio_costo = convertir_a_numero(trim($_POST['txtPrecioCosto']));
				$precio_venta_ajuste = convertir_a_numero(trim($_POST['txtPrecioVentaAjuste']));
				//$comentario = pg_escape_string(trim($_POST['txtComentario']));
				$producto_exento = trim($_POST['lstProductoExento']);
				$existencia = trim($_POST['txtExistencia']);
				$existencia_minima = trim($_POST['txtExistenciaMinima']);
				$convertir_cantidad = trim($_POST['txtConvertirCantidad']);
                $codigo_c_p = $codigo_categoria . $codigo_producto;
				
				// Armar query para actualizar.
				//$query = "UPDATE catalogo_productos SET codigo_barra = '$codigo_barra', descripcion = '$descripcion', codigo_categoria = '$codigo_categoria', precio_venta = '$precio_venta', precio_costo = '$precio_costo', producto_exento = '$producto_exento', existencia = '$existencia', existencia_minima = '$existencia_minima', precio_ajuste = '$precio_venta_ajuste', convertir_cantidad = '$convertir_cantidad'
				//WHERE id_productos = '$id_'";
                $query = "UPDATE catalogo_productos SET codigo_barra = '$codigo_barra', descripcion = '$descripcion', precio_venta = '$precio_venta', precio_costo = '$precio_costo', producto_exento = '$producto_exento', existencia = '$existencia', existencia_minima = '$existencia_minima', precio_ajuste = '$precio_venta_ajuste', convertir_cantidad = '$convertir_cantidad', codigo_estatus = '$codigo_estatus'
				WHERE id_productos = '$id_'";
                $query_porcentaje = "UPDATE productos_porcentaje_precio_venta SET precio_venta = '$precio_costo' WHERE btrim(codigo_categoria || codigo_producto) = '$codigo_c_p'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
                $consulta_porcentaje = $dblink -> query($query_porcentaje);
                $codigo_producto = $codigo_c_p;
                $precio_compra = $precio_costo;
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Actualizado';
                    DatosListadoPorcentaje($codigo_producto,$precio_compra);
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
				}
			break;
		
			case 'EliminarRegistro':
				$id_ = trim($_POST['id_user']);
                $codigo_producto = $_POST["codigo_producto"];
                
                $query_producto = "SELECT * FROM facturas_detalles_compras WHERE codigo_producto = '$codigo_producto' LIMIT 1";
                // Ejecutamos el Query.
                    $consulta_producto = $dblink -> query($query_producto);				
                        if($consulta_producto -> rowCount() > 0){
                            $respuestaOK = false;
                            $contenidoOK = $query_producto;
                            $mensajeError = "No Eliminar";
                            }
                        else{
                            // Armar query.
                            $query = "DELETE FROM catalogo_productos WHERE id_productos = '$id_'";
                            $query_porcentaje = "DELETE FROM productos_porcentaje_precio_venta WHERE btrim(codigo_categoria || codigo_producto) = '$codigo_producto'";
                            // Ejecutamos el Query.
                            $consulta = $dblink -> query($query);
                            $consulta_porcentaje = $dblink -> query($query_porcentaje);				
                            // Verificar la consulta
                            if($consulta == true){
                                $respuestaOK = true;
                                $contenidoOK = $query . $query_porcentaje;
                                $mensajeError =  'Si Registro';
                            }else{
                                $respuestaOK = false;
                                $contenidoOK = $query;
                                $mensajeError =  'No Registro';					
                            }                            
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CALCULAR PRODUCTO PORCENTAJE PRECIO VENTA.	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DatosListadoPorcentaje($codigo_producto,$precio_compra){
			global $codigo_producto, $precio_compra, $dblink;
							$query_por = "SELECT pppv.id_pro_por_precio_venta, pppv.codigo_producto, pppv.codigo_categoria, pppv.codigo_cat_pro_por_venta,
									cppv.descripcion, cppv.porcentaje, cppv.iva
									from productos_porcentaje_precio_venta pppv
									INNER JOIN catalogo_producto_porcentaje_venta cppv ON cppv.codigo = pppv.codigo_cat_pro_por_venta
									WHERE btrim(pppv.codigo_categoria || pppv.codigo_producto) = '$codigo_producto' ORDER BY cppv.porcentaje DESC";
						// Ejecutamos el Query.
						   $consulta_por = $dblink -> query($query_por);
						// Recorriendo la Tabla con PDO:: SE REPETIRA DEPENDIENDO CUANTOS REGISTRO TENGA EL PORCENTAJE DEL PRODUCTO.
								$calcular_uno = 0;
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
?>