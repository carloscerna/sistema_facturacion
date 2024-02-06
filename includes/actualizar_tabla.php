<?php
// iniciar sesssion.
//session_name('demoUI');
//session_start();
// omitir errores.
ini_set("display_error", true);
// variables/conexion.
    $host2 = 'localhost';
    $port2 = 5432;
    $database2 = 'sgf_web_2015';
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
/*
// datos de la tabla de facturas_compras.
      $query = "SELECT * FROM facturas_compras WHERE numero_factura = 3793";
      $result_ = $dblink -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $codigo_proveedor = ($row_["codigo_proveedor"]);
                    $fecha = ($row_["fecha"]);
                    $codigo_forma_pago = ($row_["codigo_forma_pago"]);
                    $total_compra = ($row_["total_compra"]);
                    $estado_factura = ($row_["estado_factura"]);
                    $codigo_vendedor = ($row_["codigo_vendedor"]);
                    $codigo_tipo_factura = ($row_["codigo_tipo_factura"]);
                    $numero_factura = ($row_["numero_factura"]);
                    $codigo_descuento = ($row_["codigo_descuento"]);
                 }

    $query_i = "INSERT INTO facturas_compras (codigo_proveedor, fecha, codigo_forma_pago, total_compra, estado_factura, codigo_vendedor, codigo_tipo_factura, numero_factura, codigo_descuento)
                VALUES ('$codigo_proveedor','$fecha','$codigo_forma_pago','$total_compra','$estado_factura','$codigo_vendedor','$codigo_tipo_factura','$numero_factura','$codigo_descuento')";
    $result_i = $dblink2 -> query($query_i);
    print $query_i;*/
//
//  facturas detalles compras
//
// datos de la tabla de facturas_compras.
/*
      $query = "SELECT * FROM facturas_detalles_compras WHERE numero_factura = 3792";
      $result_ = $dblink -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $codigo_producto = ($row_["codigo_producto"]);
                    $codigo_tipo_factura = ($row_["codigo_tipo_factura"]);
                    $numero_factura = ($row_["numero_factura"]);
                    $cantidad = ($row_["cantidad"]);
                    $precio_compra = ($row_["precio_compra"]);
                    $codigo_tipo_factura = ($row_["codigo_tipo_factura"]);
                 
                 //
                 // insertar datos en la facturas_detalles_compras
                 //
                    $query_i = "INSERT INTO facturas_detalles_compras (codigo_producto, numero_factura, cantidad, precio_compra, codigo_tipo_factura)
                                VALUES ('$codigo_producto','$numero_factura','$cantidad','$precio_compra','$codigo_tipo_factura')";
                    $result_i = $dblink2 -> query($query_i);
                    print $query_i;

                 }
                 
 */
/*
      $query = "SELECT * FROM clientes";
      $result_ = $dblink2 -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $id_ = ($row_["id_clientes"]);
                    $apellidos = trim($row_["apellidos"]);
                    $nombres = trim($row_["nombres"]);
                    $cliente_empresa = $nombres . ' ' . $apellidos;
                 //
                 // insertar datos en la facturas_detalles_compras
                 //
                    $query_i = "UPDATE clientes SET cliente_empresa = '$cliente_empresa' WHERE id_clientes = '$id_'";
                    $result_i = $dblink2 -> query($query_i);
                    print $query_i."<br>";

                 }
     
 //
// datos de la tabla de catalogo productos a productos unidad de medida.
/*
      $query = "SELECT * FROM catalogo_productos";
      $result_ = $dblink -> query($query);
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $codigo_producto = ($row_["codigo"]);
                    $codigo_categoria = ($row_["codigo_categoria"]);
                    $codigo_unidad_medida = '01';
                 //
                 // insertar datos en la facturas_detalles_compras
                 //
                    $query_i = "INSERT INTO productos_unidad_medida (codigo_producto, codigo_categoria, codigo_unidad_medida)
                                VALUES ('$codigo_producto','$codigo_categoria','$codigo_unidad_medida')";
                    $result_i = $dblink -> query($query_i);
                    print $query_i ."<br>";

                 }*/

//
//  buascar clientes que existen en facturas ventas pero han sido eliminados de la tabla clientes.
//
// datos de la tabla de facturas_ventas.
$fila = 0; $contar = 0; $sumas_ventas = 0;
      $query = "SELECT * FROM facturas_ventas";
      $result_ = $dblink -> query($query); 
    // Extraer valore de la consulta.
				 while($row_ = $result_ -> fetch(PDO::FETCH_BOTH))
				 {
                    $id_ = ($row_["id_ventas"]);
                    $codigo_cliente = ($row_["codigo_cliente"]);
                    $numero_factura = ($row_["numero_factura"]);
                    $fecha = ($row_["fecha"]);
                    $numero_factura_real = ($row_["numero_factura_real"]);
                    $total_venta = ($row_["total_venta"]);
                // buscar tabla clientes.
                    $query_clientes = "SELECT * FROM clientes WHERE codigo = '$codigo_cliente'";
                    $result_clientes = $dblink -> query($query_clientes);
                    $fila = $result_clientes -> rowCount();
                    
                    if($fila == 0){
                        $contar++; $sumas_ventas = $sumas_ventas + $total_venta;
                        print "Registro Encontrado id_venta: $id_ " . "-";
                        print "Codigo Cliente" . $codigo_cliente . ' # Factura ' . $numero_factura . ' Fecha: ' . $fecha . ' # Fac. Real ' . $numero_factura_real;
                        print " Total venta $total_venta " . "<br>";
                    }
                 }
                 print "Numero de facturas encontradas: '$contar'" . " total de la venta: $ . '$sumas_ventas'";
?>