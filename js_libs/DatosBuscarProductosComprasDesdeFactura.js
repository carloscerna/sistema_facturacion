// id de user global
var accion = 'noAccion';
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#BotonBuscarProducto').on('click',function(){
				$('#VentanaBuscarProducto').modal("show");	
                listarProductos();
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
						return '<input type=number min=0 max=999 name=precio class="form-control form-control-sm" size=5 maxlength=6 value='+ data+'>';
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
                codigo_tipo_factura = $("label[for='lblCodigoTipoFactura']").text();
				codigo_proveedor = $("label[for='lblCodigoProveedor']").text();
				numero_factura = $("label[for='lblNumeroFactura']").text();

				accion = "GuardarDetalleFacturaCompra";	// variable global
				$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/FacturasCompras.php", {accion: accion, codigo_producto: codigo_producto, cantidad: cantidad, precio: precio, codigo_tipo_factura: codigo_tipo_factura, codigo_proveedor: codigo_proveedor, numero_factura: numero_factura},
				       function(response){
                                        if(response.respuesta === false){
                                                alertify.notify("Limite de lineas para Imprimir en la Factura");
                                        }
                                        
                                        if(response.respuesta === true){
										// Cargar valores a los objetos
											$("#listaEditarCompra").empty();
											$('#listaEditarCompra').append(response.contenido);
                                        // Label Sub-total, IVA y Totl.
												$("label[for='lblTotalCompra']").text(response.total_compra);
                                        // Mensaje del programa
                                                alertify.success("Registro(s) agregado.");
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