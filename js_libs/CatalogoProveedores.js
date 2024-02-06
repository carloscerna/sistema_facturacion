// id de user global
var id_proveedores = 0;
var accion_proveedor = 'noAccion';
var fecha_creacion_proveedor = "";
var ann_proveedor = ""; // valor de año actual para generar nuevamente los c{odigos del los cliente/empresa.

$(document).ready( function () {
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIoND E LA FECHA, Y PASAR A CIERTOS OBJETOS.
///////////////////////////////////////////////////////////////////////////////
                var now = new Date();
                
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                ann_proveedor = now.getFullYear();
                
                var today =(day)+"/"+(month)+"/"+now.getFullYear();
				fecha_creacion_proveedor = today;
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
			var table = $("#listadoProveedores").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProveedores.php",
					data: {"accion_proveedor_buscar": buscartodos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_proveedores"},
					{"data":"codigo"},
					{"data":"nombre_empresa"},
					{"data":"nombre"},
					{"data":"telefono_uno"},
					{"data":"telefono_dos"},
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
$('#listadoProveedores').on( 'click', 'a.remove', function () {
			id_proveedores =$(this).parents('tr').find('td').eq(0).html();
			codigo =$(this).parents('tr').find('td').eq(1).html();
			nombre_empresa =$(this).parents('tr').find('td').eq(2).html();
			accion_proveedor = "EliminarRegistro";
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEliminar').modal("show");
				$("span[for='Id']").text(id_proveedores);
				$("span[for='Codigo']").text(codigo);
				$("span[for='EmpresaPersona']").text(nombre_empresa);

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
                        url:"php_libs/soporte/CatalogoProveedores.php",
		            data:"accion_proveedor_buscar="+ accion_proveedor + "&id_=" + id_proveedores + "&codigo_proveedor=" + codigo + "&id=" + Math.random(),
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
                          if (response.mensaje == "No Eliminar") {
                                alertify.error("No se puede Eliminar El Proveedor. Tiene Facturas en el Sistema.");
                           }
						   
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
	// Cerrar el Formulario Modal y reinicar variables.
	accion_proveedor = ""; id_proveedores = 0; codigo = ""; empresa_persona = "";
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoProveedores').on( 'click', 'a.editar', function () {
				id_proveedores =$(this).parents('tr').find('td').eq(0).html();
				accion_proveedor = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/CatalogoProveedores.php", {accion_proveedor_buscar: accion_proveedor, id_: id_proveedores},
				       function(data){
							// Cargar valores a los objetos
								$('#txtCodigoProveedor').val(data[0].codigo);
								$('#lstEstatusProveedor option[value='+data[0].codigo_estatus+']').attr('selected',true);
								$('#txtNombreEmpresa').val(data[0].nombre_empresa);
								$('#txtNombre').val(data[0].nombre);
								$('#txtDireccion').val(data[0].direccion);
								$('#txtFechaCreacionProveedor').val(data[0].fecha_creacion_proveedor);
								// Desabilitar Fecha Creación Proveedor.
									$("#txtFechaCreacionProveedor").prop("readonly",true);
			
								$('#txtNumeroRegistro').val(data[0].numero_registro);
								$('#txtGiro').val(data[0].giro);
								$('#txtDui').val(data[0].dui);
								$('#txtNit').val(data[0].nit);
								$('#txtTelefonoResidencia').val(data[0].telefono_residencia);
								$('#txtTelefonoOficina').val(data[0].telefono_dos);
								$('#txtTelefonoCelular').val(data[0].telefono_celular);

								
								$('#lstDepartamento option[value='+data[0].codigo_departamento+']').attr('selected',true);
                                                                          /// Seleccionar municipio en base al departamento guardado.
                                                var miselect=$("#lstMunicipio");
                                                var codigo_municipio = data[0].codigo_municipio;
								/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
										miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
                                                                departamento=$("#lstDepartamento").val();
                                                                 $.post("includes/cargar_municipio.php", { departamento: departamento },
                                                                                function(data){
                                                                                 miselect.empty();
                                                                                   for (var i=0; i<data.length; i++) {
                                                                                                if(codigo_municipio == data[i].codigo){
                                                                                                   miselect.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');             
                                                                                                }else{
                                                                                                   miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
                                                                                                }
                                                                                      }
                                                                }, "json");
                                                                 
                                     $('#lstMunicipio option[value='+data[0].codigo_municipio+']').attr('selected',true);																
								//////////////////////////////////////////////////////////////
								// Cambiar el accion_proveedor a Actualizar REgistro
								//////////////////////////////////////////////////////////////
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaEmpresaPersona').modal("show");
                                    alertify.success("Registro(s) listo para Editar.");
									accion_proveedor = "ActualizarRegistro";	// variable global
				}, "json");	
});
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACION DEL IDIOMA AL ESPAÑOL.
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
// BOTON GUARDAR. QUE ESTA DENTRO DEL FORM AGREGARUSER
///////////////////////////////////////////////////////////////////////////////	
		$('#formEmpresaPersona').validate({
			rules:{
			        txtNombreEmpresa: {
						required: true,
						maxlength: 80
					},
					txtFechaCreacionProveedor:{
					   required: true,
					   date: true,
					   maxlength: 10,
					   minlength: 10
					},
					txtGiro:{
					   maxlength: 120
					},
					txtDireccion:{
					   maxlength: 110
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
		        var str = $('#formEmpresaPersona').serialize();

		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/CatalogoProveedores.php",
		            data:str + "&accion_proveedor_buscar=" + accion_proveedor + "&id=" + Math.random() + "&id_=" + id_proveedores + "&ann="+ann_proveedor,
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro") {
                                    alertify.success("Registro(s) Guardado(s).");
								// Limpiar variables Text, y textarea
									$("#formEmpresaPersona")[0].reset();
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaEmpresaPersona').modal("hide");
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
		$('#NuevoEmpresaPersona').on('click',function(){
			// Acción nuevo registro y variables default.
				accion_proveedor = "GenerarCodigoNuevo";
				$('#txtFechaCreacionProveedor').val(fecha_creacion_proveedor);
			// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoProveedores.php", {accion_proveedor_buscar: accion_proveedor, ann: ann_proveedor},
				function(data){
					// Información de la Tabla Datos Personal.
					$("#txtCodigoProveedor").val(data[0].codigo_nuevo);
				}, "json");
			///
			/// COLOCAR EL SELECT EN DEPARTAMENTO 02 Y MUNICIPIO 10.
			///
				$('#lstDepartamento option[value=02]').prop('selected',true);
			///
			/// FILTRAR EN LA TABLA MUNICIPIO DEPENDE DEL CODIGO DEL DEPARTAMENTO.
			///
					var miselect = $("#lstMunicipio");
							departamento="02";
							codigo_municipio = "10";
							$.post("includes/cargar_municipio.php", { departamento: departamento },
								   function(data){
								miselect.empty();
								for (var i=0; i<data.length; i++) {
									if(data[i].codigo == codigo_municipio)
										{
											miselect.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');
										}else{	
										miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
										}								}
						}, "json");			
			///
			///	SELECCIONAR EL REGISTRO MUNICIPIO POR EJ. SANTA ANA.
			///
				//$('#lstMunicipio').prop('SelectedIndex',10);
				$('#lstMunicipio option[value="02"]').prop('selected',true);
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEmpresaPersona').modal("show");
			// cambiar aacion_cliente para poder guardar el registro.
				accion_proveedor = "GuardarRegistro";
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón que abre el formulario
		///////////////////////////////////////////////////
	    $("#VentanaEmpresaPersona").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea
				$("#formEmpresaPersona")[0].reset();
				$("label.error").remove();
				// Desabilitar Fecha Creación Proveedor.
					$("#txtFechaCreacionProveedor").prop("readonly",false);
				accion_proveedor = "";
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaEmpresaPersona').on('shown.bs.modal', function() {
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