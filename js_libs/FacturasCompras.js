// id de user global
var id_ = 0;
var id_buscar_facturas_compras = 0;
var id_detalle_factura_compra = 0;
var accion = 'noAccion';
var accion_buscar_factura_compra = "noAccion";
var numero_factura = "";
var codigo_proveedor = "";
var cliente_empresa = "";
var codigo_tipo_factura = "";

$(document).ready( function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
		$(document).ready(function(){
			listar();
		});		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// INPUT MASK U OTROS.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        					
		$(document).ready( function () {
		// Jquery-mask - entrado de datos.
				$("#txtPrecioCosto").inputmask("decimal",{
					radixPoint:".",
					groupSeparator:",",
					digits:6,
					prefix:"$",
					autoGroup: true
				});
		});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listar = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		var table = $("#listadoCompras").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"order": [[0, 'desc']],
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/FacturasCompras.php",
					data: {"accion_buscar": buscartodos}
				},
				"deferRender": true,
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    /* Append the grade to the default row class name */
                    if ( aData[5] == "01" )
                    {
                        $('td:eq(7)', nRow).html( 'Pagada' );
                        $('td:eq(7)', nRow).addClass('pagada');
                    }
                    if ( aData[5] == "02" )
                    {
                        $('td:eq(7)', nRow).html( 'Pendiente' );
                        $('td:eq(7)', nRow).addClass('pendiente');
                    }
                   /* cambiar de color a la palabra de la columna */
                    if ( aData[3] == "03" )	// camibar color a las NOTAS DE CREDITO
                    {
                        $('td:eq(3)', nRow).addClass('ccf');
                    }
                },
				"columns":[
					{"data":"id_compras"},
					{"data":"fecha"},
					{"data":"numero_factura"},
					{"data":"c_tipo_f"},
					{"data":"codigo_proveedor"},
					{"data":"nombre_completo"},
					{"data":"total_compra"},
                    {"data":"estado_factura"},
					{
						data: null,
						defaultContent: '<a href="#" class="editar btn btn-info" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="fa fa-edit"></span>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="remove btn btn-warning" data-toggle="modal" data-target="#VentanaEliminar" data-toggle="tooltip" data-placement="right" title="Anular"> <span class="fa fa-trash"></span></a>',
						orderable: false
					},	                                                                                                                                                
					{
                        data: null,
						defaultContent: '<a href="#" class="imprimir btn btn-secondary" data-toggle="modal" data-target="#VentanaImprimir" data-toggle="tooltip" data-placement="right" title="Imprimir"> <span class="fa fa-print"></span></a>',
						orderable: false
					},
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIÓN DEL IDIOMA AL ESPAÑOL.
///////////////////////////////////////////////////////////////////////////////	
var idioma_espanol = {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			    "sFirst":    "Primero",
			    "sLast":     "Último",
			    "sNext":     "Siguiente",
			    "sPrevious": "Anterior"
			},
			"oAria": {
			    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		 };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCompras').on( 'click', 'a.remove', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
            numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_proveedor =$(this).parents('tr').find('td').eq(4).html();
			proveedor =$(this).parents('tr').find('td').eq(5).html();
			// Acción a Ejecutar
			accion = "EliminarRegistro";
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEliminar').modal("show");
				$("span[for='NumeroFactura']").text(numero_factura);
				$("span[for='CodigoProveedor']").text(codigo_proveedor);
				$("span[for='Proveedor']").text(proveedor);
});
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonEliminarRegistro").on('click', function(){
	// proceso para eliminar el registro cargar variables públicas.
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasCompras.php",
		            data:"accion="+ accion  + "&codigo_proveedor=" + codigo_proveedor  + "&id_=" + id_ + "&numero_factura=" + numero_factura + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                alertify.success("Registro(s) Eliminado(s).");
								listar();
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.log("Registro(s) No Eliminado(s).");
                           }
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
	// Cerrar el Formulario Modal y reinicar variables.
	accion = ""; numero_factura = ""; codigo_proveedor = ""; cliente_empresa = "";
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCompras').on( 'click', 'a.editar', function () {
			id_buscar_facturas_compras = $(this).parents('tr').find('td').eq(0).html();
            numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_proveedor =$(this).parents('tr').find('td').eq(4).html();
			// Acción a Ejecutar
			accion_buscar_factura_compra = "VerFacturaCompra";	// variable global
				
				$.post("php_libs/soporte/FacturasCompras.php", {accion: accion_buscar_factura_compra, numero_factura: numero_factura, codigo_proveedor: codigo_proveedor},
				       function(response){
						    // Cargar valores a los objetos
							$("label[for='lblTotalCompra']").text(response.total_compra);
							$("label[for='lblCodigoProveedor']").text(response.codigo_proveedor);
							$("label[for='lblNumeroFactura']").text(response.numero_factura);
							$("label[for='lblCodigoTipoFactura']").text(response.codigo_tipo_factura);
							$("span[for='txtNombreProveedor']").text(response.nombre_proveedor);
							$("#txtFechaCompra").val(response.fecha);
							// variables publicas relacionas con los datos de la factura que afectara al detalle de la factura.
							codigo_tipo_factura = response.codigo_tipo_factura;
                            $("#listaEditarCompra").empty();
                            $('#listaEditarCompra').append(response.contenido);
                                alertify.success("Registro(s) listo para Editar.");
				}, "json");
					// Cerrar el Formulario Modal y reinicar variables.
					accion_buscar_factura_compra = ""; 
					// Abrimos el Formulario Modal y Rellenar For.
					$('#VentanaEditarCompra').modal("show");	
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCompras').on( 'click', 'a.imprimir', function () {
	id_ =$(this).parents('tr').find('td').eq(0).html();
    numero_factura =$(this).parents('tr').find('td').eq(2).html();
	codigo_tipo_factura =$(this).parents('tr').find('td').eq(3).html();
	codigo_proveedor =$(this).parents('tr').find('td').eq(4).html();
    // Si el valor es 01 PARA CARGAR LA FACTURA CONSUMIDOR FINAL.
    // construir la variable con el url.
        varenviar = "/sistema_facturacion/php_libs/reportes/factura_compras_informe.php?numero_factura="+numero_factura+"&codigo_proveedor="+codigo_proveedor;
        // Ejecutar la función
        AbrirVentana(varenviar);
});
///////////////////////////////////////////////////
// funcionalidad del botón que cierra la ventana detalle de compras
///////////////////////////////////////////////////
	    $("#VentanaEditarCompra").on('hidden.bs.modal', function () {
			//
			// GENERAR O NO GENERAR CODIGO NUEVO PARA EL PRODUCTO.
			//
				listar();
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaEditarCodigoProveedor').on('shown.bs.modal', function() {
			  $(this).find('[autofocus]').focus();
			});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
 ///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaEditarCompra a',function (e){
                e.preventDefault();
				// Id Tempy y Acción.
				id_detalle_factura_compra = $(this).attr('href');
				accion_buscar_factura_compra = $(this).attr('data-accion');
				fecha = $(this).parents('tr').find('td').eq(1).html();
				// Rturina per editar el registro.
				if(accion_buscar_factura_compra == 'ActualizarCodigoProveedor'){
					// OCULTAR VENTANA MODAL.
					$('#VentanaEditarCodigoProveedor').modal("show");	
				}else if(accion_buscar_factura_compra == 'EliminarProducto'){
						accion_buscar_factura_compra = 'VerProductoFactura';
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/FacturasCompras.php",  {accion: accion_buscar_factura_compra, id_: id_detalle_factura_compra},
                                function(data) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
									$("span[for='IdProducto']").text(data[0].id_detalle);
									$("span[for='CodigoProducto']").text(data[0].codigo_producto);
									$("span[for='DescripcionProducto']").text(data[0].descripcion_producto);
									$("span[for='CantidadProducto']").text(data[0].cantidad);
                                    
									$('#VentanaEliminarProducto').modal("show");	
                               }, "json");
				}else if(accion_buscar_factura_compra == 'EditarProducto'){
						accion_buscar_factura_compra = 'VerProductoFactura';
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/FacturasCompras.php",  {accion: accion_buscar_factura_compra, id_: id_detalle_factura_compra},
                                function(data) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
									$("span[for='IdProducto']").text(data[0].id_detalle);
									$("span[for='CodigoProductoA']").text(data[0].codigo_producto);
									$("span[for='DescripcionProducto']").text(data[0].descripcion_producto);
									$("#txtCantidad").val(data[0].cantidad);
									$("#txtCantidadActual").val(data[0].cantidad);
									$("#txtPrecioCosto").val(data[0].precio_compra);
                                    
									$('#VentanaEditarProducto').modal("show");	
                               }, "json");
				}
		});
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ACTUALIZAR CODIGO PROVEEDOR
///////////////////////////////////////////////////////////////////////////////	  
$("#goActualizarFecha").on('click', function(){
	// Actuliar la nueva fecha.
		accion_buscar_factura_compra = "ActualizarFecha";
		fecha = $("#txtFechaCompra").val();
		
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasCompras.php",
		            data: "accion="+ accion_buscar_factura_compra + "&id_=" + id_buscar_facturas_compras + "&fecha=" + fecha +"&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                            	// Cargar valores a los objetos

									alertify.success("Fecha Actualizada");
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.error("Registro(s) No Actualizado(s).");
                           }
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
});	
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ACTUALIZAR CODIGO PROVEEDOR
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonActualizarCodigoProveedor").on('click', function(){
	// Actuliar la nueva fecha.
	nuevo_codigo_proveedor = $("#txtCodigoProveedor").val();
	codigo_proveedor = $("label[for='lblCodigoProveedor']").text();
	numero_factura = $("label[for='lblNumeroFactura']").text();
							
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasCompras.php",
		            data: "accion="+ accion_buscar_factura_compra  + "&id_detalle_factura_compra=" + id_detalle_factura_compra + "&nuevo_codigo_proveedor="+ nuevo_codigo_proveedor + "&codigo_proveedor="+ codigo_proveedor + "&numero_factura=" + numero_factura + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                            	// Cargar valores a los objetos
                                $("#listaEditarCompra").empty();
                                $('#listaEditarCompra').append(response.contenido);
								$("label[for='lblTotalCompra']").text(response.total_compra);
									alertify.success("Registro(s) Actualizado(s).");
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.error("Registro(s) No Actualizado(s).");
                           }
						$('#VentanaEditarCodigoProveedor').modal("hide");
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
});	
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ELIMINAR PRODUCTO
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonEliminarProducto").on('click', function(){
	// Actuliar la nueva fecha.
		accion_buscar_factura_compra = 'EliminarProducto';
		codigo_proveedor = $("label[for='lblCodigoProveedor']").text();
		numero_factura = $("label[for='lblNumeroFactura']").text();
		codigo_producto = $("span[for='CodigoProducto']").text();
		cantidad = $("span[for='CantidadProducto']").text();
	
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasCompras.php",
		            data: "accion="+ accion_buscar_factura_compra  + "&id_detalle_factura_compra=" + id_detalle_factura_compra + "&codigo_proveedor="+ codigo_proveedor + "&numero_factura=" + numero_factura + "&codigo_producto=" + codigo_producto + "&cantidad_producto=" + cantidad + "&codigo_tipo_factura=" + codigo_tipo_factura + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                            	// Cargar valores a los objetos
                                $("#listaEditarCompra").empty();
                                $('#listaEditarCompra').append(response.contenido);
								$("label[for='lblTotalCompra']").text(response.total_compra);
									alertify.success("Registro(s) Actualizado(s).");
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.error("Registro(s) No Actualizado(s).");
                           }
						$('#VentanaEliminarProducto').modal("hide");
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
});
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ELIMINAR PRODUCTO
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonActualizarProducto").on('click', function(){
	// Actuliar la nueva fecha.
		accion_buscar_factura_compra = 'ActualizarProducto';
		codigo_proveedor = $("label[for='lblCodigoProveedor']").text();
		numero_factura = $("label[for='lblNumeroFactura']").text();
		codigo_producto = $("span[for='CodigoProductoA']").text();
		cantidad = $("#txtCantidad").val();
		cantidad_actual = $("#txtCantidadActual").val();
		precio_compra = $("#txtPrecioCosto").val();
	
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasCompras.php",
		            data: "accion="+ accion_buscar_factura_compra  + "&id_factura_compra=" + id_buscar_facturas_compras + "&cantidad_actual=" + cantidad_actual + "&precio_compra=" + precio_compra + "&id_detalle_factura_compra=" + id_detalle_factura_compra + "&codigo_proveedor="+ codigo_proveedor + "&numero_factura=" + numero_factura + "&codigo_producto=" + codigo_producto + "&cantidad=" + cantidad + "&codigo_tipo_factura=" + codigo_tipo_factura + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                            	// Cargar valores a los objetos
                                $("#listaEditarCompra").empty();
                                $('#listaEditarCompra').append(response.contenido);
								$("label[for='lblTotalCompra']").text(response.total_compra);
									alertify.success("Registro(s) Actualizado(s).");
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.error("Registro(s) No Actualizado(s).");
                           }
						$('#VentanaEditarProducto').modal("hide");
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
});
}); // Cierre princial de la función document.
//	ABRE UNA NUEVA PESTAnA PARA PORDER IMPRIMIR LA FACTURA
// CREITO O CONSUMIDOR FINAL.
function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}