//// CARGAR INFORMACIÓN  -- VARIABLES PÚBLICAS.
var NumeroFacturaReal = "";
var numero_linea_factura = 0;
var numero_fin = 0;
var numero_factura = 0;
var accion = "noAccion";
var descuento = 0;
var codigo_tipo_factura = ""
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIOND E LA FECHA, Y PASAR A CIERTOS OBJETOS.
///////////////////////////////////////////////////////////////////////////////
$(document).ready(function()
	{
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                ann = now.getFullYear();
                var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
				$("#txtFechaVenta").val(today);                       
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// CARGAR INFORMACIÓN DE LAS TABLAS PARA LOS SELECT
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
////				
//// CARGAR INFORMACIÓN  -- NUMERO DE LINEA DE LA FACTURAL.
////		
	$(document).ready(function()
	{
			$.post("includes/cargar_numero_linea_factura.php", 
				function(data) {
					numero_linea_factura = data[0].numero_linea_factura;
					numero_fin = data[0].numero_fin;
					$("#lstLineaFactura").val(numero_linea_factura);
			}, "json");
			
			var miselect=$("#lstTipoFactura");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_tipo_factura.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						if(i==0 || i==1){
							miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
						}
						
					}
			}, "json");
	});
//// CARGAR INFORMACIÓN  -- TABLA DE DESCUENTO.
	$(document).ready(function()
	{
			var miselect=$("#lstDescuentoSVT");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_descuento.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");


});
//// CARGAR INFORMACIÓN  -- CODIGO DE VENDEDORES
	$(document).ready(function()
	{
			var miselect=$("#lstCodigoVendedor");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_vendedor.php",
				function(data) {
					miselect.empty();
                                     //   miselect.append('<option value=00>Seleccionar...</option>');
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");

                       
});
//// CARGAR INFORMACIÓN  -- FORMAS DE PAGO (CONTADO, CRÉDITO O CHEQUE)        
	$(document).ready(function()
	{
			var miselect=$("#lstFormaPago");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_forma_pago.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
});

		////				
		//// CARGAR INFORMACIÓN  -- NUMERO DE FACTURAL REAL.
		////
	$(document).ready(function()
	{
			$.post("includes/cargar_numero_factura_real.php",
				function(data) {
					NumeroFacturaReal = data[0].numero_factura_real;
					numero_fin = data[0].numero_fin;
					$("label[for='NumeroFacturaReal']").text(NumeroFacturaReal);
			}, "json");			
});
//// CARGAR INFORMACIÓN  -- TIPO DE FACTURA (CONSUMIDOR FINAL O CREDITO FISCAL.        
	$(document).ready(function()
	{
    // Caundo cambie el valor de tipo factura.
                $("#lstFormaPago").change(function () {                                
                        $("#lstFormaPago option:selected").each(function () {
                                codigo_forma_pago=$(this).val();
                                if(codigo_forma_pago === "01"){$('#estado_factura').val('01');}
                                if(codigo_forma_pago === "02" || codigo_forma_pago === "03"){$('#estado_factura').val('02');}
                    });
                });
    // Caundo cambie el valor de tipo factura.
                $("#txtNumeroFactura").change(function () {
                    VerificarNumeroFactura($(this).val());           
                }); 
    // Caundo cambie el valor PARA EL PORCENTAJE DEL DESCUENTO..
                $("#lstDescuentoSVT").change(function () {
                            accion = "VerDetalleFacturaTemp";
                            codigo_usuario = $("#lstCodigoVendedor").val(); // Código del vendedor se almacena para controla el detalle de la factura.
                            codigo_tipo_factura=$("#lstTipoFactura").val();
                                
                        $("#lstDescuentoSVT option:selected").each(function () {
                                        descuento =$(this).text();
                                        
                                        // REfisar si existe una factur a
                                        $.post("php_libs/soporte/DetalleFacturaTemp.php", {accion: accion, codigo_usuario: codigo_usuario, descuento: descuento, codigo_tipo_factura: codigo_tipo_factura},
                                               function(response){
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                         // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_ventas_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_ventas_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_ventas_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.venta_total_descuento);
                                                $("label[for='Total']").text(response.venta_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalVenta").val(response.venta_total);
                                                alertify.success("Registro(s) Actualizados.");
                                        }
                                }, "json");			
                    });
                });                       

    // Caundo cambie el valor de tipo factura.
                $("#lstTipoFactura").change(function () {
                            accion = "VerDetalleFacturaTemp";
                            codigo_usuario = $("#lstCodigoVendedor").val(); // Código del vendedor se almacena para controla el detalle de la factura.
                            descuento = $('#lstDescuentoSVT option:selected').text();        // Para Calbular el Porcentaje a Descontar de la Factura de Venta Total.
                                
                        $("#lstTipoFactura option:selected").each(function () {
                                        codigo_tipo_factura=$(this).val();
										// Verificar el NUMERO DE LINEAS PARA EL TIPO DE FACTURA.
													$.post("includes/cargar_numero_linea_factura.php", {codigo_tipo_factura: codigo_tipo_factura},
														function(data) {
															numero_linea_factura = data[0].numero_linea_factura;
															$("#lstLineaFactura").val(numero_linea_factura);
													}, "json");                                        
                                        // REfisar si existe una factur a
                                        $.post("php_libs/soporte/DetalleFacturaTemp.php", {codigo_tipo_factura: codigo_tipo_factura, accion: accion, codigo_usuario: codigo_usuario, descuento: descuento},
                                               function(response){
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                         // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_ventas_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_ventas_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_ventas_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.venta_total_descuento);
                                                $("label[for='Total']").text(response.venta_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalVenta").val(response.venta_total);
                                                alertify.error("Registro(s) Actualizados.");
                                        }
                                }, "json");
                    });
    					///
						/// VERIFICAR SI EL NUMERODE FACTURA ES MAYOR AL CREADO.
						///
							$("#txtNumeroFactura").val("");
							$("label[for='NumeroFacturaReal']").text("");
                });
///////////////////////////////////////////////////////////////////////////////
// CREAR FUNCION PARA VERIFICAR EL NUMERO DE FACTURA.
///////////////////////////////////////////////////////////////////////////////
function VerificarNumeroFactura(numero_factura){
						accion = "VerificarNumeroFactura";
                        codigo_tipo_factura = $("#lstTipoFactura").val();
						////
						////	CAMBIAR NUMERO DE FACTURAL REAL.
						////
								$.post("includes/cargar_numero_factura_real.php", {codigo_tipo_factura: codigo_tipo_factura},
									function(data) {
										NumeroFacturaReal = data[0].numero_factura_real;
										numero_fin = data[0].numero_fin;
										$("label[for='NumeroFacturaReal']").text(NumeroFacturaReal);
								///
								/// VERIFICAR SI EL NUMERODE FACTURA ES MAYOR AL CREADO.
								///
								/////////// VERIFICAR EN LA TABLA FACTURAS VENTAS.
								$.post("php_libs/soporte/DetalleFacturaTemp.php", {codigo_tipo_factura: codigo_tipo_factura, accion: accion, numero_factura: numero_factura, numero_factura_real: NumeroFacturaReal},
											function(response){														
												if(response.mensaje === "Si Registro"){
													alertify.error("Número de Factura Ya Existe");
													$("#goGuardarDetalleFactura").attr("disabled", "disabled");
													$("#GrupoBuscarProducto").attr("disabled", "disabled");
													$("#goEliminarDetalleFactura").attr("disabled", "disabled");
													$("#BotonBuscarProducto").attr("disabled", "disabled");
													$("#txtNumeroFactura").val(""); $("#txtNumeroFactura").focus();		
												}
												
												 if(response.mensaje === "No Registro"){
													if(parseInt(numero_factura) > parseInt(numero_fin)){
														alertify.error("Número de Factura Ingresado es Mayor al Configurado --> "+numero_fin+" # factura "+numero_factura);
														$("#goGuardarDetalleFactura").attr("disabled", "disabled");
														$("#GrupoBuscarProducto").attr("disabled", "disabled");
														$("#BotonBuscarProducto").attr("disabled", "disabled");
														$("#txtNumeroFactura").val(""); $("#txtNumeroFactura").focus();		
													}else{
														$("#goGuardarDetalleFactura").removeAttr("disabled");
														$("#GrupoBuscarProducto").removeAttr("disabled");
														$("#goEliminarDetalleFactura").removeAttr("disabled");
														$("#BotonBuscarProducto").removeAttr("disabled");
														$("label[for='NumeroFacturaReal']").text(NumeroFacturaReal);
													}
												}
								}, "json");
						}, "json");
}
	}); // fin del change de tipo de factura.
////
//// Verificar la información de la tabla detalle temp factura.
////
	$(document).ready(function()
	{
		// Parametros para el lstmuncipio.
                $("#lstCodigoVendedor").change(function () {
                        $("#lstCodigoVendedor option:selected").each(function () {
							codigo_vendedor=$(this).val();
							codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                            accion = "BuscarVendedor";
						$.post("php_libs/soporte/DetalleFacturaTemp.php", {accion: accion, codigo_vendedor: codigo_vendedor, codigo_tipo_factura: codigo_tipo_factura},
				       function(response){
                                        // Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                alertify.error("El Vendedor Ya Tiene una Factura Iniciada...");

										// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_ventas_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_ventas_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_ventas_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.venta_total_descuento);
                                                $("label[for='Total']").text(response.venta_total);
                                                $("label[for='NumeroProductos']").text(response.numero_linea);
												$("#ControlProductos").val(response.numero_linea);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalVenta").val(response.venta_total);
										
                                        }
                                        
                                         if(response.mensaje === "No Registro"){
                                                $("#goGuardarDetalleFactura").removeAttr("disabled");
                                                $("#goBuscarProducto").removeAttr("disabled");
											// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
											// Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_ventas_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_ventas_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_ventas_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.venta_total_descuento);
                                                $("label[for='Total']").text(response.venta_total);
                                                $("label[for='NumeroProductos']").text(response.numero_linea);
												$("#ControlProductos").val(response.numero_linea);
											// HIDDEN TOTAL VENTA
                                                $("#txtTotalVenta").val(response.venta_total);
										}
			}, "json");			
	    });
	});
	});