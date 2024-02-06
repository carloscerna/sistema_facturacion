// id de user global
var idUser = 0;
var id_ = 0;
var accion = 'noAccion';
numero_factura = 0;
codigo_proveedor = "";
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
		$(document).on("ready", function(){
			listar();
		});		
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listar = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
		// Tabla que contrendrá los registros.
			var table = $("#listadoCompras").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/FacturasCompras.php",
					data: {"accion_buscar": buscartodos}
				},
				"deferRender": true,
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    /* Append the grade to the default row class name */
                    if ( aData[4] == "01" )
                    {
                        $('td:eq(6)', nRow).html( 'Pagada' );
                        $('td:eq(6)', nRow).addClass('pagada');
                    }
                    if ( aData[4] == "02" )
                    {
                        $('td:eq(6)', nRow).html( 'Pendiente' );
                        $('td:eq(6)', nRow).addClass('pendiente');
                    }

                },
				"columns":[
					{"data":"id_compras"},
					{"data":"fecha"},
					{"data":"numero_factura"},
					{"data":"codigo_proveedor"},
					{"data":"nombre_completo"},
					{"data":"total_compra"},
                    {"data":"estado_factura"},
					{
						data: null,
						defaultContent: '<a href="#" class="editar btn btn-info" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="oi oi-pencil"></span>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="remove btn btn-warning" data-toggle="modal" data-target="#VentanaEliminar" data-toggle="tooltip" data-placement="right" title="Anular"> <span class="oi oi-delete"></span></a>',
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
$('#listadoCompras').on( 'click', 'a.remove', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
			numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_proveedor =$(this).parents('tr').find('td').eq(3).html();
			idUser = id_;
			accion = "EliminarRegistro";
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCompras').on( 'click', 'a.ver', function () {
				id_ =$(this).parents('tr').find('td').eq(0).html();
				numero_factura =$(this).parents('tr').find('td').eq(2).html();
				codigo_proveedor =$(this).parents('tr').find('td').eq(3).html();
				idUser = id_;
				accion = "VerRegistro";	// variable global
				$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/FacturasCompras.php", {accion: accion, numero_factura: numero_factura, codigo_proveedor: codigo_proveedor},
				       function(response){
		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		//alert(response.mensaje);
							$('#listaFacturaDetalle').empty();
							$('#listaFacturaDetalle').append(response.contenido);
		            	}
		            	else{
		            		// si es exitosa la operación
		                	$('#listaFacturaDetalle').empty();
		                	$('#listaFacturaDetalle').append(response.contenido);
				}
				}, "json");

});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoCompras').on( 'click', 'a.editar', function () {
				id_ =$(this).parents('tr').find('td').eq(0).html();
				idUser = id_;
				accion = "EditarRegistro";	// variable global
				$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/FacturasCompras.php", {accion: accion, id_: id_},
				       function(data){
							// Cargar valores a los objetos
								$('#id_user').val(data[0].id_compras);
								$('#txtFecha').val(data[0].fecha);
                                $('#txtNumeroFactura').val(data[0].numero_factura);
								
								//////////////////////////////////////////////////////////////
								// Cambiar el accion a Actualizar REgistro
								//////////////////////////////////////////////////////////////
                                    alertify.log("Registro(s) listo para Editar.");
									accion = "ActualizarRegistro";	// variable global
									$('#accion').val(accion);	// input text hidden
									$('#id_user').val(id_);	// input text hidden
				}, "json");
			// Abrimos el Formulario Modal
				$('#ModificarCompras').dialog({
					title:'Actualizar Registro... ' + id_,
					autoOpen:true
				});			
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