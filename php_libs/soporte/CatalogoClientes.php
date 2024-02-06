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
$arreglo = array("id_clientes","codigo","nombres","apellidos");
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexión a la base de datos
include($path_root."/sistema_facturacion/includes/funciones.php");
include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_POST['accion_cliente_buscar'])){
			$_POST['accion'] = $_POST['accion_cliente_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
		case 'GenerarCodigoNuevo':
				$ann_ = substr(trim($_POST['ann']),2,2);	// Año en Curso. pasar a dos digitos.

				$query = "SELECT id_clientes, codigo, substring(codigo from 1 for 4)::int as codigo_empleado_numero_entero,substring(codigo from 1 for 4) as codigo_empleado,
							substring(codigo from 5 for 2) as codigo_empleado_ann, cliente_empresa FROM clientes WHERE substring(codigo from 5 for 2) = '$ann_'
							ORDER BY codigo_empleado_numero_entero DESC LIMIT 1";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar si existen registros.
				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
						$codigo_entero = trim($listado['codigo_empleado_numero_entero']) + 1;
						$codigo_string = (string) $codigo_entero;
						$codigo_nuevo = codigos_nuevos_clientes($codigo_string);
						// Generar el Código
						$codigo_nuevo = $codigo_nuevo . $ann_;
						// retornar variable que contendrá el nuevo código.
						$datos[$fila_array]["codigo_nuevo"] = $codigo_nuevo;
						
					}
					$mensajeError = "Si Registro";
				}
				else{
						// Generar el Código
						$codigo_nuevo = "0001" . $ann_;
						// retornar variable que contendrá el nuevo código.
						$datos[$fila_array]["codigo_nuevo"] = $codigo_nuevo;
						
					$respuestaOK = true;
					$contenidoOK = '';
					$mensajeError =  'No Registro';
				}
			break;
		
		case 'BuscarTodos':
				// Armamos el query.
				$query = "SELECT id_clientes, codigo, cliente_empresa FROM clientes ORDER BY id_clientes ASC";
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
				$cliente_empresa = pg_escape_string(trim($_POST['txtClienteEmpresa']));
				$direccion = pg_escape_string(trim($_POST['txtDireccion']));
				$telefono_residencia = trim($_POST['txtTelefonoResidencia']);
				$telefono_celular = trim($_POST['txtTelefonoCelular']);
	
				$dui = trim($_POST['txtDui']);
				$nit = trim($_POST['txtNit']);
				$numero_registro = trim($_POST['txtNumeroRegistro']);
				$giro = pg_escape_string(trim($_POST['txtGiro']));
				$codigo_departamento = trim($_POST['lstDepartamento']);
				$codigo_municipio = trim($_POST['lstMunicipio']);
				
				$codigo_estatus = trim($_POST['lstEstatus']);
				$fecha_creacion = trim($_POST['txtFechaCreacion']);
				$codigo = trim($_POST['txtcodigo']);
                //
                // VERIFICAR NUEVAMENTE EL CODIGO DEL CLIENTE ANTES DE GUARDARLO.
                //
                    $ann_ = substr(trim($_POST['ann']),2,2);	// Año en Curso. pasar a dos digitos.

    				$query = "SELECT id_clientes, codigo, substring(codigo from 1 for 4)::int as codigo_empleado_numero_entero,substring(codigo from 1 for 4) as codigo_empleado,
							substring(codigo from 5 for 2) as codigo_empleado_ann, cliente_empresa FROM clientes WHERE substring(codigo from 5 for 2) = '$ann_'
							ORDER BY codigo_empleado_numero_entero DESC LIMIT 1";
				// Ejecutamos el Query.
    				$consulta = $dblink -> query($query);
				// Verificar si existen registros.
                    if($consulta -> rowCount() != 0){
                        // convertimos el objeto
                        while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
                        {
                            $codigo_entero = trim($listado['codigo_empleado_numero_entero']) + 1;
                            $codigo_string = (string) $codigo_entero;
                            $codigo_nuevo = codigos_nuevos_clientes($codigo_string);
                            // Generar el Código
                            $codigo_nuevo = $codigo_nuevo . $ann_;
                            $codigo = $codigo_nuevo;
                        }
                    }
                    else{
                            // Generar el Código
                            $codigo_nuevo = "0001" . $ann_;
                            $codigo = $codigo_nuevo;
                    }
                //
				// Armar query. PARA GUARDAR EL REGISTRO DEL CLIENTE.
                //
				$query = "INSERT INTO clientes (cliente_empresa, direccion, telefono_residencia, telefono_celular, codigo, dui, nit, fecha_creacion, codigo_departamento, codigo_municipio,
								numero_registro, giro, codigo_estatus)
						VALUES ('$cliente_empresa','$direccion','$telefono_residencia','$telefono_celular','$codigo','$dui','$nit','$fecha_creacion','$codigo_departamento','$codigo_municipio',
								'$numero_registro','$giro','$codigo_estatus')";

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
				$query = "SELECT id_clientes, codigo, cliente_empresa, direccion, telefono_residencia,
						dui, nit, telefono_celular, codigo_estatus, fecha_creacion, numero_registro, giro,
						codigo_departamento, codigo_municipio
					FROM clientes
					WHERE id_clientes = '$id_'
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
						      $id_clientes = trim($listado['id_clientes']);
						      $codigo = trim($listado['codigo']);
							  $cliente_empresa = pg_escape_string(trim($listado['cliente_empresa']));
							  $direccion = pg_escape_string(trim($listado['direccion']));
							  $telefono_residencia = trim($listado['telefono_residencia']);
							  $telefono_celular = trim($listado['telefono_celular']);
							  $dui = trim($listado['dui']);
							  $nit = trim($listado['nit']);
							  $numero_registro = trim($listado['numero_registro']);
							  $giro = pg_escape_string(trim($listado['giro']));
							  $fecha_creacion = trim($listado['fecha_creacion']);
							  $codigo_departamento = trim($listado['codigo_departamento']);
							  $codigo_municipio = trim($listado['codigo_municipio']);
							  $codigo_estatus = trim($listado['codigo_estatus']);						  
						      // pasar a la matriz.
						      $datos[$fila_array]["id_clientes"] = $id_clientes;
							  $datos[$fila_array]["codigo"] = $codigo;
							  $datos[$fila_array]["cliente_empresa"] = $cliente_empresa;
							  $datos[$fila_array]["fecha_creacion"] = $fecha_creacion;
							  $datos[$fila_array]["codigo_departamento"] = $codigo_departamento;
							  $datos[$fila_array]["codigo_municipio"] = $codigo_municipio;
							  $datos[$fila_array]["telefono_residencia"] = $telefono_residencia;
							  $datos[$fila_array]["telefono_celular"] = $telefono_celular;
							  $datos[$fila_array]["dui"] = $dui;
							  $datos[$fila_array]["nit"] = $nit;
							  $datos[$fila_array]["numero_registro"] = $numero_registro;
							  $datos[$fila_array]["giro"] = $giro;
							  $datos[$fila_array]["direccion"] = $direccion;  
						   // Incrementar el valor del array.
						     $fila_array++; $num++;
						  }
					    }
					    else{
							$datos[$fila_array]["no_registros"] = '<tr><td> No se encontraron registros.</td>';
					    }
			break;
		
			case 'ActualizarRegistro':
				$id_BuscarVentas = trim($_POST['txtIdCodigoClienteBuscarVentas']);
                // EVALUAR VARIABLE CUANDO PROVENGA DE LA PLANTILLA VENTAS EN LA BUSQUEDA.
                if($id_BuscarVentas == 0){
                    $id_ = trim($_POST['id_']);
                }else{
                    $id_ = $id_BuscarVentas;
                }
				$codigo_estatus = trim($_POST['lstEstatus']);
				$codigo = trim($_POST['txtcodigo']);
				$cliente_empresa = pg_escape_string(trim($_POST['txtClienteEmpresa']));
				$fecha_creacion = trim($_POST['txtFechaCreacion']);
				$telefono_residencia = trim($_POST['txtTelefonoResidencia']);
				$telefono_celular = trim($_POST['txtTelefonoCelular']);
				$codigo_departamento = trim($_POST['lstDepartamento']);
				$codigo_municipio = trim($_POST['lstMunicipio']);
				$dui = trim($_POST['txtDui']);
				$nit = trim($_POST['txtNit']);
				$numero_registro = trim($_POST['txtNumeroRegistro']);
				$giro = pg_escape_string(trim($_POST['txtGiro']));
				$direccion = pg_escape_string(trim($_POST['txtDireccion']));
								
				// Armar query para actualizar.
				$query = "UPDATE clientes SET cliente_empresa = '$cliente_empresa', direccion = '$direccion', telefono_residencia = '$telefono_residencia', telefono_celular = '$telefono_celular', codigo_estatus = '$codigo_estatus',
							dui = '$dui', nit = '$nit', numero_registro = '$numero_registro', giro = '$giro', fecha_creacion = '$fecha_creacion', codigo_departamento = '$codigo_departamento', codigo_municipio = '$codigo_municipio'
						WHERE id_clientes = '$id_'
				";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Verificar la consulta
				if($consulta == true){
					$respuestaOK = true;
					$contenidoOK = $query;
					$mensajeError =  'Si Actualizado';
				}else{
					$respuestaOK = false;
					$contenidoOK = $query;
					$mensajeError =  'No Registro';					
				}
			break;
		
			case 'EliminarRegistro':
				$id_ = trim($_POST['id_']);
                $codigo_cliente = trim($_POST['codigo_cliente']);
                
                $query_clientes = "SELECT * FROM facturas_ventas WHERE codigo_cliente = '$codigo_cliente' LIMIT 1";
                // Ejecutamos el Query.
                    $consulta_clientes = $dblink -> query($query_clientes);				
                        if($consulta_clientes -> rowCount() > 0){
                            $respuestaOK = false;
                            $contenidoOK = $query_clientes;
                            $mensajeError = "No Eliminar";
                            }
                        else{
                            // Armar query.
                            $query = "DELETE FROM clientes WHERE id_clientes = '$id_'";
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