$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// BOToN GUARDAR. GUARDA TODA LA INFORMACIoN
// TABLA FACTURA COMPRAS
// TABLA DETALLE FACTURA COMPRAS
// LIMPIAR TABLA DETALLE FACTURA TEMP COMPRA
///////////////////////////////////////////////////////////////////////////////	
		$('#formFacturaCompras').validate({
		    submitHandler: function(){
			// Serializar los datos, toma todos los Id del formulario con su respectivo valor.
			        var str = $('#formFacturaCompras').serialize();
			// alert(str);
			// PROCESO QUE GUARDA LA FACTURA.
		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/DetalleFacturaTempCompras.php",
		            data: str +"&id=" + Math.random(),
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro") {                                   
                                    // Limpiar datos
                                    $('#txtCodigoProveedorCompras').val("");
                                    $('#txtNumeroFactura').val("");
                                    // Lst a su estado original.
                                    $('#lstTipoFactura option[value="01"]').attr('selected',true);
                                    $('#lstFormaPago option[value="01"]').attr('selected',true);
                                    $("#lstLineaFactura").val("50");
                                    // Limpiar Tabla y datos de subtotoal, iva, y total.
                                    $("#listaProductosTemp").empty();
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SubTotal']").text("");
                                                $("label[for='IVA']").text("");
                                                $("label[for='Total']").text("");
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text("");
                                                $("label[for='SumasVentasGravadas']").text("");
						$("span[for='txtNombreProveedor']").text("Nombre Proveedor");
						$("label[for='lblCodigoProveedor']").text("Código");
                                        // HIDDEN TOTAL Compra
                                                $("#txtTotalCompra").text("");
                                                $("#goGuardarDetalleFactura").attr("disabled", "disabled");
                                                $("#GrupoBuscarProducto").attr("disabled", "disabled");
						$("#BotonBuscarProducto").attr("disabled", "disabled");
                                                $("#goInformacionCliente").attr("disabled", "disabled");
						$("#goEliminarDetalleFactura").attr("disabled", "disabled");
                                                alertify.success("Registro(s) Guardado(s).");
                                }
					if (response.mensaje == "No Registro") {
					    alertify.success("Registro(s) No Guardado(s).");
					}
					// Regresar al estado normal $accion
					$('#accion_factura').val('GuardarFacturaCompras');
				}
		        });
			}
		});		 
}); // Cierre princial de la función document.}