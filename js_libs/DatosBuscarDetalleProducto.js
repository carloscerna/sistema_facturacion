// id de user global
var accion = 'noAccion';
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#BotonBuscarDetalleProducto').on('click',function(){
				$('#VentanaBuscarDetalleProducto').modal("show");	
                listarProductos();
        });
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listarProductos = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		// Tabla que contrendrá los registros.
			var table = $("#listadoDetalleProducto").dataTable({
				"lengthMenu": [[3, 5, 10, 25, 50, -1], [3, 5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProductos.php",
					data: {"accion_productos_buscar": buscartodos}
				},
				"columns":[
					{"data":"codigo_producto"},
					{"data":"descripcion"},
                                        
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
$('#listadoDetalleProducto').on( 'click', 'a.seleccionar', function () {
				codigo_producto =$(this).parents('tr').find('td').eq(0).html();
                //cantidad = $(this).parents('tr').find('td').eq(2).find("input[name='cantidad']").val();

				accion = "GuardarDetalleProducto";	// variable global
				$('#accion').val(accion);	// input text hidden
				fecha_inicio = $('#txtFechaInicioDetalle').val(); // FEcha Inicio inventario
				tabla1 = $('#tabla1').val();
				$.post("php_libs/soporte/DetalleProductoTemp.php", {accion: accion, codigo_producto: codigo_producto, fecha: fecha_inicio, tabla: tabla1},
				       function(response){
                                        if(response.respuesta === false){
                                                toastr.warning("Código Ya Existe.");
                                        }
                                        
                                        if(response.respuesta === true){
											// Cargar valores a los objetos
                                                $("#listaDetalleProducto").empty();
                                                $('#listaDetalleProducto').append(response.contenido);
											// Mensaje del programa
                                                toastr.success("Registro(s) agregado.");
											// OCULTAR VENTANA MODAL.
												//$('#VentanaBuscarDetalleProducto').modal("hide");	
                                        }
				}, "json");			
});
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
 ///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaDetalleProducto a',function (e){
                e.preventDefault();
				// Id Tempy y Acción.
				idUser_ok = $(this).attr('href');
				accion_ok = $(this).attr('data-accion');
				// Rturina per editar el registro.
				if( accion_ok == 'editarDetalleCantidad'){
                                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                                $.post("php_libs/soporte/DetalleProductoTemp.php",  { id_: idUser_ok, accion: accion_ok},
                                                function(data) {
                                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                                        $('#txtCantidad').val(data[0].cantidad);
                                                 }, "json");
											// Mensaje del programa
                                                toastr.success("Editar Registro...");
												// OCULTAR VENTANA MODAL.
												$('#VentanaModificarCantidad').modal('show');
				}else if($(this).attr('data-accion') == 'verDetalleProducto'){
						fecha_inicio = $("#txtFechaInicioDetalle").val();
						fecha_fin = $("#txtFechaFinDetalle").val();

					var str = {
						codigo_producto: idUser_ok,
						accion: accion_ok
					};
						Pace.track(function(){
							$.ajax({
								beforeSend: function(){
									console.log("Creando Reporte...");
								},
								cache: false,
								type: "POST",
								dataType: "json",
								url:"php_libs/soporte/DetalleProductoTemp.php",
								data: str,
								success: function(response){
									// Validar mensaje de error
									// Si el valor si existe compararlo con mensaje error.
									   if (response.mensaje == "Si Registro") {
												tabla1 = $('#tabla1').val();
												if(tabla1 == "ajuste"){
													// construir la variable con el url.
														varenviar = "/sistema_facturacion/php_libs/reportes/inventario_detalle_por_producto.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&codigo_producto="+codigo_producto;
														console.log("Enviando Informe...");
														// Ejecutar la función
															AbrirVentana(varenviar);
												}
												if(tabla1 == "detalle-venta"){
													// construir la variable con el url.
														varenviar = "/sistema_facturacion/php_libs/reportes/detalle_por_producto.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&codigo_producto="+codigo_producto;
														console.log("Enviando Informe...");
														// Ejecutar la función
															AbrirVentana(varenviar);
												}
									   }                                                
									   if (response.mensaje == "No Registro") {
											// construir la variable con el url.
												console.log("No Existe este producto...");
												toastr.success("No Existen Registros...");
									   }          
								},
								error: function(){
									console.log("Error...");
								}
							});	
						});					
				}
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE FACTURA
		///////////////////////////////////////////////////
		$('#goActualizarCantidad').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
                cantidad = $("#txtCantidad").val();
				accion = "ActualizarCantidad";
                id_ = idUser_ok;
				
				var str = {
					cantidad: cantidad,
					id_: idUser_ok,
					accion: accion
				};
					Pace.track(function(){
							$.ajax({
								beforeSend: function(){
									console.log("Actualizando Ajuste...");
								},
								cache: false,
								type: "POST",
								dataType: "json",
								url:"php_libs/soporte/DetalleProductoTemp.php",
								data: str,
								success: function(response){
									// Validar mensaje de error
									// Si el valor si existe compararlo con mensaje error.
									   if (response.mensaje == "Si Registro") {
										    $("#listaDetalleProducto").empty();
                                            $('#listaDetalleProducto').append(response.contenido);
											toastr.success("Registro(s) Actualizado(s).");
											console.log("Registros Actualizados...");
									   }                                                
									   if (response.mensaje == "No Registro") {
											$("#listaDetalleProducto").empty();
											toastr.info("Registro(s) No Encontrados(s).");
											console.log("Registros No Actualizados...");
									   }
								},
								error: function(){
									console.log("Error...");
								}
							});	
					});
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

///////////////////////////////////////////////////////////////////////////////
// ABRE NUEVA PESTAÑA.
///////////////////////////////////////////////////////////////////////////////
function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}