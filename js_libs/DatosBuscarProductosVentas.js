// variables globales
var accion_temp_detalle_factura = 'noAccion';
var id_temp_detalle_factura = 0;
var cantidad = 0;
var precio_venta = 0;
var producto_exento = "";
var codigo_producto ="";
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
                accion_temp_detalle_factura = "EliminarDetalleFacturaTempTodo";	// variable global
                
                                $.post("php_libs/soporte/DetalleFacturaTemp.php",  {accion: accion_temp_detalle_factura, codigo_usuario: codigo_usuario},
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
                                                $("#txtTotalVenta").text("");
												$("#txtTotalVentaDescuento").val("");
												$("#ControlProductos").val("0");
												$("label[for='NumeroProductos']").text(response.numero_linea);
                                                alertify.error("Registro(s) eliminado.");
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
				"lengthMenu": [[5, 10, 25, 50, -1], [3, 5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProductos.php",
					data: {"accion_productos_buscar": buscartodos}
				},
				"deferRender": true,
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
                    {"data": 'precio',
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
					{
						data: null,
						defaultContent: '<a href="#" class="seleccionar-precio btn btn-info btn-sm"><span style="color: white;" class="fa fa-shopping-bag" title="Lista de Precios"></span>',
						orderable: false
					},
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. CARGA LOS DATOS EN LA FACTURAS DETALLES QUE ES TEMPORAL.
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoProductos').on( 'click', 'a.seleccionar', function () {
			// Vañpres de la dataTables
				codigo_producto =$(this).parents('tr').find('td').eq(1).html();
                cantidad = $(this).parents('tr').find('td').eq(4).find("input[name='cantidad']").val();
                precio = $(this).parents('tr').find('td').eq(5).find("input[name='precio']").val();
                producto_exento =$(this).parents('tr').find('td').eq(6).html();
				if(producto_exento == "No"){producto_exento = "02";}else{producto_exento = "01";}
			// Valores de los INPUT's
				codigo_usuario = $("#lstCodigoVendedor").val();
                codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                numero_linea = $("#lstLineaFactura").val();     // El valor que continue el numero de lineas a imprimir en la factura para permitir el ingreso de productos.
                descuento = $('#lstDescuentoSVT option:selected').text();        // Para Calbular el Porcentaje a Descontar de la Factura de Venta Total.
				accion_temp_detalle_factura = "GuardarDetalleFacturaTemp";	// variable global
				numero_factura = $("#txtNumeroFactura").val();
				fecha = $("#txtFechaVenta").val();
			// EJECUTAR EL POXT POR MEDIOD DE AJAX
				$.post("php_libs/soporte/DetalleFacturaTemp.php", {accion: accion_temp_detalle_factura, codigo_producto: codigo_producto, cantidad: cantidad, precio: precio, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura, numero_linea: numero_linea, producto_exento: producto_exento, descuento: descuento},
				       function(response){
                                        if(response.respuesta === false){
                                                alertify.error("Límite de líneas para Imprimir en la Factura");
                                        }
                                        
                                        if(response.respuesta === true){
												ActualizarEtiquetas(response);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) agregado.");
                                        }
				}, "json");
				//	
				// AGREGAR RUTINA PARA AGREGAR LINEAS DE CADA ITEM DE PRODUCTOS EN LA HOJA DE CALCULO.
				//
				/*$.post("php_libs/soporte/DetalleFacturaHojaDeCalculo.php", {fecha: fecha, numero_factura: numero_factura, codigo_producto: codigo_producto, cantidad: cantidad, precio: precio, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura, numero_linea: numero_linea, producto_exento: producto_exento, descuento: descuento},
				       function(response){                                        
                                        if(response.respuesta === true){
                                        // Mensaje del programa
                                                alertify.success("Registro(s) agregado Hoja de Cálculo.");
                                        }
				}, "json");*/
});
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para SELECCIONAR EL PORCENTAJE DEL PRODUCTO (LISTA DE PORCENTAJE)
// para luego insertarlo EN TEMP DETALLE FACTURA.
 ///////////////////////////////////////////////////////////////////////////////////
