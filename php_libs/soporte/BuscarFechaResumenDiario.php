<?php
sleep(0);
setlocale(LC_MONETARY, 'en_US');
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
//	include($path_root."/sistema_facturacion/includes/DeNumero_a_Letras.php");
	include($path_root."/sistema_facturacion/includes/mainFunctions_conexion.php");
	//include($path_root."/sistema_facturacion/includes/NumberToLetterConverter.class.php");
// cambiar a utf-8.
    header("Content-Type: text/html; charset=UTF-8");    
// variables y consulta a la tabla.
	if(isset($_REQUEST["fecha"])){
    $fecha = $_REQUEST["fecha"];}
// Inicializamos variables de mensajes y JSON
  $respuestaOK = false;
  $mensajeError = "No Registro";
  $contenidoOK = "";
	$printer = 0;
  $db_link = $dblink;
// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		if(!empty($_POST['accion_fecha_buscar'])){
			$_POST['accion'] = $_POST['accion_fecha_buscar'];
		}
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
      case 'BuscarFechas':
				// Armamos el query.
				$query = "SELECT * FROM facturas_ventas WHERE fecha = '$fecha'";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Validar si hay registros.
				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$mensajeError = "Si Registro";
				}
			break;			
      
      case 'BuscarCodigosBarra':
				// Armamos el query.
				$query = "SELECT * FROM temp_codigo_barra";
				// Ejecutamos el Query.
				$consulta = $dblink -> query($query);
				// Validar si hay registros.
				if($consulta -> rowCount() != 0){
					$respuestaOK = true;
					$mensajeError = "Si Registro";
				}
			break;

      case 'BuscarFacturasComprasVentas':
            // EXTRAER VARIALES DEL REQUEST.
                $mes = $_REQUEST["mes"];
                $mes = '01/'.$mes;
            // ELIMINAR UNA VISTA
                $query_eliminar_vista = "DROP VIEW facturas_compras_vista";
                $consulta_eliminar_vista = $dblink -> query($query_eliminar_vista);
          // CREAR UNA VISTA DE LA TABLA FACTURAS COMPRAS.
            $query_crear_vista = "create view facturas_compras_vista as 
              select sum(total_compra) as total_compras, 
                  count(1) as contador,
                  fecha::date as fecha_compra,
                  codigo_proveedor as codigo, numero_factura as num_factura,
                  date_part('year',fecha at time zone 'hst') as year,
                  date_part('quarter',fecha at time zone 'hst') as quarter,
                  date_part('month',fecha at time zone 'hst') as month,
                  date_part('day',fecha at time zone 'hst') as day
                    from facturas_compras
                      group by fecha, codigo_proveedor, numero_factura
                      order by fecha";
            $consulta_crear_vista = $dblink -> query($query_crear_vista);
            // -- VER SEGUN LA FECHA
              $query_consulta_vista="
                      select 
                        the_date, 
                        sum(total_compras) as sales, 
                        sum(contador) as sales_count,
                        facturas_compras_vista.codigo,
                        pro.nombre_empresa as nombre_proveedor,
                        facturas_compras_vista.num_factura
                      from dates_in_month('$mes')
                      left join facturas_compras_vista on the_date = facturas_compras_vista.fecha_compra
                      inner join proveedores pro ON pro.codigo = facturas_compras_vista.codigo
                      group by dates_in_month.the_date, facturas_compras_vista.codigo, facturas_compras_vista.num_factura, pro.nombre_empresa
                      order by the_date";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_consulta_vista);
              $num = 1; $total_mes = 0;
            // Validar si hay registros.
            if($consulta_historial -> rowCount() != 0){
              $respuestaOK = true;
              $mensajeError = "Si Registro";
                ////////////////////////////////////////////////////////							
							    while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
							      {
                        // recopilar los valores de los campos.
                        $fecha = cambiaf_a_normal(trim($listadoHistorial['the_date']));
                        $numero_factura = trim($listadoHistorial['num_factura']);
                        $codigo = trim($listadoHistorial['codigo']);
                        $nombre_proveedor = trim($listadoHistorial['nombre_proveedor']);
                        $total_compra= trim($listadoHistorial['sales']);
                        
                        if(is_numeric($total_compra))
                        {
                            $total_mes = $total_mes + round($total_compra,2);
                            $contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
                                          .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$fecha
                                          .'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$numero_factura
                                          .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$codigo
                                          .'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$nombre_proveedor
                                          .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$total_compra
                                          .'<td class = centerTXT><a data-accion=VerCompra class="btn btn-sm btn-info" href='.$codigo.'-'.$numero_factura.' title="Ver"><span class="fa fa-search"></span> </a>';
                          $total_compra = 0;
                          $num++;
                        }
							      } // WHILE QUE LEE LA CONSULTA.
                    
                    // GREGAR LA ULTIMA FILA QUE SERA LA SUMA
                        $total_mes = number_format($total_mes,2);
                      $contenidoOK .='<tr><td><td><td>
                                      <td><td>Total del Mes
                                      <td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"><b> $ '.$total_mes.'</b>';
            }
          break;
        
          case 'BuscarFacturasComprasVentasMes':
            // EXTRAER VARIALES DEL REQUEST.
                $mes_nombre = array("None","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $numero_mes = array("0","01","02","03","04","05","06","07","08","09","10","11","12",);
                $fecha = $_REQUEST["mes"];
                $partes = explode('/', $fecha);
                $num=0; $total_meses = array();
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //  REPETIR EL PROCESO 12 VECES.
            for($i=1;$i<count($mes_nombre);$i++){    
                $fecha_formateada = "01/$numero_mes[$i]/$partes[1]";
            // -- VER SEGUN LA FECHA
                $query_consulta_vista="
                      select 
                        the_date, 
                        sum(total_compras) as sales, 
                        sum(contador) as sales_count,
                        facturas_compras_vista.codigo,
                        pro.nombre_empresa as nombre_proveedor,
                        facturas_compras_vista.num_factura
                      from dates_in_month('$fecha_formateada')
                      left join facturas_compras_vista on the_date = facturas_compras_vista.fecha_compra
                      inner join proveedores pro ON pro.codigo = facturas_compras_vista.codigo
                      group by dates_in_month.the_date, facturas_compras_vista.codigo, facturas_compras_vista.num_factura, pro.nombre_empresa
                      order by the_date";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_consulta_vista);
              $total_mes = 0;
            // Validar si hay registros.
                  if($consulta_historial -> rowCount() != 0){
                    $respuestaOK = true;
                    $mensajeError = "Si Registro";
                      ////////////////////////////////////////////////////////							
                        while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
                          {
                              // recopilar los valores de los campos.
                              $total_compra= trim($listadoHistorial['sales']);
                              
                              if(is_numeric($total_compra))
                              {
                                  $total_mes = $total_mes + round($total_compra,2);
                                  $total_compra = 0;
                              }
                          } // WHILE QUE LEE LA CONSULTA.
                          
                          // GREGAR LA ULTIMA FILA QUE SERA LA SUMA
                            $num++;
                            $total_meses[$i] = $total_mes;
                            $total_mes = number_format($total_mes,2);
                                  $contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
                                                .'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$mes_nombre[$i]
                                                .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$total_mes
                                                ;
                  } // FIN DEL IF
            } // FIN DEL FOR.
            // AGREGAR EL TOTAL DE TODOS LOS MESES.
              $contenidoOK .= '<tr><td><td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">Total'.
                              '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"><b>'.number_format(array_sum($total_meses),2);
			break;
  case 'BuscarFacturasVentasMes':
            // EXTRAER VARIALES DEL REQUEST.
                $mes_nombre = array("None","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $numero_mes = array("0","01","02","03","04","05","06","07","08","09","10","11","12",);
                $fecha = $_REQUEST["mes"];
                $partes = explode('/', $fecha);
                $num=0; $total_meses = array();
                // ELIMINAR UNA VISTA
                  $query_eliminar_vista = "DROP VIEW facturas_ventas_vista";
                  $consulta_eliminar_vista = $dblink -> query($query_eliminar_vista);
              // CREAR UNA VISTA DE LA TABLA FACTURAS COMPRAS.
                  $query_crear_vista = "create view facturas_ventas_vista as 
                              select sum(total_venta) as total_ventas, 
                              count(1) as contador,
                              fecha::date as fecha_venta,
                              codigo_cliente as codigo, numero_factura as num_factura,
                              date_part('year',fecha at time zone 'hst') as year,
                              date_part('quarter',fecha at time zone 'hst') as quarter,
                              date_part('month',fecha at time zone 'hst') as month,
                              date_part('day',fecha at time zone 'hst') as day
                            from facturas_ventas
                            group by fecha, codigo_cliente, numero_factura
                            order by fecha";
                  $consulta_crear_vista = $dblink -> query($query_crear_vista);
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //  REPETIR EL PROCESO 12 VECES.
            for($i=1;$i<count($mes_nombre);$i++){    
                $fecha_formateada = "01/$numero_mes[$i]/$partes[1]";
            // -- VER SEGUN LA FECHA
                $query_consulta_vista="
                      select 
                          the_date, 
                          sum(total_ventas) as sales, 
                          sum(contador) as sales_count,
                          facturas_ventas_vista.codigo,
                          cli.cliente_empresa as nombre_cliente,
                          facturas_ventas_vista.num_factura
                        from dates_in_month('$fecha_formateada')
                        left join facturas_ventas_vista on the_date = facturas_ventas_vista.fecha_venta
                        inner join clientes cli ON cli.codigo = facturas_ventas_vista.codigo
                        group by dates_in_month.the_date, facturas_ventas_vista.codigo, facturas_ventas_vista.num_factura, cli.cliente_empresa
                        order by the_date";
					// Ejecutamos el Query. PARA LA TABLA EMPLEADOS.
							$consulta_historial = $dblink -> query($query_consulta_vista);
              $total_mes = 0;
            // Validar si hay registros.
                  if($consulta_historial -> rowCount() != 0){
                    $respuestaOK = true;
                    $mensajeError = "Si Registro";
                      ////////////////////////////////////////////////////////							
                        while($listadoHistorial = $consulta_historial -> fetch(PDO::FETCH_BOTH))
                          {
                              // recopilar los valores de los campos.
                              $total_compra= trim($listadoHistorial['sales']);
                              
                              if(is_numeric($total_compra))
                              {
                                  $total_mes = $total_mes + round($total_compra,2);
                                  $total_compra = 0;
                              }
                          } // WHILE QUE LEE LA CONSULTA.
                          
                          // GREGAR LA ULTIMA FILA QUE SERA LA SUMA
                            $num++;
                            $total_meses[$i] = $total_mes;
                            $total_mes = number_format($total_mes,2);
                                  $contenidoOK .= '<tr><td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$num
                                                .'<td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$mes_nombre[$i]
                                                .'<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0">'.$total_mes
                                                ;
                  } // FIN DEL IF
            } // FIN DEL FOR.
            // AGREGAR EL TOTAL DE TODOS LOS MESES.
              $contenidoOK .= '<tr><td><td align=left class="border border-dark border-top-0 border-bottom-0 border-left-0">Total'.
                              '<td align=right class="border border-dark border-top-0 border-bottom-0 border-left-0"><b>'.number_format(array_sum($total_meses),2);
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
		// Armamos array para convertir a JSON
		$salidaJson = array("respuesta" => $respuestaOK,
			"mensaje" => $mensajeError,
			"contenido" => $contenidoOK);
		echo json_encode($salidaJson);
?>