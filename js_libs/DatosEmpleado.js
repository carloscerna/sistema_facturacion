// id de user global
var id_ = 0;
var accion = 'noAccion';
var tiraje = "";
var today = "";
var fecha_ = "";
$(document).ready(function () {
    ///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIÓND E LA FECHA, Y PASAR A CIERTOS OBJETOS.
///////////////////////////////////////////////////////////////////////////////
                var now = new Date();
                
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                ann = now.getFullYear();
                
                today =(day)+"/"+(month)+"/"+now.getFullYear();
				fecha_ = today;
            //  pasar el valor de la fechas a los diferentes objetos.
			$('#txtFechaNacimiento').val(today);		
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
			var table = $("#listadoDatosEmpleado").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/DatosEmpleado.php",
					data: {"accion_buscar": buscartodos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_personal"},
					{"data":"nombres"},
					{"data":"apellidos"},
					{
						data: 'nombre_estatus',
						render: function (data, type) {
							if (type === 'display') {
								let color = 'badge badge-primary';
								if (data === 'Activo') {
								}
								if (data === 'Inactivo') {
									color = 'badge badge-danger';
								}
							//return `<span style="color:${color}">${data}</span>`;
							return `<span class="${color}">${data}</span>`;
						}		 
						return data;
					}
				},
					
					{
						data: null,
						defaultContent: '<a href="#" class="editar btn btn-info" data-toggle="modal" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="fa fa-edit"></span>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="remove btn btn-warning" data-toggle="modal" data-target="#VentanaEliminar" data-toggle="tooltip" data-placement="right" title="Eliminar"> <span class="fa fa-trash"></span></a>',
						orderable: false
					},	                                                                                                                                                
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoDatosEmpleado').on( 'click', 'a.editar', function () {
				id_ =$(this).parents('tr').find('td').eq(0).html();
				accion = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/DatosEmpleado.php", {accion: accion, id_: id_},
				       function(data){
							// Cargar valores a los objetos
								$('#txtId').val(data[0].id_);
								$('#txtNombres').val(data[0].nombres);
								$('#txtApellidos').val(data[0].apellidos);
								$('#txtFechaNacimiento').val(data[0].fecha_nacimiento);
								$('#lstGenero').val(data[0].codigo_genero);
								$('#lstEstadoCivil').val(data[0].codigo_estado_civil);
								$('#lstAfp').val(data[0].codigo_afp);
								$('#lstDepartamento').val(data[0].codigo_departamento);
								$('#lstMunicipio').val(data[0].codigo_municipio);
								$('#txtDireccion').val(data[0].direccion);
								$('#lstEstatus').val(data[0].codigo_estatus);
								//////////////////////////////////////////////////////////////
								// Cambiar el accion_cliente a Actualizar REgistro
								//////////////////////////////////////////////////////////////
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaDatosEmpleado').modal("show");
									toastr.success("Registro(s) listo para Editar.");
									accion = "ActualizarRegistro";	// variable global
				}, "json");	
});

///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoDatosEmpleado').on( 'click', 'a.remove', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
			tipo_factura =$(this).parents('tr').find('td').eq(1).html();
			tiraje =$(this).parents('tr').find('td').eq(2).html();
			accion = "EliminarRegistro";
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEliminar').modal("show");
				$("span[for='Id']").text(id_);
				$("span[for='TipoFactura']").text(tipo_factura);
				$("span[for='Tiraje']").text(tiraje);

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
                        url:"php_libs/soporte/DatosEmpleado.php",
		            data:"accion="+ accion + "&id_=" + id_  + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.respuesta == true) {
                                toastr.warning(response.mensaje);
                           }else{
								toastr.info(response.mensaje);
						   }                                                
						   //
						   listar();
		            },
		            error:function(){
		                toastr.error("Error, ejecución de la consulta");
		            }
		        });		
	// Cerrar el Formulario Modal y reinicar variables.
	accion = ""; id_ = 0;
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
// BOTÓN GUARDAR. QUE ESTA DENTRO DEL FORM AGREGARUSER
///////////////////////////////////////////////////////////////////////////////	
		$('#formVentanaDatosEmpleado').validate({
			rules:{
				txtNombres: {
					required: true,
					maxlength: 40
				},
				txtApellidos:{
				   required: true,
				   maxlength: 40
				},
			},
			messages: {
				
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
		        var str = $('#formVentanaDatosEmpleado').serialize();
					//alert(str);

		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/DatosEmpleado.php",
		            data:str + "&accion=" + accion + "&id_=" + id_ +"&id=" + Math.random(),
		            success: function(response){
						// Si el valor si existe compararlo con mensaje error.
						if (response.respuesta == true) {
							toastr.success(response.mensaje);
						}else{
							toastr.error(response.mensaje);
						}
						//
							listar();
						// Limpiar variables Text, y textarea
							$("#formVentanaDatosEmpleado").get(0).reset();
						// Abrimos el Formulario Modal y Rellenar For.
							$('#VentanaDatosEmpleado').modal("toggle");
				}
		        });
			}
		});
		
///////////////////////////////////////////////////
// funcionalidad del botón que abre el formulario
///////////////////////////////////////////////////
		$('#NuevoDatosEmpleado').on('click',function(){
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaDatosEmpleado').modal("show");
			// cambiar aacion_cliente para poder guardar el registro.
				accion = "GuardarRegistro";
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón que abre el formulario
		///////////////////////////////////////////////////
	    $("#VentanaDatosEmpleado").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea
				$("#VentanaDatosEmpleado").get(0).reset();
				$("label.error").remove();
				accion = "";
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaDatosEmpleado').on('shown.bs.modal', function() {
			  $(this).find('[autofocus]').focus();
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
		 
}); // Cierre princial de la función document.
///////////////////////////////////////////////////////////
// Convertir a mayúsculas cuando abandone el input.
////////////////////////////////////////////////////////////
   function conMayusculas(field)
   {
        field.value = field.value.toUpperCase();
   }