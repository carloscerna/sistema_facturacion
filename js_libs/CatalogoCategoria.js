// id de user global
var id_categoria = 0;
var accion_categoria = 'noAccion';
//var fecha_creacion_proveedor = "";
//var ann_proveedor = "" // valor de año actual para generar nuevamente los c{odigos del los cliente/empresa.

$(document).ready( function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
		$(document).ready(function(){
			listar();
		});	
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listar = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		// Tabla que contrendrá los registros.
			var table = $("#listadoCategoria").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoCategoria.php",
					data: {"accion_categoria_buscar": buscartodos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_categoria"},
					{"data":"codigo"},
					{"data":"descripcion"},
					{
						data: null,
						defaultContent: '<a href="#" class="editar btn btn-info" data-toggle="modal" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="fa fa-edit"></span>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="remove btn btn-warning" data-toggle="modal" data-target="#VentanaEliminar" data-toggle="tooltip" data-placement="right" title="Anular"> <span class="fa fa-trash"></span></a>',
						orderable: false
					},
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCategoria').on( 'click', 'a.remove', function () {
			id_categoria =$(this).parents('tr').find('td').eq(0).html();
			codigo =$(this).parents('tr').find('td').eq(1).html();
			nombre_empresa =$(this).parents('tr').find('td').eq(2).html();
			accion_categoria = "EliminarRegistro";
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEliminar').modal("show");
				$("span[for='Id']").text(id_categoria);
				$("span[for='Codigo']").text(codigo);
				$("span[for='Descripcion']").text(nombre_empresa);

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
                        url:"php_libs/soporte/CatalogoCategoria.php",
		            data:"accion_categoria_buscar="+ accion_categoria + "&id_=" + id_categoria + "&id=" + Math.random(),
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
	accion_categoria = ""; id_categoria = 0; codigo = ""; 
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCategoria').on( 'click', 'a.editar', function () {
				id_categoria =$(this).parents('tr').find('td').eq(0).html();
				accion_categoria = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/CatalogoCategoria.php", {accion_categoria_buscar: accion_categoria, id_: id_categoria},
				       function(data){
							// Cargar valores a los objetos
								$('#txtCodigoCategoria').val(data[0].codigo);
								$('#txtDescripcion').val(data[0].descripcion);
								$('#txtObservaciones').val(data[0].observacion);
								//////////////////////////////////////////////////////////////
								// Cambiar el accion_categoria a Actualizar REgistro
								//////////////////////////////////////////////////////////////
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaCategoria').modal("show");
                                    alertify.success("Registro(s) listo para Editar.");
									accion_categoria = "ActualizarRegistro";	// variable global
				}, "json");	
});
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
// BOTÓN GUARDAR. QUE ESTA DENTRO DEL FORM AGREGARUSER
///////////////////////////////////////////////////////////////////////////////	
		$('#formCategoria').validate({
				rules:{
			        txtDescripcion: {
						required: true,
						maxlength: 40
					},
					txtObservaciones:{
					   maxlength: 100
					}   
			},
				errorPlacement: function(error, element){
						if(element.parent('.input-group').length){
							error.insertAfter(element.parent());
						}else{
							error.insertAfter(element);
						}
				},
		    submitHandler: function(){
             // Serializar los datos, toma todos los Id del formulario con su respectivo valor.
		        var str = $('#formCategoria').serialize();

		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/CatalogoCategoria.php",
		            data:str + "&accion_categoria_buscar=" + accion_categoria + "&id=" + Math.random() + "&id_=" + id_categoria,
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro") {
                                    alertify.success("Registro(s) Guardado(s).");
								// Limpiar variables Text, y textarea
									$("#formCategoria")[0].reset();
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaCategoria').modal("hide");
									listar();
                                }
                                
                                if (response.mensaje == "No Registro") {
                                    alertify.error("Registro(s) No Guardado(s).");
									listar();
                                }
						}
		        });
			}
		});		 
///////////////////////////////////////////////////
// funcionalidad del botón que abre el formulario
///////////////////////////////////////////////////
		$('#NuevoCategoria').on('click',function(){
			// Acción nuevo registro y variables default.
				accion_categoria = "GenerarCodigoNuevo";
			// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoCategoria.php", {accion_categoria_buscar: accion_categoria},
				function(data){
					// Información de la Tabla Datos Personal.
					$("#txtCodigoCategoria").val(data[0].codigo_nuevo);
				}, "json");
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaCategoria').modal("show");
			// cambiar aacion_cliente para poder guardar el registro.
				accion_categoria = "GuardarRegistro";
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón que abre el formulario
		///////////////////////////////////////////////////
	    $("#VentanaCategoria").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea
				$("#formCategoria")[0].reset();
				accion_categoria = "";
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaCategoria').on('shown.bs.modal', function() {
			  $(this).find('[autofocus]').focus();
			});
		
}); // Cierre princial de la función document.
///////////////////////////////////////////////////////////
// Convertir a mayúsculas cuando abandone el input.
////////////////////////////////////////////////////////////
   function conMayusculas(field)
   {
        field.value = field.value.toUpperCase();
   }