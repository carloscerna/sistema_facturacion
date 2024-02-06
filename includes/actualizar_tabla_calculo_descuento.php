<?php
// ruta de los archivos con su carpeta
    $path_root=trim($_SERVER['DOCUMENT_ROOT']);
// archivos que se incluyen.
    include($path_root."/sistema_facturacion/includes/funciones.php");
// omitir errores.
ini_set("display_error", true);
// variables/conexion.
    $host2 = 'localhost';
    $port2 = 5432;
    $database2 = 'sgf_web';
    $username2 = 'postgres';
    $password2 = 'Orellana';
//Construimos el DSN//
try{
    $dsn2 = "pgsql:host=$host2;port=$port2;dbname=$database2";
}catch(PDOException $e) {
         echo  $e->getMessage();
         $errorDbConexion2 = true;   
     }
// Creamos el objeto
    $dblink2 = new PDO($dsn2, $username2, $password2);
// Validar la conexión.
    if(!$dblink2){
     // Variable que indica el status de la conexión a la base de datos
        $errorDbConexion2 = true;   
    };

//
//
//
// variables/conexion.
    $host = 'localhost';
    $port = 5432;
    $database = 'sgf_web';
    $username = 'postgres';
    $password = 'Orellana';
//Construimos el DSN//
try{
    $dsn = "pgsql:host=$host;port=$port;dbname=$database";
}catch(PDOException $e) {
         echo  $e->getMessage();
         $errorDbConexion = true;   
     }
// Creamos el objeto
    $dblink = new PDO($dsn, $username, $password);
// Validar la conexión.
    if(!$dblink){
     // Variable que indica el status de la conexión a la base de datos
        $errorDbConexion = true;   
    };

