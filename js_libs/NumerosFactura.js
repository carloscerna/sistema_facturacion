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
			$('#txtFechaAutorizacion').val(today);
			$('#txtFechaImpresion').val(today);
	///
//// CARGAR INFORMACIÓN  -- TIPO DE FACTURA (CONSUMIDOR FINAL O CREDITO FISCAL)
///
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
	});
	
	
	$(document).ready(function()
	{	
		var miselect=$("#lstEstatus");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_estatus.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
			
			
	});			
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
			var table = $("#listadoNumerosFactura").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/NumerosFactura.php",
					data: {"accion_buscar": buscartodos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_factura_tiraje"},
					{"data":"nombre_tipo_factura"},
					{"data":"tiraje"},
					{"data":"numero_inicio"},
					{"data":"numero_fin"},
					{"data":"fecha_autorizacion"},
					{"data":"fecha_impresion"},
					{"data":"nombre_estatus"},
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
$('#listadoNumerosFactura').on( 'click', 'a.editar', function () {
				id_ =$(this).parents('tr').find('td').eq(0).html();
				accion = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/NumerosFactura.php", {accion: accion, id_: id_},
				       function(data){
							// Cargar valores a los objetos
								$('#txtId').val(data[0].id_);
								$('#txtNumeroFacturaTiraje').val(data[0].tiraje);
								$('#txtNumeroFacturaInicio').val(data[0].numero_inicio);
								$('#txtNumeroFacturaFin').val(data[0].numero_fin);
								$('#txtFechaAutorizacion').val(data[0].fecha_autorizacion);
								$('#txtFechaImpresion').val(data[0].fecha_impresion);
								$('#lstTipoFactura option[value='+data[0].codigo_tipo_factura+']').prop('selected',true);
								 $('#lstEstatus option[value='+data[0].codigo_estatus+']').prop('selected',true);
								
								//////////////////////////////////////////////////////////////
								// Cambiar el accion_cliente a Actualizar REgistro
								//////////////////////////////////////////////////////////////
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaNumeroFacturaTiraje').modal("show");
									toastr.success("Registro(s) listo para Editar.");
									accion = "ActualizarRegistro";	// variable global
				}, "json");	
});

///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoNumerosFactura').on( 'click', 'a.remove', function () {
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
                        url:"php_libs/soporte/NumerosFactura.php",
		            data:"accion="+ accion + "&id_=" + id_ + "&numero_factura_real=" + tiraje + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                toastr.warning("Registro(s) Eliminado(s).");
								listar();
                           }                                                
                           if (response.mensaje == "No Eliminar") {
                                toastr.info("No se puede Eliminar. El Tiraje Tiene Facturas en el Sistema.");
                           }
                           if (response.mensaje == "No Registro") {
                                toastr.error("Registro(s) No Eliminado(s).");
                           }
		            },
		            error:function(){
		                toastr.error("Error, ejecución de la consulta");
		            }
		        });		
	// Cerrar el Formulario Modal y reinicar variables.
	accion = ""; id_ = 0; tipo_factura = ""; tiraje = "";
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
// BOTÓN GUARDAR. QUE ESTA DENTRO DEL FORM AGREGARUSER
///////////////////////////////////////////////////////////////////////////////	
	jQuery.validator.addMethod("valores",function(value, element, param) {
	var result = true;
	var comparador = $(param).val();
	var valor1 = $(param).val();
	var valor2 = value;
	
	console.log(valor1);
	console.log(valor2);
	// VALIDAR			
		if (parseInt(valor1) <= parseInt(valor2)) {
		  result = true;
		  console.log("Verdadero");
		} else {
		  console.log("Falso");
		  result = false;
		}
	
		if (parseInt(valor1) == parseInt(valor2)) {
		  result = false;
		  console.log("Falso");
		}
		
		return result;
		
		}, "valores");

		$('#formTiraje').validate({
			rules:{
			        txtNumeroFacturaTiraje: {
						required: true,
						maxlength: 8,
						minlength: 8
					},
					txtNumeroFacturaInicio:{
					   required: true,
					   maxlength: 5,
					   minlength: 1,
					   digits: false,
					   min: 1
					},
					txtNumeroFacturaFin:{
					   required: true,
					   maxlength: 5,
					   minlength: 1,
					   digits: false,
					   min: 2,
					   valores: "#txtNumeroFacturaInicio"
					}   
			},
			messages: {
				txtNumeroFacturaFin:{
					valores: "El Número Factura Inicio no puede ser MAYOR o IGUAL que el Número Factura Fin"
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
		        var str = $('#formTiraje').serialize();
					//alert(str);

		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/NumerosFactura.php",
		            data:str + "&accion=" + accion + "&id_=" + id_ +"&id=" + Math.random(),
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro Actualizado") {
                                    toastr.success("Registro(s) Actualizado(s).");
							listar();
                                }

                                if (response.mensaje == "Si Registro") {
                                    toastr.success("Registro(s) Guardado(s).");
							listar();
                                }
                                
                                if (response.mensaje == "No Registro") {
                                    toastr.error("Registro(s) No Guardado(s).");
							listar();
                                }
										  
                                if (response.mensaje == "Estatus") {
                                    toastr.error("Registro(s) No Guardado(s). No puede Existir 2 Tipos de Facturas Activas.");
							listar();
                                }
										  
						// Limpiar variables Text, y textarea
							$("#formTiraje")[0].reset();
						// Abrimos el Formulario Modal y Rellenar For.
							$('#VentanaNumeroFacturaTiraje').modal("hide");
				}
		        });
			}
		});
		
///////////////////////////////////////////////////
// funcionalidad del botón que abre el formulario
///////////////////////////////////////////////////
		$('#NuevoTiraje').on('click',function(){
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaNumeroFacturaTiraje').modal("show");
			// cambiar aacion_cliente para poder guardar el registro.
				accion = "GuardarRegistro";
			//  pasar el valor de la fechas a los diferentes objetos.
			$('#txtFechaAutorizacion').val(today);
			$('#txtFechaImpresion').val(today);
		});
		///////////////////////////////////////////////////
		// funcionalidad del botón que abre el formulario
		///////////////////////////////////////////////////
	    $("#VentanaNumeroFacturaTiraje").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea
				$("#formTiraje")[0].reset();
				$("label.error").remove();
				// Desabilitar Fecha Creación Proveedor.
					//$("#txtFechaCreacion").prop("readonly",false);
				accion = "";
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaNumeroFacturaTiraje').on('shown.bs.modal', function() {
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