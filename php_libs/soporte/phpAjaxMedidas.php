<?php
//session_name('demoUI');
//session_start();
// limpiar cache.
clearstatcache();
// Script para ejecutar AJAX
// cambiar a utf-8.
header("Content-Type: text/html;charset=iso-8859-1");
// Insertar y actualizar tabla de usuarios
//sleep(1);

// Inicializamos variables de mensajes y JSON
$datos = array();
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
    
// Incluimos el archivo de funciones y conexión a la base de datos

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
			///////////////////////////////////////////////////////////////////////////////////////////////////
			////////////// BLOQUE DE REGISTRO GESTION (MEDIDAS)
			///////////////////////////////////////////////////////////////////////////////////////////////////
			case 'BuscarCodigoMedida':
				// Armamos el query.
				$query = "SELECT id_medida, nombre, codigo FROM medida ORDER BY codigo DESC LIMIT 1";
				// Ejecutamos el Query.
				$fila_array = 0;
				$consulta = $dblink -> query($query);

				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
						$codigo = trim($listado['codigo']);
						$datos[$fila_array]["codigo_medida"] = $codigo;	
					}
				}
			break;
			case 'BuscarMedida':
				// variables
				$codigo_modalidad = $_POST['codigo_modalidad'];
				$printer = $_POST['printer'];
				// Armamos el query.
				$query = "SELECT m.id_medidas, m.fila, m.columna, m.descripcion, m.codigo_modalidad, m.printer, m.codigo_fuente, m.codigo_estilo, m.codigo_tamano,
							 cat_f.descripcion as nombre_fuente, cat_e.descripcion as nombre_estilo, cat_t.descripcion as tamano_fuente
						 FROM medidas m
						 INNER JOIN catalogo_fuente cat_f ON cat_f.codigo = m.codigo_fuente
						 INNER JOIN catalogo_estilo cat_e ON cat_e.codigo = m.codigo_estilo
						 INNER JOIN catalogo_tamano cat_t ON cat_t.codigo = m.codigo_tamano
						 WHERE m.codigo_modalidad = '".$codigo_modalidad."' and m.printer = ".$printer." ORDER BY m.id_medidas";
						 
				$query_nombre_fuente = "SELECT codigo, descripcion FROM catalogo_fuente ORDER BY codigo";
				$query_nombre_estilo = "SELECT codigo, descripcion FROM catalogo_estilo ORDER BY codigo";
				$query_nombre_tamaño = "SELECT codigo, descripcion FROM catalogo_tamano ORDER BY codigo";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				$consulta_nombre_fuente = $dblink -> query($query_nombre_fuente);
				$consulta_nombre_estilo = $dblink -> query($query_nombre_estilo);
				$consulta_nombre_tamaño = $dblink -> query($query_nombre_tamaño);

				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$num = 0;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
					// variables
					$printer = trim($listado['printer']);
					$codigo_modalidad = trim($listado['codigo_modalidad']);
					$descripcion = trim($listado['descripcion']);
					$linea = trim($listado['fila']);
					$columna = trim($listado['columna']);
					$codigo_fuente_tbl = trim($listado['codigo_fuente']);
					$codigo_estilo_tbl = trim($listado['codigo_estilo']);
					$codigo_tamaño_tbl = trim($listado['codigo_tamano']);
					$nombre_fuente = trim($listado['nombre_fuente']);
					$nombre_estilo = trim($listado['nombre_estilo']);
					$nombre_tamaño = trim($listado['tamano_fuente']);
					
					$id_medida = trim($listado['id_medidas']);
					$num++;

					//
					// Crear rutina para captar los valores del codigo_fuente.
					//
						$lst_nombre_fuente = "<select name=codigo_fuente class=form-control>";
					// Ejecutamos el Query Grado - Sección.
						$consulta_nombre_fuente = $dblink -> query($query_nombre_fuente);
					// Recorriendo la Tabla con PDO::
					      while($listado_g = $consulta_nombre_fuente -> fetch(PDO::FETCH_BOTH))
							{
								// Nombres de los campos de la tabla.
								$codigo_fuente = trim($listado_g['codigo']); $descripcion_fuente = trim($listado_g['descripcion']);
								
								  // Rellenar el select. comprobando el codigo de la tabla con  la del catagalogo.
								if($codigo_fuente == $codigo_fuente_tbl)
								{
								   $lst_nombre_fuente .="<option value=$codigo_fuente selected>".$descripcion_fuente;	
								  }else{
								   $lst_nombre_fuente .="<option value=$codigo_fuente>".$descripcion_fuente;	
								}
							}
						// cerrar el select de grado sección.
						$lst_nombre_fuente .="</select>";
						
						//
					// Crear rutina para captar los valores del codigo_fuente.
					//
						$lst_nombre_estilo = "<select name=codigo_estilo class=form-control>";
					// Ejecutamos el Query Grado - Sección.
						$consulta_nombre_estilo = $dblink -> query($query_nombre_estilo);
					// Recorriendo la Tabla con PDO::
					      while($listado_g = $consulta_nombre_estilo -> fetch(PDO::FETCH_BOTH))
							{
								// Nombres de los campos de la tabla.
								$codigo_estilo = trim($listado_g['codigo']); $descripcion_estilo = trim($listado_g['descripcion']);
								
								  // Rellenar el select. comprobando el codigo de la tabla con  la del catagalogo.
								if($codigo_estilo == $codigo_estilo_tbl)
								{
								   $lst_nombre_estilo .="<option value=$codigo_estilo selected>".$descripcion_estilo;	
								  }else{
								   $lst_nombre_estilo .="<option value=$codigo_estilo>".$descripcion_estilo;	
								}
							}
						// cerrar el select de grado sección.
						$lst_nombre_estilo .="</select>";
						

						//
					// Crear rutina para captar los valores del codigo_fuente.
					//
						$lst_nombre_tamaño = "<select name=codigo_tamano class=form-control>";
					// Ejecutamos el Query Grado - Sección.
						$consulta_nombre_tamaño = $dblink -> query($query_nombre_tamaño);
					// Recorriendo la Tabla con PDO::
					      while($listado_g = $consulta_nombre_tamaño -> fetch(PDO::FETCH_BOTH))
							{
								// Nombres de los campos de la tabla.
								$codigo_tamaño = trim($listado_g['codigo']); $descripcion_tamaño = trim($listado_g['descripcion']);
								
								  // Rellenar el select. comprobando el codigo de la tabla con  la del catagalogo.
								if($codigo_tamaño == $codigo_tamaño_tbl)
								{
								   $lst_nombre_tamaño .="<option value=$codigo_tamaño selected>".$descripcion_tamaño;	
								  }else{
								   $lst_nombre_tamaño .="<option value=$codigo_tamaño>".$descripcion_tamaño;	
								}
							}
						// cerrar el select de grado sección.
						$lst_nombre_tamaño .="</select>";
						
						$contenidoOK .= '<tr>
							<td class=centerTXT>'.$num
							.'<td><input type=hidden name=codigo_medida value='.$id_medida.'>'
							.'<td class=centerTXT>'.$printer
							.'<td class=centerTXT>'.$codigo_modalidad
							.'<td class=centerTXT>'.$descripcion
							.'<td><input type = number name=linea min=1 max=300 value = '.$linea.' class="form-control">'
							.'<td><input type = number name=columna min=1 max=300 value = '.$columna.' class="form-control">'
							.'<td class=centerTXT>'.$lst_nombre_fuente
							.'<td class=centerTXT>'.$lst_nombre_estilo
							.'<td class=centerTXT>'.$lst_nombre_tamaño
							;
					}
					$mensajeError = "Se ha consultado el registro correctamente ";
				}else{
					$mensajeError = $query;
				}
			break;
			case 'ActualizarDatosMedida':		
				// armar variables y consulta Query.
				$codigo_medida[] = $_POST["codigo_medida"];
				$linea[] = $_POST["linea"];
				$columna[] = $_POST["columna"];
				$codigo_fuente[] = $_POST["codigo_fuente"];
				$codigo_estilo[] = $_POST["codigo_estilo"];
				$codigo_tamano[] = $_POST["codigo_tamano"];
				
				// Variales.
				$fila = $_POST["fila"];
			
				$fila = $fila - 1;

				// recorrer la array para extraer los datos.
				for($i=0;$i<=$fila;$i++){
					$codigo_m = $codigo_medida[0][$i];
					$li = $linea[0][$i];
					$col = $columna[0][$i];
					$codigo_f = $codigo_fuente[0][$i];
					$codigo_e = $codigo_estilo[0][$i];
					$codigo_t = $codigo_tamano[0][$i];
					
					// armar sql para actualizar tabla alumno_matricula.
					$query = "UPDATE medidas SET
										fila = '$li',
										columna = '$col',
										codigo_fuente = '$codigo_f',
										codigo_estilo = '$codigo_e',
										codigo_tamano = '$codigo_t'
											WHERE id_medidas =".$codigo_m;
					// Ejecutamos el Query.
					$consulta_alumno = $dblink -> query($query);
				}
				
				$respuestaOK = true;
				$contenidoOK = 'Registros Actualizados.';
				$mensajeError =  'Si Registro';
			break;		
			case 'editar_medida':
				// Armamos el query y iniciamos variables.
					$query = "SELECT id_medidas, linea, columna, descripcion FROM medidas WHERE id_medidas = ".$_POST['id_x'];
					$fila_array = 0;
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);

				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$fila_array = 0;
					// convertimos el objeto
					while($listado = $consulta -> fetch(PDO::FETCH_BOTH))
					{
					// variables
					$id_medida = trim($listado['id_medidas']);
					$linea = trim($listado['linea']);
					$columna = trim($listado['columna']);
					$descripcion = trim($listado['descripcion']);
					
					$datos[$fila_array]["id_medida"] = $id_medida;
					$datos[$fila_array]["linea"] = $linea;
					$datos[$fila_array]["columna"] = $columna;
					$datos[$fila_array]["descripcion_medida"] = $descripcion;
					$fila_array++;
					}
					$mensajeError = "Se ha consultado el registro correctamente ";
				}else{
					$mensajeError = $query;
				}
				break;
			case 'modificar_medida':
				$id_medida = $_POST['id_x'];
				$linea_x = ($_POST['linea_x']);
				$columna_x = ($_POST['columna_x']);
				// Armamos el query y iniciamos variables.
					$query = "UPDATE medidas SET linea = '$linea_x', columna = '$columna_x' WHERE id_medidas = ". $id_medida;
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
					$respuestaOK = true;
					$contenidoOK = "Registro Actualizado.";
					$mensajeError = "Se ha consultado el registro correctamente ";
			break;
			case 'addMedida':
				// consultar el registro antes de agregarlo.
				// Armamos el query y iniciamos variables.
				 $nombre = strtoupper($_POST['nombre_medida']);
				 $codigo_medida = ($_POST['codigo_medida']);
				 $query = "SELECT id_medida, nombre, codigo FROM medida WHERE codigo = '".$codigo_medida. "' ORDER BY codigo ";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);

				if($consulta -> rowCount() != 0){
					$respuestaOK = false;
					$contenidoOK = "Este registro ya Existe";
					$mensajeError = "Este registro ya Existe.";
				}else{
				// proceso para grabar el registro
					$query = "INSERT INTO medida (nombre, codigo) VALUES ('$nombre','$codigo_medida')";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
					$respuestaOK = true;
					$contenidoOK = "Registro Agregado.";
					$mensajeError = "Se ha consultado el registro correctamente ";
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

if($_POST['accion'] == "ActualizarDatosMedida" || $_POST['accion'] == "BuscarMedida" || $_POST['accion'] == "eliminar_municipio" || $_POST['accion'] == "modificar_medida" || $_POST['accion'] == "addMedida" || $_POST['accion'] == "BuscarMedida" || $_POST['accion'] == "BuscarDepartamento" || $_POST['accion'] == "BuscarMunicipio" || $_POST['accion'] == "addMunicipio" || $_POST['accion'] == "modificar_annlectivo" || $_POST['accion'] == "BuscarDepartamento" || $_POST['accion'] == "modificar_departamento" || $_POST['accion'] == "addDepartamento" || $_POST['accion'] == "modificar_municipio" || $_POST['accion'] == "buscar_municipio") {
// Armamos array para convertir a JSON
$salidaJson = array("respuesta" => $respuestaOK,
		"mensaje" => $mensajeError,
		"contenido" => $contenidoOK);
echo json_encode($salidaJson);
}

if($_POST['accion'] == "editar_departamento" || $_POST['accion'] == "editar_municipio" || $_POST['accion'] == "editar_medida" || $_POST['accion'] == "BuscarCodigoMedida" || $_POST['accion'] == "BuscarCodigoAnnLectivo" || $_POST['accion'] == "editar_municipio" || $_POST['accion'] == "BuscarCodigoMunicipio" || $_POST['accion'] == "BuscarCodigoDepartamento") {
// Armamos array para convertir a JSON
echo json_encode($datos);
}

?>