// id de user global
var accion = 'noAccion';
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#goBuscarProducto').on('click',function(){
				$('#VentanaBuscarProducto').modal("show");	
                listarProductos();
        });
        $('#BotonBuscarProducto').on('click',function(){
				$('#VentanaBuscarProducto').modal("show");	
                listarProductos();
        });
///////////////////////////////////////////////////////////////////////////////
// FUNCION ELIMINA LOS REGISTROS DE LA TABLA TEMP DETALLE FACTURA
///////////////////////////////////////////////////////////////////////////////
        $('#goEliminarDetalleFactura').on('click',function(){
                codigo_usuario = $("#lstCodigoVendedor").val(); // Código del vendedor se almacena para controla el detalle de la factura.
                accion = "EliminarDetalleFacturaTempTodo";	// variable global
                
                                $.post("php_libs/soporte/DetalleFacturaTempCompras.php",  {accion: accion, codigo_usuario: codigo_usuario},
                                function(response) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SubTotal']").text("");
                                                $("label[for='IVA']").text("");
                                                $("label[for='Descuento']").text("");
                                                $("label[for='VentaMenosDescuento']").text("");
                                                $("label[for='Total']").text("");
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text("");
                                                $("label[for='SumasVentasGravadas']").text("");
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalCompra").text("");
                                                alertify.success("Registro(s) eliminado.");
                               }, "json");
        });	
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listarProductos = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		// Tabla que contrendrá los registros.
			var table = $("#listadoProductos").dataTable({
				"lengthMenu": [[3, 5, 10, 25, 50, -1], [3, 5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProductos.php",
					data: {"accion_productos_buscar": buscartodos}
				},
				"deferRender": true,
				                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    /* cambiar de color a la palabra de la columna */
                    if ( aData[7] == "01" )
                    {
                        $('td:eq(6)', nRow).html( 'Si' );
                        $('td:eq(6)', nRow).addClass('exento_si');
                    }
                    if ( aData[7] == "02" )
                    {
                        $('td:eq(6)', nRow).html( 'No' );
                        $('td:eq(6)', nRow).addClass('exento_no');
                    }
                    /* cambiar de color a la palabra de la columna */
                    if ( aData[8] < 0 )
                    {
                        $('td:eq(7)', nRow).addClass('existencia');
                    }
                },
				"columns":[
					{"data":"id_productos"},
					{"data":"codigo_producto"},
					{"data":"codigo_barra"},
					{"data":"descripcion"},
                                        
					{
						data: null,
						defaultContent: '<input type=number min=1 max=999 name=cantidad class="form-control form-control-sm" size=5 maxlength=3 value=1>',
					},

                    {"data": 'precio_costo',
						render: function ( data, type, row ) {
						return '<input type=number name=precio size=5 class="form-control form-control-sm" value='+ data+' onkeypress="return NumCheck(event, this)">';
						},
                    },
                    {"data":"producto_exento"},
                    {"data":"existencia"},
					{
						data: null,
						defaultContent: '<a href="#" class="seleccionar btn btn-info btn-sm"><span style="color: white;" class="fa fa-check" title="Seleccionar..."></span>',
						orderable: false
					},
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };

///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// comprana modal. CARGA LOS DATOS EN LA FACTURAS DETALLES QUE ES TEMPORAL.
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoProductos').on( 'click', 'a.seleccionar', function () {
				codigo_producto =$(this).parents('tr').find('td').eq(1).html();
                cantidad = $(this).parents('tr').find('td').eq(4).find("input[name='cantidad']").val();
                precio = $(this).parents('tr').find('td').eq(5).find("input[name='precio']").val();
                codigo_usuario = $("#lstCodigoVendedor").val();
                codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                numero_linea = $("#lstLineaFactura").val();     // El valor que continue el numero de lineas a imprimir en la factura para permitir el ingreso de productos.
                producto_exento =$(this).parents('tr').find('td').eq(6).html();
				if(producto_exento == "No"){producto_exento = "02";}else{producto_exento = "01";}

				accion = "GuardarDetalleFacturaTemp";	// variable global
				$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/DetalleFacturaTempCompras.php", {accion: accion, codigo_producto: codigo_producto, cantidad: cantidad, precio: precio, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura, numero_linea: numero_linea, producto_exento: producto_exento},
				       function(response){
                                        if(response.respuesta === false){
                                                alertify.notify("Limite de lineas para Imprimir en la Factura");
                                        }
                                        
                                        if(response.respuesta === true){
					// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_compras_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_compras_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_compras_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.compra_total_descuento);
                                                $("label[for='Total']").text(response.compra_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalCompra").val(response.compra_total);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) agregado.");
                                        }
				}, "json");			
});
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
 ///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaProductosTemp a',function (e){
                e.preventDefault();
				// Id Tempy y Acción.
                codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                codigo_usuario = $("#lstCodigoVendedor").val();
				idUser_ok = $(this).attr('href');
				accion_ok = $(this).attr('data-accion');
				// Rturina per editar el registro.
				if( accion_ok == 'editarDetalleFacturaTemp'){
                                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                                $.post("php_libs/soporte/DetalleFacturaTempCompras.php",  { id_: idUser_ok, accion: accion_ok},
                                                function(data) {
                                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                                        $('#txtCantidadCompraAjusteModificar').val(data[0].cantidad);
                                                        $('#txtPrecioCompraAjusteModificar').val(data[0].precio_compra);
                                                 }, "json");
												// OCULTAR VENTANA MODAL.
												$('#VentanaModificarAjusteCompra').modal('show');
				}else if($(this).attr('data-accion') == 'eliminarDetalleFacturaTemp'){
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/DetalleFacturaTempCompras.php",  { id_temp: idUser_ok, accion: accion_ok, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura},
                                function(response) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_compras_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_compras_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_compras_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.compra_total_descuento);
                                                $("label[for='Total']").text(response.compra_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalCompra").val(response.compra_total);
                               }, "json");
				}
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE FACTURA
		///////////////////////////////////////////////////
		$('#goActualizarAjusteCompra').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
                        codigo_usuario = $("#lstCodigoVendedor").val();
                        cantidad = $("#txtCantidadCompraAjusteModificar").val();
                        precio_compra = $("#txtPrecioCompraAjusteModificar").val();
						accion = "ActualizarTempDetalleFactura";
                        codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                        id_ = idUser_ok;
			// Generar el Código Nuevo.
				$.post("php_libs/soporte/DetalleFacturaTempCompras.php", {id_: idUser_ok, accion: accion, codigo_usuario: codigo_usuario, cantidad: cantidad, codigo_tipo_factura: codigo_tipo_factura, precio_compra: precio_compra},
				       function(response){
                                        if(response.respuesta === true){
                                        // Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
                                                $("label[for='SumasVentasExentas']").text(response.sumas_compras_exentas);
                                                $("label[for='SumasVentasGravadas']").text(response.sumas_compras_gravadas);
                                                $("label[for='SubTotal']").text(response.sumas_compras_gravadas);
                                                $("label[for='IVA']").text(response.iva);
                                                $("label[for='Descuento']").text(response.descuento);
                                                $("label[for='VentaMenosDescuento']").text(response.compra_total_descuento);
                                                $("label[for='Total']").text(response.compra_total);
                                        // HIDDEN TOTAL VENTA
                                                $("#txtTotalCompra").val(response.compra_total);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) Actualizado.");
										// OCULTAR VENTANA MODAL.
												$('#VentanaModificarAjusteCompra').modal('hide');
                                        }                                                
				}, "json");
		});
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACION DEL IDIOMA AL ESPAnOL.
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
}); // Cierre princial de la función document.