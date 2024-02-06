// id de user global
var id_ = 0;
var id_proveedor = 0;
var accion_proveedor_buscar = 'noAccion';
var ann = ""; 	// variable que manejara el año, para generar un nuevo codigo.
                
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#goBuscarProveedor').on('click',function(){
		$('#VentanaBuscarProveedor').modal("show");	
            listarBuscarProveedores();
        });
        $('#BotonBuscarProveedor').on('click',function(){
		$('#VentanaBuscarProveedor').modal("show");	
            listarBuscarProveedores();
        });
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
        $('#goInformacionProveedor').on('click',function(){

        }); 		
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listarBuscarProveedores = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarProveedor";
		// Tabla que contrendrá los registros.
			var table = $("#listadoBuscarProveedor").dataTable({
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
$('#listadoBuscarProveedor').on( 'click', 'a.seleccionar', function () {
				id_proveedor =$(this).parents('tr').find('td').eq(0).html();
				accion_proveedor_buscar = "EditarRegistro";	// variable global
				$.post("php_libs/soporte/CatalogoProveedores.php", {accion_proveedor_buscar: accion_proveedor_buscar, id_: id_proveedor},
				       function(data){
							$("span[for='txtNombreProveedor']").text(data[0].nombre_empresa);
							$("label[for='lblCodigoProveedor']").text(data[0].codigo);
							$("#txtCodigoProveedorCompras").val(data[0].codigo);
							// Cargar valores a los objetos
								/*$('#txtCodigoProveedorCompras').val(data[0].codigo);
								$('#txtProveedor').val(data[0].nombre_empresa + ' ' +  data[0].nombre);
								$('#txtDireccion').val(data[0].direccion);

								$('#txtNumeroRegistro').val(data[0].numero_registro);
								$('#txtGiro').val(data[0].giro);
								$('#txtDui').val(data[0].dui);
								$('#txtNit').val(data[0].nit);
								
								$('#lstDepartamentoFactura option[value='+data[0].codigo_departamento+']').attr('selected',true);
                                                                          /// Seleccionar municipio en base al departamento guardado.
                                                var miselect=$("#lstMunicipioFactura");
                                                var codigo_municipio = data[0].codigo_municipio;
								/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... 
										miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
                                                                departamento=$("#lstDepartamentoFactura").val();
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
                                                                 
                                     $('#lstMunicipio option[value='+data[0].codigo_municipio+']').attr('selected',true);																*/
						//////////////////////////////////////////////////////////////
						// Cambiar el accion a Actualizar REgistro
						/////////////////////////////////////////////////////////////
						// Activar Nº de factura
							$("#txtNumeroFactura").removeAttr("disabled");
							$("#txtNumeroFactura").focus();
			                        alertify.success("Registro(s) Seleccionado.");
							$('#VentanaBuscarProveedor').modal('hide');
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