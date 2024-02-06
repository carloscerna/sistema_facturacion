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
		if(!empty($_POST['accion_buscar'])){
			$_POST['accion'] = $_POST['accion_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {	
		case 'BuscarTodos':
				// Armamos el query.
				$query = "SELECT p.id_personal, p.apellidos, p.nombres, cat_estatus.descripcion as nombre_estatus
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
                $codigo_tipo_factura = trim($_POST['lstTipoFactura']);
                $codigo_estatus = trim($_POST['lstEstatus']);
                $tiraje = trim($_POST['txtNumeroFacturaTiraje']);
                $numero_inicio = trim($_POST['txtNumeroFacturaInicio']);
                $numero_fin = trim($_POST['txtNumeroFacturaFin']);
				$fecha_autorizacion = trim($_POST['txtFechaAutorizacion']);
                $fecha_impresion = trim($_POST['txtFechaImpresion']);
                $codigo_estatus = trim($_POST['lstEstatus']);
                
                // Armar query para evaluar si el tipo de factura y el estatus esta activo.
                $query_estatus = "SELECT * FROM facturas_tiraje WHERE codigo_tipo_factura = '$codigo_tipo_factura' and codigo_estatus = '$codigo_estatus' limit 1";
                $consulta_estatus = $dblink -> query($query_estatus);
                if($consulta_estatus -> rowCount() != 0){
                    $respuestaOK = false;
					$contenidoOK = $query_estatus;
					$mensajeError =  'Estatus';
                }else{
                    ///
                    /// Armar query. PARA GUARDAR EL NUEVO REGISTRO SI PASA LA PRIMERA EVALUACIÓN.
                    ///
                    $query = "INSERT INTO personal (codigo_tipo_factura, codigo_estatus, tiraje, numero_inicio, numero_fin, fecha_autorizacion, fecha_impresion)
                            VALUES ('$codigo_tipo_factura','$codigo_estatus','$tiraje','$numero_inicio','$numero_fin','$fecha_autorizacion','$fecha_impresion')";

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
                        $mensajeError =  'No Registro';}
                }		
			break;
		
			case 'EditarRegistro':
				$id_ = trim($_POST['id_']);
				// Armar Query.
				$query = "SELECT id_factura_tiraje, tiraje, numero_inicio, numero_fin, fecha_autorizacion, fecha_impresion, codigo_estatus, codigo_tipo_factura
                            FROM facturas_tiraje WHERE id_factura_tiraje = '$id_'
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
						      $id_ = trim($listado['id_factura_tiraje']);
						      $tiraje = trim($listado['tiraje']);
                              $numero_inicio = trim($listado['numero_inicio']);
							  $numero_fin = trim($listado['numero_fin']);
                              $fecha_autorizacion = cambiaf_a_normal(trim($listado['fecha_autorizacion']));
                              $fecha_impresion = cambiaf_a_normal(trim($listado['fecha_impresion']));
                              $codigo_tipo_factura = trim($listado['codigo_tipo_factura']);
							  $codigo_estatus = trim($listado['codigo_estatus']);
							  //
							  $datos[$fila_array]["id_"] = $id_;
                              $datos[$fila_array]["tiraje"] = $tiraje;
                              $datos[$fila_array]["numero_inicio"] = $numero_inicio;
                              $datos[$fila_array]["numero_fin"] = $numero_fin;
                              $datos[$fila_array]["fecha_autorizacion"] = $fecha_autorizacion;
                              $datos[$fila_array]["fecha_impresion"] = $fecha_impresion;
                              $datos[$fila_array]["codigo_tipo_factura"] = $codigo_tipo_factura;
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
				$fecha_autorizacion = trim($_POST['txtFechaAutorizacion']);
                $fecha_impresion = trim($_POST['txtFechaImpresion']);
                $codigo_estatus = trim($_POST['lstEstatus']);              
				
				// Armar query para actualizar.
				$query = "UPDATE facturas_tiraje SET fecha_autorizacion = '$fecha_autorizacion', fecha_impresion = '$fecha_impresion', codigo_estatus = '$codigo_estatus' WHERE id_factura_tiraje = '$id_'";
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
					$mensajeError =  'No Registro';					
				}
			break;
		
			case 'EliminarRegistro':
				$id_ = trim($_POST['id_']);
                $numero_factura_real = trim($_POST['numero_factura_real']);

                $query_ventas = "SELECT * FROM facturas_ventas WHERE numero_factura_real = '$numero_factura_real' LIMIT 1";
                // Ejecutamos el Query.
                    $consulta_ventas = $dblink -> query($query_ventas);				
                        if($consulta_ventas -> rowCount() > 0){
                            $respuestaOK = false;
                            $contenidoOK = $query_ventas;
                            $mensajeError = "No Eliminar";
                            }
                        else{
                            // Armar query.
                            $query = "DELETE FROM facturas_tiraje WHERE id_factura_tiraje = $id_";
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