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
				$("#txtFechaCompra").val(today);                       
});
	
	$(document).ready(function()
	{
			var miselect=$("#lstCodigoVendedor");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_vendedor.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");                   
});
        
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
        
	$(document).ready(function()
	{
			var miselect=$("#lstTipoFactura");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_tipo_factura.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");

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
                                var accion = "VerificarNumeroFactura";
                                numero_factura=$(this).val();
                                codigo_tipo_factura = $("#lstTipoFactura").val();
								codigo_proveedor = $("#txtCodigoProveedorCompras").val();

                                $.post("php_libs/soporte/DetalleFacturaTempCompras.php", {codigo_tipo_factura: codigo_tipo_factura, accion: accion, numero_factura: numero_factura, codigo_proveedor: codigo_proveedor},
                                               function(response){
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                alertify.error("Número de Factura Ya Existe");
                                                $("#goGuardarDetalleFactura").attr("disabled", "disabled");
                                                $("#GrupoBuscarProducto").attr("disabled", "disabled");
												$("#BotonBuscarProducto").attr("disabled", "disabled");
												$("#goEliminarDetalleFactura").attr("disabled", "disabled");
                                                $(this).val("");
                                        }
                                        
                                         if(response.mensaje === "No Registro"){
                                                $("#goGuardarDetalleFactura").removeAttr("disabled");
                                                $("#GrupoBuscarProducto").removeAttr("disabled");
												$("#BotonBuscarProducto").removeAttr("disabled");
												$("#goEliminarDetalleFactura").removeAttr("disabled");
                                        }
                                }, "json");
                                

                });                     
    // Caundo cambie el valor de tipo factura.
                $("#lstTipoFactura").change(function () {
					            var accion = "VerificarNumeroFactura";
                                numero_factura=$("#txtNumeroFactura").val();
                                codigo_tipo_factura = $("#lstTipoFactura").val();
								codigo_proveedor = $("#txtCodigoProveedorCompras").val();

                                $.post("php_libs/soporte/DetalleFacturaTempCompras.php", {codigo_tipo_factura: codigo_tipo_factura, accion: accion, numero_factura: numero_factura, codigo_proveedor: codigo_proveedor},
                                               function(response){
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                alertify.error("Número de Factura Ya Existe");
                                                $("#goGuardarDetalleFactura").attr("disabled", "disabled");
                                                $("#GrupoBuscarProducto").attr("disabled", "disabled");
												$("#BotonBuscarProducto").attr("disabled", "disabled");
                                                $("#goEliminarDetalleFactura").attr("disabled", "disabled");
												$(this).val("");
                                        }
                                        
                                         if(response.mensaje === "No Registro"){
                                                $("#goGuardarDetalleFactura").removeAttr("disabled");
                                                $("#GrupoBuscarProducto").removeAttr("disabled");
												$("#BotonBuscarProducto").removeAttr("disabled");
												$("#goEliminarDetalleFactura").removeAttr("disabled");
                                        }
                                }, "json");
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            accion = "VerDetalleFacturaTemp";
                            codigo_usuario = $("#lstCodigoVendedor").val(); // Código del vendedor se almacena para controla el detalle de la factura.
                                
                        $("#lstTipoFactura option:selected").each(function () {
                                        codigo_tipo_factura=$(this).val();
                                        // Cambiar el numero de lineas a imprimir en la factura
                                        if(codigo_tipo_factura === "01"){$("#lstLineaFactura").val("50");}
                                        if(codigo_tipo_factura === "02"){$("#lstLineaFactura").val("50");}
                                        
                                        // REfisar si existe una factur a
                                        $.post("php_libs/soporte/DetalleFacturaTempCompras.php", {codigo_tipo_factura: codigo_tipo_factura, accion: accion, codigo_usuario: codigo_usuario},
                                               function(response){
										 // Llenar el formulario con los datos del registro seleccionado tabs-1
									 	// Cargar valores a los objetos
                                        if(response.mensaje === "Si Registro"){
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
										 // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasComprasExentas']").text(response.sumas_compras_exentas);
                                                $("label[for='SumasComprasGravadas']").text(response.sumas_compras_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_compras_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Total']").text(response.compra_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalCompra").val(response.compra_total);
                                                alertify.success("Registro(s) Actualizados.");
                                        }
                                }, "json");			
                    });
                });                       
        });       
	// Carga la INformación de Tabla Departamento
	$(document).ready(function()
	{
	    // REllenar el select Departamento.
		var miselect=$("#lstDepartamentoFactura");
	    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
		$.post("includes/cargar_departamento.php",
		    function(data) {
			miselect.empty();
			    for (var i=0; i<data.length; i++) {
				miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
				}
			}, "json");
	    // REllenar el select Municipio con un Codigo especIfico 02 - Santa Ana.
		var miselectM=$("#lstMunicipioFactura");
	    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		miselectM.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
  		    departamento="02";
			$.post("includes/cargar_municipio.php", { departamento: departamento },
			    function(data){
			    miselectM.empty();
				for (var i=0; i<data.length; i++) {
				    miselectM.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
				}
			}, "json");			
	});
	
	// Carga la INformación de Tabla Departamento
	$(document).ready(function()
	{
		// Parametros para el lstmuncipio.
	$("#lstDepartamentoFactura").change(function () {
	    	    var miselect=$("#lstMunicipioFactura");
		    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
   		$("#lstDepartamentoFactura option:selected").each(function () {
				elegido=$(this).val();
				departamento=$("#lstDepartamentoFactura").val();
				$.post("includes/cargar_municipio.php", { departamento: departamento },
				       function(data){
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");			
	    });
	});
	});