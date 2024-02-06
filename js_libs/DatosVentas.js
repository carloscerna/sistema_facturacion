$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// BOToN GUARDAR. GUARDA TODA LA INFORMACIoN
// TABLA FACTURA
// TABLA DETALLE FACTURA
// LIMPIAR TABLA DETALLE FACTURA TEMP
///////////////////////////////////////////////////////////////////////////////	
		$('#formFacturaVentas').validate({
		    submitHandler: function(){
             // Serializar los datos, toma todos los Id del formulario con su respectivo valor.
		        var str = $('#formFacturaVentas').serialize();
            // Valores de del FORMULARIO INFORNACIoN DEL CLIENTE.
                codigo_cliente = $("label[for='lblCodigoClienteEmpresa']").text();
                codigo_departamento = $('#lstDepartamentoFactura').val();
                codigo_municipio = $('#lstMunicipioFactura').val();
                tipo_factura = $('#lstTipoFactura').val();
				numero_factura_real = $("label[for='NumeroFacturaReal']").text();
				numero_factura_entero = $("#txtNumeroFactura").val();
				numero_factura = numero_factura_real + '-' + numero_factura_entero;

                // PROCESO QUE GUARDA LA FACTURA.
		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/DetalleFacturaTemp.php",
		            data:str  + "&numero_factura=" + numero_factura_entero + "&codigo_cliente=" + codigo_cliente + "&numero_factura_real="+ numero_factura_real + "&id=" + Math.random(),
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro") {                                   
										// PROCESO QUE IMPRIME LA FACTURA. CONSUMIDOR FINAL O CREDITO FISCAL.
											 if(tipo_factura == '01'){
												// construir la variable con el url.
												   varenviar = "/sistema_facturacion/php_libs/reportes/factura_consumidor_final.php?numero_factura="+numero_factura;
												// Ejecutar la función
													AbrirVentana(varenviar);
												}
											 if(tipo_factura == '02'){
												// construir la variable con el url.
												   varenviar = "/sistema_facturacion/php_libs/reportes/factura_credito_fiscal.php?numero_factura="+numero_factura;
												// Ejecutar la función
													AbrirVentana(varenviar);
												}
                                    // Limpiar datos
                                    $('#txtNumeroFactura').val("");
                                    // Lst a su estado original.
                                    $('#lstTipoFactura option[value="01"]').prop('selected',true);
                                    $('#lstFormaPago option[value="01"]').prop('selected',true);
									$('#lstDescuentoSVT option[value="01"]').prop('selected',true);
									
                                    //$("#lstLineaFactura").val("15");
                                    // Limpiar Tabla y datos de subtotoal, iva, y total.
                                    $("#listaProductosTemp").empty();
                                        //
											$("span[for='txtNombreClienteEmpresa']").text("Nombre del Cliente");
											$("label[for='lblCodigoClienteEmpresa']").text("Código");
											$("#txtCodigoCliente").val("");
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SubTotal']").text("");
                                                $("label[for='IVA']").text("");
                                                $("label[for='Descuento']").text("");
                                                $("label[for='VentaMenosDescuento']").text("");
                                                $("label[for='Total']").text("");
												$("label[for='NumeroFacturaReal']").text("");
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text("");
                                                $("label[for='SumasVentasGravadas']").text("");
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalVenta").text("");
												$("#txtTotalVentaDescuento").text("");
                                                $("#goGuardarDetalleFactura").attr("disabled", "disabled");
                                                $("#goBuscarProducto").attr("disabled", "disabled");
												$("#GrupoBuscarProducto").attr("disabled", "disabled");
												$("#BotonBuscarProducto").attr("disabled", "disabled");
                                                $("#goEditarClienteEmpresa").attr("disabled", "disabled");
												$("#txtNumeroFactura").attr("disabled", "disabled");
												$("label[for='NumeroProductos']").text("0");
												$("#ControlProductos").val(0);
                                                alertify.success("Registro(s) Guardado(s).");
                                }
                                if (response.mensaje == "No Registro") {
                                    alertify.error("Registro(s) No Guardado(s).");
                                }
								// Regresar al estado normal $accion
								$('#accion_factura').val('GuardarFacturaVentas');
						}
		        });
			}
		});		 

}); // Cierre princial de la función document.
//	ABRE UNA NUEVA PESTAnA PARA PORDER IMPRIMIR LA FACTURA
// CREITO O CONSUMIDOR FINAL.
function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}