$('#listadoProductos').on( 'click', 'a.seleccionar-precio', function () {
			// Vañpres de la dataTables
				codigo_producto =$(this).parents('tr').find('td').eq(1).html();
				producto_exento =$(this).parents('tr').find('td').eq(6).html();
				cantidad = $(this).parents('tr').find('td').eq(4).find("input[name='cantidad']").val();
				if(producto_exento == "No"){producto_exento = "02";}else{producto_exento = "01";}
				
				accion = "BuscarPorcentajeProducto";
            // Llamar al archivo php para hacer la consulta y presentar los datos.
                $.post("php_libs/soporte/DetalleFacturaTemp.php",  { codigo_producto: codigo_producto, accion: accion},
                        function(data) {
								// valores a campos input o select
									$('#txtCantidadVentaAjusteModificar').val(cantidad);	// extraida del detalle de la factura.
									$('#txtPrecioVentaAjusteModificar').val(data[0].precio_venta);	// extraido del detalle de la factura.
                             // Rellenar el Tipo de Porcentaje
                                var miselect=$("#lstTipoPrecio");
                                        miselect.empty();
                                            for (var i=0; i<data.length; i++) {
                                                miselect.append('<option value="' + data[i].precio_venta + '">' + data[i].descripcion + '</option>');
                                            }
                                }, "json");
							// Abrimos Ventana Editar
								$('#VentanaModificarAjusteVenta').modal("show");
							// cambiar accion para guardar en temp detalle factura	
								accion_temp_detalle_factura = "GuardarDetalleFacturaTemp";
});
///////////////////////////////////////////////////////////////////////////////
// PROCESO DENTRO DE LA TABLA TEMP DETALLE FACTURA
///////////////////////////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////////////////////////////
// ACTUALIZA UNIDAD DE MEDIDA DEL PRODUCTO.
///////////////////////////////////////////////////////////////////////////////
$('body').on('change','#listaProductosTemp select',function (){
		var cantidad_por = 0;
		valor = $(this).val();
		id_temp_detalle_factura = $(this).attr('name');
		accion_temp_detalle_factura = $(this).attr('data-accion-um');
		//alert(idUser_ok + ' ' + accion_ok + ' ' + name);
		if(valor != '01'){
			cantidad_por = 1;
		}
		
		 if($(this).attr('data-accion-um') == 'ActualizarUnidadMedida'){
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/DetalleFacturaTemp.php",  { id_: id_temp_detalle_factura, accion: accion_temp_detalle_factura, valor: valor, cantidad_por: cantidad_por},
                                function(response) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                        if(response.respuesta === true){
                                        }
                               }, "json");
		 }
	});
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaProductosTemp a',function (e){
                e.preventDefault();
		// Id Tempy y Acción.
				codigo_producto =$(this).parents('tr').find('td').eq(2).html();
				cantidad = parseInt($(this).parents('tr').find('td').eq(4).html());
				precio = ($(this).parents('tr').find('td').eq(6).html());
				precio_string = precio.replace("$","");
				precio = parseFloat(precio_string);
				
                codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
                codigo_usuario = $("#lstCodigoVendedor").val();
				id_temp_detalle_factura = $(this).attr('href');
				accion_temp_detalle_factura = $(this).attr('data-accion');
                                // Rturina per editar el registro.
				if( accion_temp_detalle_factura == 'editarDetalleFacturaTemp'){
                                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                                $.post("php_libs/soporte/DetalleFacturaTemp.php",  { id_: id_temp_detalle_factura, accion: accion_temp_detalle_factura, codigo_producto: codigo_producto},
                                                function(data) {
                                                 // Rellenar el Tipo de Porcentaje
                                                        var miselect=$("#lstTipoPrecio");
                                                        miselect.empty();
                                                        for (var i=0; i<data.length; i++) {
                                                            miselect.append('<option value="' + data[i].precio_venta + '">' + data[i].descripcion + '</option>');
                                                        }
                                                }, "json");
												// valores a campos input o select
													$('#txtCantidadVentaAjusteModificar').val(cantidad);	// extraida del detalle de la factura.
													$('#txtPrecioVentaAjusteModificar').val(precio);	// extraido del detalle de la factura.
                                                // Abrimos Ventana Editar
													$('#VentanaModificarAjusteVenta').modal("show");
												// CAMBIAR ACCION para el boton actualizar dentro de temp detalle factura.
													accion_temp_detalle_factura = "ActualizarTempDetalleFactura";

			}else if($(this).attr('data-accion') == 'eliminarDetalleFacturaTemp'){
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                descuento = $('#lstDescuentoSVT option:selected').text();        // Para Calbular el Porcentaje a Descontar de la Factura de Venta Total.
                                $.post("php_libs/soporte/DetalleFacturaTemp.php",  { id_temp: id_temp_detalle_factura, accion: accion_temp_detalle_factura, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura, descuento: descuento},
                                function(response) {
										// Enviar a la funcion correspondiente
												ActualizarEtiquetas(response);
                               }, "json");
		}

		});
