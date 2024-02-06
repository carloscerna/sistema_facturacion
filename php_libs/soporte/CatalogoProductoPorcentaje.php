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
		if(!empty($_POST['accion_porcentaje_buscar'])){
			$_POST['accion'] = $_POST['accion_porcentaje_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
		case 'BuscarTodos':
				$codigo_producto = trim($_POST['codigo_producto']);
				// Armamos el query.
				$query = "SELECT pppv.id_pro_por_precio_venta, pppv.codigo_producto, pppv.codigo_categoria, pppv.codigo_cat_pro_por_venta, pppv.precio_venta, pppv.precio_ajuste,
                                 pppv.precio_venta + pppv.precio_ajuste as precio,
									cppv.descripcion, cppv.porcentaje, cppv.iva, cppv.codigo
									from productos_porcentaje_precio_venta pppv
									INNER JOIN catalogo_producto_porcentaje_venta cppv ON cppv.codigo = pppv.codigo_cat_pro_por_venta
									WHERE btrim(pppv.codigo_categoria || pppv.codigo_producto) = '$codigo_producto' ORDER BY pppv.codigo_cat_pro_por_venta ASC";
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

    case 'BuscarPorcentaje01':
				$codigo_producto = trim($_POST['codigo_producto']);
                $codigo_porcentaje = '01'; $codigo_porcentaje_02 = '02';
                
				// Armar Query. para buscar el primero precio al publico codigo 01
				$query = "SELECT * FROM productos_porcentaje_precio_venta where btrim(codigo_categoria || codigo_producto) = '$codigo_producto' and codigo_cat_pro_por_venta = '$codigo_porcentaje'";
                $query_02 = "SELECT * FROM productos_porcentaje_precio_venta where btrim(codigo_categoria || codigo_producto) = '$codigo_producto' and codigo_cat_pro_por_venta = '$codigo_porcentaje_02'";
                // EJECUTCION DEL QUERY PARA EL CODIGO PORCENTAJE 01 Y 02
                $consulta = $dblink -> query($query);
                $consulta_02 = $dblink -> query($query_02);
				// Recorriendo la Tabla con PDO::
					$num = 1;
					    if($consulta -> rowCount() != 0){		
						while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
						  {
						      // recopilar los valores de los campos.
						      $precio_venta = trim($listado['precio_venta']);
							  $precio_ajuste = trim($listado['precio_ajuste']);
							  //
							  $datos[$fila_array]["precio_venta"] = $precio_venta;
							  $datos[$fila_array]["precio_ajuste"] = $precio_ajuste;

						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    elseif($consulta_02 -> rowCount() !=0){
                            while($listado = $consulta_02 -> fetch(PDO::FETCH_BOTH))
    						{
    						      // recopilar los valores de los campos.
    						      $precio_venta = trim($listado['precio_venta']);
    							  $precio_ajuste = trim($listado['precio_ajuste']);
    							  //
    							  $datos[$fila_array]["precio_venta"] = $precio_venta;
    							  $datos[$fila_array]["precio_ajuste"] = $precio_ajuste;
                                  // Incrementar el valor del array.
                                    $fila_array++; $num++;
                            }                            
                        }else{
							$datos[$fila_array]["no_registros"] = 'no_registros';
					    }
			break;
        
			case 'GuardarPorcentaje':
				$codigo_producto = trim($_POST['codigo_producto']);
				$codigo_categoria = trim($_POST['codigo_categoria']);
				$codigo_porcentaje = trim($_POST["codigo_porcentaje"]);
                $producto_exento = trim($_POST["producto_exento"]);
				$precio_venta = 0;
				$precio_compra = convertir_a_numero(trim($_POST['precio_compra']));
                $codigo_c_p = $codigo_categoria . $codigo_producto;
                
                // VERIFICAR SI EXISTE EL CODIGO PORCENTAJE.
                    $query_porcentaje = "SELECT * FROM productos_porcentaje_precio_venta WHERE btrim(codigo_categoria || codigo_producto) = '$codigo_c_p' and codigo_cat_pro_por_venta = '$codigo_porcentaje'";
                            $consulta_porcentaje = $dblink -> query($query_porcentaje);
                if($consulta_porcentaje -> rowCount() != 0){
                        $respuestaOK = false;
    					$contenidoOK = $query_porcentaje;
    					$mensajeError =  'No Porcentaje';					
                }else{ 
    				// Armar query.
                    $query = "INSERT INTO productos_porcentaje_precio_venta (codigo_producto, codigo_categoria, precio_venta, codigo_cat_pro_por_venta) VALUES ('$codigo_producto','$codigo_categoria','$precio_venta','$codigo_porcentaje')";

    				// Ejecutamos el Query.
    				$consulta = $dblink -> query($query);
    				// Verificar la consulta
    				if($consulta == true){
    					$respuestaOK = true;
    					$contenidoOK = $query;
    					$mensajeError =  'Si Registro';
    					$codigo_producto = $codigo_categoria . $codigo_producto;
    					DatosListadoPorcentaje($codigo_producto,$precio_compra);
    				}else{
    					$respuestaOK = false;
    					$contenidoOK = $query;
    					$mensajeError =  'No Registro';					
    				}
                }
			break;
		
			case 'EditarPorcentaje':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT id_pro_por_precio_venta, precio_ajuste FROM productos_porcentaje_precio_venta WHERE id_pro_por_precio_venta = '$id_'
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
						      $id_porcentaje = trim($listado['id_pro_por_precio_venta']);
							  $precio_ajuste = trim($listado['precio_ajuste']);

							  //
							  $datos[$fila_array]["id_porcentaje"] = $id_porcentaje;
							  $datos[$fila_array]["precio_ajuste"] = $precio_ajuste;

						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    else{
							$datos[$fila_array]["no_registros"] = '<tr><td> No se encontraron registros.</td>';
					    }
			break;
		
			case 'ActualizarPorcentaje':
				$id_ = trim($_POST['id_porcentaje']);
				$precio_ajuste = convertir_a_numero(trim($_POST['precio_ajuste']));
				$producto_exento = trim($_POST["producto_exento"]);
                
				// Armar query para actualizar.
				$query = "UPDATE productos_porcentaje_precio_venta SET precio_ajuste = '$precio_ajuste' WHERE id_pro_por_precio_venta = '$id_'";
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
		
			case 'EliminarPorcentaje':
				$id_ = trim($_POST['id_porcentaje']);
				$codigo_producto = trim($_POST['codigo_producto']);
				$precio_compra = convertir_a_numero(trim($_POST['precio_compra']));
                $producto_exento = trim($_POST["producto_exento"]);
				// Armar query.
				$query = "DELETE FROM productos_porcentaje_precio_venta WHERE id_pro_por_precio_venta = '$id_'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);				
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Registro';
					DatosListadoPorcentaje($codigo_producto,$precio_compra);
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
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
	}elseif($_POST["accion"] === "BuscarCodigo" or $_POST["accion"] === "GenerarCodigoNuevo" or $_POST["accion"] === "EditarRegistro" or $_POST["accion"] === "EditarPorcentaje" or $_POST["accion"] === "BuscarPorcentaje01"){
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
			global $codigo_producto, $precio_compra, $dblink, $producto_exento;
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
                                    // verificar si el producto es EXCENTO para no sumarle el IVA.
                                        if($producto_exento === "01"){$iva = 0;}
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