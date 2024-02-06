// id de user global
var accion = 'noAccion';
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#BotonBuscarProducto').on('click',function(){
				$('#VentanaBuscarProductoCodigosBarra').modal("show");	
                listarProductos();
        });
///////////////////////////////////////////////////////////////////////////////
// FUNCION ELIMINA LOS REGISTROS DE LA TABLA TEMP DETALLE FACTURA
///////////////////////////////////////////////////////////////////////////////
        $('#goEliminarCodigosBarra').on('click',function(){
                codigo_usuario = $("#lstCodigoVendedor").val(); // Código del vendedor se almacena para controla el detalle de la factura.
                accion = "EliminarCodigosBarraTodo";	// variable global
                
                                $.post("php_libs/soporte/DetalleTempCodigosBarra.php",  {accion: accion},
                                function(response) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                                toastr.warning("Registro(s) eliminado.");
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
				"columns":[
					{"data":"codigo_producto"},
					{"data":"descripcion"},
                                        
					{
						data: null,
						defaultContent: '<input type=number min=1 max=999 name=cantidad class="form-control form-control-sm" size=5 maxlength=3 value=1>',
					},
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
				codigo_producto =$(this).parents('tr').find('td').eq(0).html();
                cantidad = $(this).parents('tr').find('td').eq(2).find("input[name='cantidad']").val();

				accion = "GuardarDetalleCodigosBarra";	// variable global
				$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/DetalleTempCodigosBarra.php", {accion: accion, codigo_producto: codigo_producto, cantidad: cantidad},
				       function(response){
                                        if(response.respuesta === false){
                                                toastr.warning("Código Ya Existe.");
                                        }
                                        
                                        if(response.respuesta === true){
											// Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
											// Mensaje del programa
                                                toastr.success("Registro(s) agregado.");
                                        }
				}, "json");			
});
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
 ///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaProductosTemp a',function (e){
                e.preventDefault();
				// Id Tempy y Acción.
				idUser_ok = $(this).attr('href');
				accion_ok = $(this).attr('data-accion');
				// Rturina per editar el registro.
				if( accion_ok == 'editarDetalleCantidad'){
                                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                                $.post("php_libs/soporte/DetalleTempCodigosBarra.php",  { id_: idUser_ok, accion: accion_ok},
                                                function(data) {
                                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                                        $('#txtCantidad').val(data[0].cantidad);
                                                 }, "json");
											// Mensaje del programa
                                                toastr.success("Editar Registro...");
												// OCULTAR VENTANA MODAL.
												$('#VentanaModificarCantidad').modal('show');
				}else if($(this).attr('data-accion') == 'eliminarDetalleCodigosBarra'){
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/DetalleTempCodigosBarra.php",  { id_: idUser_ok, accion: accion_ok},
                                function(response) {
                                // Llenar el formulario con los datos del registro seleccionado tabs-1
                                	// Cargar valores a los objetos
                                       $("#listaProductosTemp").empty();
                                       $('#listaProductosTemp').append(response.contenido);
									// Mensaje del programa
                                       toastr.info("Registro(s) Eliminado.");
                               }, "json");
				}
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE
		///////////////////////////////////////////////////
		$('#goActualizarCantidad').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
                        cantidad = $("#txtCantidad").val();
						accion = "ActualizarCantidad";
                        id_ = idUser_ok;
			// Generar el Código Nuevo.
				$.post("php_libs/soporte/DetalleTempCodigosBarra.php", {id_: idUser_ok, accion: accion, cantidad: cantidad},
				       function(response){
                                        if(response.respuesta === true){
                                        // Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Mensaje del programa
                                                toastr.info("Registro(s) Actualizado.");
										// OCULTAR VENTANA MODAL.
												$('#VentanaModificarCantidad').modal('hide');
                                        }                                                
				}, "json");
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE
		///////////////////////////////////////////////////
		$('#BotonVerProducto').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
						accion = "VerProducto";
			// Generar el Código Nuevo.
				$.post("php_libs/soporte/DetalleTempCodigosBarra.php", {accion: accion},
				       function(response){
                                        if(response.respuesta === true){
                                        // Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                                $('#listaProductosTemp').append(response.contenido);
                                        // Mensaje del programa
                                                toastr.info("Registro(s) Encontrados.");
                                        }                                                
                                        if(response.respuesta === false){
                                        // Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                        // Mensaje del programa
                                                toastr.info("Registro(s) No Encontrados.");
                                        }
				}, "json");
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón ACTUALIZAR CANTIDAD TEMP DETALLE
		///////////////////////////////////////////////////
		$('#BotonEliminarTodosProductos').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
						accion = "EliminarTodos";
			// Generar el Código Nuevo.
				$.post("php_libs/soporte/DetalleTempCodigosBarra.php", {accion: accion},
				       function(response){
                                        if(response.respuesta === true){
                                        // Cargar valores a los objetos
                                                $("#listaProductosTemp").empty();
                                        // Mensaje del programa
                                                toastr.info("Registro(s) Eliminados.");
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