///////////////////////////////////////////////////
// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE FACTURA
///////////////////////////////////////////////////
		$('#goActualizarAjusteVenta').on('click',function(){
					// VARIABLES PARA AMBAS ACCIONES ACTUALIZAR PRECIO Y GUARDAR DESDE EL LISTADO DE SELECCION DE PRODUCTOS.
						cantidad = $("#txtCantidadVentaAjusteModificar").val();
						precio_venta = $("#txtPrecioVentaAjusteModificar").val();
						codigo_tipo_factura = $('#lstTipoFactura').val();        // Para Calcular el 13%
						codigo_usuario = $("#lstCodigoVendedor").val();
						
					    numero_linea = $("#lstLineaFactura").val();     // El valor que continue el numero de lineas a imprimir en la factura para permitir el ingreso de productos.
					    descuento = $('#lstDescuentoSVT option:selected').text();        // Para Calbular el Porcentaje a Descontar de la Factura de Venta Total.
						
				if(accion_temp_detalle_factura == "ActualizarTempDetalleFactura"){
					$.post("php_libs/soporte/DetalleFacturaTemp.php", {id_: id_temp_detalle_factura, accion: accion_temp_detalle_factura, codigo_usuario: codigo_usuario, cantidad: cantidad, codigo_tipo_factura: codigo_tipo_factura, precio_venta: precio_venta, descuento: descuento},
				       function(response){
                                        if(response.respuesta === true){
										// Enviar a la funcion correspondiente
												ActualizarEtiquetas(response);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) Actualizado.");
                                                $('#VentanaModificarAjusteVenta').modal("hide");	
                                        }                                                
						}, "json");
				}
				
				if(accion_temp_detalle_factura == "GuardarDetalleFacturaTemp"){
						$.post("php_libs/soporte/DetalleFacturaTemp.php", {accion: accion_temp_detalle_factura, codigo_producto: codigo_producto, cantidad: cantidad, precio: precio_venta, codigo_usuario: codigo_usuario, codigo_tipo_factura: codigo_tipo_factura, numero_linea: numero_linea, producto_exento: producto_exento, descuento: descuento},
					       function(response){
                                        if(response.respuesta === false){
                                                alertify.error("Límite de líneas para Imprimir en la Factura");
                                        }
                                        
			                            if(response.respuesta === true){
										// Enviar a la funcion correspondiente
												ActualizarEtiquetas(response);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) agregado.");
												$('#VentanaModificarAjusteVenta').modal("hide");	
                                        }
						}, "json");
				}				
		});
///////////////////////////////////////////////////
// funcionalidad de el select lstTipoPrecio
///////////////////////////////////////////////////
// Parametros para el ...
	$("#lstTipoPrecio").change(function () {                              
        $("#lstTipoPrecio option:selected").each(function () {
                // calcular nuevo precio
                    precio = parseFloat($(this).val());
                    $("#txtPrecioVentaAjusteModificar").val(precio);
        });
    });
///////////////////////////////////////////////////
// FUNCION PARA ACTUALIZAR ETIQUETAS RELACIONADAS CON LA VENTANA SUMAS.
///////////////////////////////////////////////////
function ActualizarEtiquetas(response){
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
		
		if(accion_temp_detalle_factura == "GuardarDetalleFacturaTemp"){
            $("label[for='NumeroProductos']").text(response.numero_linea);
			$("#ControlProductos").val(response.numero_linea);			
		}
		else if(accion_temp_detalle_factura == "eliminarDetalleFacturaTemp"){
			$("label[for='NumeroProductos']").text(response.numero_linea);
			$("#ControlProductos").val(response.numero_linea);			
		}
		else{
			$("label[for='NumeroProductos']").text(response.numero_linea);
			$("#ControlProductos").val(response.numero_linea);
		}
    // HIDDEN TOTAL VENTA
        $("#txtTotalVenta").val(response.venta_total);
		$("#txtTotalVentaDescuento").val(response.descuento);
}
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
}); // Cierre princial de la función document.