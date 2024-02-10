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
				$query = "SELECT fac_v.id_ventas, to_char(fac_v.fecha,'DD/MM/YYYY') as fecha, fac_v.numero_factura, fac_v.codigo_tipo_factura,
                            to_char(fac_v.total_venta,'$9,999,999.00') as total_venta, fac_v.estado_factura,
                            cat_fac.descripcion as nombre_tipo_factura, cat_des.descripcion, fac_v.numero_factura_real,
                            btrim(fac_v.numero_factura_real || cast('-' as VARCHAR) ||fac_v.numero_factura) as numero_factura_completo,
                            cliente_empresa,
                            CASE
                            	WHEN(fac_v.codigo_tipo_factura = '01') THEN btrim(fac_v.codigo_tipo_factura || '-CF')
                                WHEN(fac_v.codigo_tipo_factura = '02') THEN btrim(fac_v.codigo_tipo_factura || '-CCF')
                            END AS c_tipo_f
                            FROM facturas_ventas fac_v
                            INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
                            INNER JOIN catalogo_tipo_factura cat_fac ON cat_fac.codigo = fac_v.codigo_tipo_factura
                            INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento
                            ORDER BY fac_v.id_ventas DESC";
				// Armamos el query.
				/*$query = "SELECT fac_v.id_ventas, to_char(fac_v.fecha,'DD/MM/YYYY') as fecha, fac_v.numero_factura, fac_v.codigo_tipo_factura,
                            to_char(fac_v.total_venta-(fac_v.total_venta*(cat_des.descripcion/100)),'$9,999,999.00') as total_venta, fac_v.estado_factura,
                            cat_fac.descripcion as nombre_tipo_factura, cat_des.descripcion, fac_v.numero_factura_real,
                            btrim(fac_v.numero_factura_real || cast('-' as VARCHAR) ||fac_v.numero_factura) as numero_factura_completo,
                            cliente_empresa,
                            CASE
                            	WHEN(fac_v.codigo_tipo_factura = '01') THEN btrim(fac_v.codigo_tipo_factura || '-CF')
                                WHEN(fac_v.codigo_tipo_factura = '02') THEN btrim(fac_v.codigo_tipo_factura || '-CCF')
                            END AS c_tipo_f
                            FROM facturas_ventas fac_v
                            INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
                            INNER JOIN catalogo_tipo_factura cat_fac ON cat_fac.codigo = fac_v.codigo_tipo_factura
                            INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento
                            ORDER BY fac_v.fecha ASC";*/
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
				$descripcion = trim($_POST['txtdescripcion']);
				$codigo = trim($_POST['txtcodigo']);
				$comentario = trim($_POST['txtComentario']);
				// Armar query.
				//$query = "INSERT INTO catalogo_categoria (codigo, descripcion, comentario) VALUES ('$codigo','$descripcion','$comentario')";

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
		
			case 'EditarRegistro':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT id_ventas, fecha, numero_factura, estado_factura FROM facturas_ventas WHERE id_ventas = '$id_'
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
						      $id_ventas = trim($listado['id_ventas']);
						      $fecha = trim($listado['fecha']);
							  $numero_factura = trim($listado['numero_factura']);
							  $estado_factura = trim($listado['estado_factura']);
							  //
							  $datos[$fila_array]["id_ventas"] = $id_ventas;
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
		
			case 'ActualizarRegistro':
				$id_ = trim($_POST['id_']);
				$fecha = trim($_POST['fecha']);
				// Validar la fecha.
                // Fuente: https://desarrolloweb.com/articulos/validar-fecha-php-formato-existencia.html
                $valores = explode('-', $fecha);
                if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0]) && $valores[0] >= 2000 && $valores[0] <= 2025){
                    // Armar query para actualizar.
                    $query = "UPDATE facturas_ventas SET fecha = '$fecha' WHERE id_ventas = '$id_'";
                    // Ejecutamos el Query.
                    $consulta = $dblink -> query($query);
                    // Verificar la consulta
                    if($consulta == true){
                        $respuestaOK = true;
                        $contenidoOK = $query;
                        $mensajeError =  'Si Registro';
                    }
                }else{
					$respuestaOK = false;
					$mensajeError =  'No Registro';					
				}

			break;
		
			case 'EliminarRegistro':
                // extraer informaci�n del POST FacturasVentas.js
				$id_ = trim($_POST['id_']);
                $separar_numero_factura = explode("-",$_POST['numero_factura']);
                $separar_codigo_tipo_factura = explode("-",$_POST['codigo_tipo_factura']);
				$numero_factura = $separar_numero_factura[1];
                $numero_factura_real = $separar_numero_factura[0];
				$codigo_tipo_factura = $separar_codigo_tipo_factura[0]; 
                
				// Armar query. PARA ELIMINAR LA FACTURA DE FACTURAS VENTAS.
				$query = "DELETE FROM facturas_ventas WHERE id_ventas = '$id_' and numero_factura = '$numero_factura'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);				
				// Variables para la tabla FACTURAS_DETALLES_VENTAS.
					// buscarmos los registros existentes en la tabla.
					$query_buscar_factura = "SELECT codigo_producto, cantidad, cantidad_por
							FROM facturas_detalles_ventas WHERE numero_factura_real = '$numero_factura_real' and numero_factura = '$numero_factura' and codigo_tipo_factura = '$codigo_tipo_factura'";
					// Ejecutamos el query
					$resultadoDFT = $dblink -> query($query_buscar_factura);

					if($query_buscar_factura == true){
						$respuestaOK = true;
						$mensajeError = "Si Registro";
						
					    while($DetalleFacturaTemp = $resultadoDFT -> fetch(PDO::FETCH_BOTH))
						{
							$cantidad = trim($DetalleFacturaTemp['cantidad']);
							$codigo_producto = trim($DetalleFacturaTemp['codigo_producto']);
							$cantidad_por = trim($DetalleFacturaTemp['cantidad_por']);

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

											$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
												$resultado_existencia = $dblink -> query($query_existencia);
								}else{
										$query_existencia = "UPDATE catalogo_productos SET existencia = existencia + {$cantidad} WHERE (codigo_categoria || codigo) = '$codigo_producto'";
										$resultado_existencia = $dblink -> query($query_existencia);}
						}
						// ELIMINAR EL CONTENIDO DE LA FACTURA DETALLES VENTAS.
							$query_e = "DELETE FROM facturas_detalles_ventas WHERE numero_factura_real = '$numero_factura_real' and numero_factura = '$numero_factura' and codigo_tipo_factura = '$codigo_tipo_factura'";
								$resultado_e = $dblink -> query($query_e);
					}		
					else{
						$mensajeError = "No Registro";
					}
			break;

			case 'ImprimirFacturaVentas':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT * FROM facturas_ventas WHERE id_ventas = '$id_'";
				// Ejecutamos el Query. para capturar el codigo_tipo_factura.
				$consulta = $dblink -> query($query);
					if($consulta -> rowCount() != 0){		
						while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
						  {
						      // recopilar los valores de los campos.
						      $codigo_t_f = trim($listado['codigo_tipo_factura']);
							  
							  $datos[$fila_array]["codigo_tipo_factura"] = $codigo_t_f;
						  }
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
	}elseif($_POST["accion"] === "BuscarCodigo" or $_POST["accion"] === "GenerarCodigoNuevo" or $_POST["accion"] === "EditarRegistro" or $_POST["accion"] === "ImprimirFacturaVentas"){
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