// datos de la tabla de facturas_compras.
        $num = 1;
      $query = "SELECT * FROM facturas_ventas ORDER BY fecha, numero_factura ASC";
      $result_ = $dblink -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $fecha = cambiaf_a_normal($row_["fecha"]);
                    $codigo_forma_pago = ($row_["codigo_forma_pago"]);
                    $total_venta = ($row_["total_venta"]);
                    $codigo_tipo_factura = ($row_["codigo_tipo_factura"]);
                    $tipo_factura = ($row_["codigo_tipo_factura"]);
                    $numero_factura_real = ($row_["numero_factura_real"]);
                    $numero_factura = ($row_["numero_factura"]);
                    $codigo_descuento = ($row_["codigo_descuento"]);
                    
                    if($codigo_descuento <> "01"){
                        //print "No.-> $num Fecha-> $fecha Numero Factura-> $numero_factura Codigo Tipo Factura-> $codigo_tipo_factura Codigo Descuendo-> $codigo_descuento";
                        //print "<br>";
                        $num++;
                        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        // ACTUALIZAR TOTAL VENTA EN LA TABLA FACTURAS VENTAS.
                        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $tipo_factura = "01";
                            $i=1; $var_f_e_t = 0; $sumas_ventas_exentas = 0; $sumas_ventas_gravadas = 0; $sumas_ventas_gravadas_procesar = 0;
                        $sumas_ventas_exentas_procesar = 0; $descuento_procesar = 0;
                    // Armar Consulta para Recorrer la factura.
                            $query_factura = "SELECT fac_dv.codigo_producto, fac_dv.numero_factura, fac_dv.cantidad, fac_dv.precio_venta, fac_dv.precio_venta as venta_exenta, fac_dv.codigo_tipo_factura, 
                                        fac_v.fecha, fac_v.codigo_descuento, cat_des.descripcion as porcentaje, fac_v.codigo_vendedor,
                                        cat_pro.descripcion, cat_pro.producto_exento,
                                        (cli.nombres || cast( ' ' as varchar) || cli.apellidos) as nombre_completo, cli.direccion, cli.dui, cli.nit, cli.cliente_empresa
                                        FROM facturas_detalles_ventas fac_dv
                                            INNER JOIN facturas_ventas fac_v ON fac_v.numero_factura = fac_dv.numero_factura
                                            INNER JOIN catalogo_productos cat_pro ON (cat_pro.codigo_categoria || cat_pro.codigo) = fac_dv.codigo_producto
                                            INNER JOIN clientes cli ON cli.codigo = fac_v.codigo_cliente
                                            INNER JOIN catalogo_descuento cat_des ON cat_des.codigo = fac_v.codigo_descuento
                                                WHERE fac_dv.numero_factura_real = '$numero_factura_real' and fac_dv.numero_factura = {$numero_factura} and
                                        fac_v.codigo_tipo_factura = '$tipo_factura' and fac_dv.codigo_tipo_factura = '$tipo_factura' and fac_v.numero_factura_real = '$numero_factura_real' and fac_v.numero_factura = {$numero_factura}";
                    $resultado_factura = $dblink -> query($query_factura);
            //	Recorrer la tabla en donde se encuentra la información del DETALLE DE LA FACTURA TEMP.
                    while($row_factura = $resultado_factura -> fetch(PDO::FETCH_BOTH))
                        {
                            // oPTENER VALORES DE LA CONSULTA.
                            $fecha = cambiaf_a_normal($row_factura["fecha"]);
                            $porcentaje = number_format($row_factura['porcentaje'] / 100,2);
                            $cantidad = trim($row_factura["cantidad"]);
                            $precio_unitario = number_format(trim($row_factura['precio_venta']),4);
                            $venta_exenta = number_format(trim($row_factura['venta_exenta']),4);
                            $producto_exento = (trim($row_factura['producto_exento']));
                            $codigo_tipo_factura = trim($row_factura['codigo_tipo_factura']);
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
                                        $precio_total_ventas_exentas = $cantidad * $venta_exenta;
                                        $sumas_ventas_exentas = number_format($sumas_ventas_exentas + $precio_total_ventas_exentas,2);
                                        // CALCULO DE VENTAS CON IVA O SEA PRECIO UNITARIO.
                                        $precio_total_ventas_gravadas = $cantidad * $precio_unitario;
                                        $sumas_ventas_gravadas_procesar = ($sumas_ventas_gravadas_procesar + $precio_total_ventas_gravadas);
                                        $sumas_ventas_gravadas = number_format($sumas_ventas_gravadas_procesar,2,'.',',');
                                        // CALCULO DE LAS SUMA DE LOS DOS PRECIO UNITARIO Y VENTAS EXENTAS.
                                        $venta_total_procesar = ($sumas_ventas_exentas + $sumas_ventas_gravadas_procesar);
                                        $venta_total = number_format($venta_total_procesar,2,'.',',');
                                        $descuento_procesar = ($venta_total_procesar * $porcentaje);
                                        $descuento = number_format($descuento_procesar,2,'.',',');
                                        $venta_total_descuento_procesar = ($venta_total_procesar - $descuento_procesar);
                                        $venta_total_descuento = number_format($venta_total_descuento_procesar,2,'.',',');
                                        // Validar para imprimri el valor de la venta total con o sin descuento.
                                        if($porcentaje >0){
                                            $venta_total = $venta_total_descuento_procesar;
                                        }
                                      // Validar cuando el producto es exento de iva.
                                      if($producto_exento == "01"){
                                            $precio_total = number_format($precio_total_ventas_exentas,2);}
                                        else{
                                            $precio_total = number_format($precio_total_ventas_gravadas,2);}									
                                        }
            }   // WHILE DE FACTURAS VENTAS.
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    // GUARDAR EL TOTAL DE VENTA
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    $query_venta_descuento = "UPDATE facturas_ventas SET total_venta = $venta_total
                    WHERE numero_factura_real = '$numero_factura_real' and numero_factura = {$numero_factura} and
                    codigo_tipo_factura = '$tipo_factura' and codigo_tipo_factura = '$tipo_factura' and numero_factura_real = '$numero_factura_real' and numero_factura = {$numero_factura}";
                    print "Fecha-> $fecha - No.-> $numero_factura - Venta Total $-> $venta_total - *****<br>";
                    //$resultado_ = $dblink -> query($query_venta_descuento); 
        } // IF DE CODIGO TIPO DESCUENTO.
        else{
            print "Fecha-> $fecha - No.-> $numero_factura - Venta Total $-> $total_venta<br>";
        }
    }   // WHILE DE FACTURAS VENTAS.
?>