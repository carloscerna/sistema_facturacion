// id de user global
var id_cliente = 0;
var accion_cliente_buscar = 'noAccion';
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#goBuscarClienteEmpresa').on('click',function(){
		$('#VentanaBuscarClienteEmpresa').modal("show");	
            listarBuscarClienteEmpresa();
        });
        $('#BotonBuscarClienteEmpresa').on('click',function(){
		$('#VentanaBuscarClienteEmpresa').modal("show");	
		listarBuscarClienteEmpresa();
        }); 
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
		
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listarBuscarClienteEmpresa = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		// Tabla que contrendrá los registros.
			var table = $("#listadoBuscarClienteEmpresa").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoClientes.php",
					data: {"accion_cliente_buscar": buscartodos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_clientes"},
					{"data":"codigo"},
					{"data":"cliente_empresa"},
					{
						data: null,
						defaultContent: '<a href="#" class="seleccionar btn btn-info" data-toggle="modal" data-toggle="tooltip" data-placement="right" title="Seleccionar"> <span class="fa fa-check"></span>',
						orderable: false
					},					
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };

///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. CARGA LOS DATOS EN LA FACTURAS.
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoBuscarClienteEmpresa').on( 'click', 'a.seleccionar', function () {
				id_cliente =$(this).parents('tr').find('td').eq(0).html();
				// INPUT HIDDEN QUE SE ENCUENTRA EN PLANTILLA VENTANACLIENTEMPRESA.HTML.
				$("#txtIdCodigoClienteBuscarVentas").val(id_cliente);
				accion_cliente_buscar = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/CatalogoClientes.php", {accion_cliente_buscar: accion_cliente_buscar, id_: id_cliente},
				       function(data){
							$("span[for='txtNombreClienteEmpresa']").text(data[0].cliente_empresa);
							$("label[for='lblCodigoClienteEmpresa']").text(data[0].codigo);
							$("#txtCodigoCliente").val(data[0].codigo);
						//////////////////////////////////////////////////////////////
						// Cambiar el accion a Actualizar REgistro
						////////////////////////////////////////////////////////////
						// Activar Nº de factura
							$("#goEditarClienteEmpresa").removeAttr("disabled");
							$("#txtNumeroFactura").removeAttr("disabled");
							alertify.success("Registro(s) Seleccionado.");
							$('#VentanaBuscarClienteEmpresa').modal('hide');
				}, "json");			
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#goEditarClienteEmpresa').on( 'click', function () {
				accion_cliente_buscar = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/CatalogoClientes.php", {accion_cliente_buscar: accion_cliente_buscar, id_: id_cliente},
				       function(data){
							// Cargar valores a los objetos
								$('#txtcodigo').val(data[0].codigo);
								$('#lstEstatus option[value='+data[0].codigo_estatus+']').attr('selected',true);
								$('#txtClienteEmpresa').val(data[0].cliente_empresa);
								$('#txtDireccion').val(data[0].direccion);
								$('#txtFechaCreacion').val(data[0].fecha_creacion);
								// Desabilitar Fecha Creación Proveedor.
									$("#txtFechaCreacion").prop("readonly",true);
								$('#txtNumeroRegistro').val(data[0].numero_registro);
								$('#txtGiro').val(data[0].giro);
								$('#txtDui').val(data[0].dui);
								$('#txtNit').val(data[0].nit);
								$('#txtTelefonoResidencia').val(data[0].telefono_residencia);
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
								// Cambiar el accion_cliente a Actualizar REgistro
								//////////////////////////////////////////////////////////////
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaClienteEmpresa').modal("show");
									alertify.success("Registro(s) listo para Editar.");
									accion_cliente = "ActualizarRegistro";	// variable global
				}, "json");	
});
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIoN DEL IDIOMA AL ESPAÑOL.
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