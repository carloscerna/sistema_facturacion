// id de user global
var id_ = 0;
var accion = 'noAccion';
var numero_factura = "";
var codigo_tipo_factura = "";
var cliente_empresa = "";
var fecha_nueva_factura = "";

$(document).ready( function () {
 //////////////////////////////////////////////////////////////////////////////
// CONFIGURACIÓND E LA FECHA, Y PASAR A CIERTOS OBJETOS.
///////////////////////////////////////////////////////////////////////////////
                var now = new Date();            
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                ann = now.getFullYear();
                var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
				$('#txtFecha').val(today);
                $('#txtFechaNueva').val(today);
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
			var table = $("#listadoVentas").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"reponsive": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/FacturasVentas.php",
					data: {"accion_buscar": buscartodos}
				},
				"deferRender": true,
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    /* cambiar de color a la palabra de la columna */
                    if ( aData[5] == "01" )
                    {
                        $('td:eq(6)', nRow).html( 'Pagada' );
                        $('td:eq(6)', nRow).addClass('pagada');
                    }
                    if ( aData[5] == "02" )
                    {
                        $('td:eq(6)', nRow).html( 'Pendiente' );
                        $('td:eq(6)', nRow).addClass('pendiente');
                    }
                    /* cambiar de color a la palabra de la columna */
                    if ( aData[3] == "02" )
                    {
                        $('td:eq(3)', nRow).addClass('ccf');
                    }
                },
				"columns":[
					{"data":"id_ventas"},
					{"data":"fecha"},
                    {"data":"numero_factura_completo"},
					{"data":"c_tipo_f"},
					{"data":"cliente_empresa"},
					{"data":"total_venta"},
                    {"data":"estado_factura"},
					{
						data: null,
						defaultContent: '<a href="#" class="editar btn btn-info" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="fa fa-edit"></span>',
						orderable: false
					},
                    {
						data: null,
						defaultContent: '<a href="#" class="imprimir btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Imprimir"><span class="fa fa-print"></span></a>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="remove btn btn-warning" data-toggle="modal" data-target="#VentanaEliminar" data-toggle="tooltip" data-placement="right" title="Anular"> <span class="fa fa-trash"></span></a>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="hoja btn btn-success">Hoja <span class="fa fa-share"></a>',
						orderable: false
					},	                                                                                                                                                
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
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
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoVentas').on( 'click', 'a.imprimir', function () {
	id_ =$(this).parents('tr').find('td').eq(0).html();
    numero_factura =$(this).parents('tr').find('td').eq(2).html();
	codigo_tipo_factura =$(this).parents('tr').find('td').eq(3).html();
	
    fecha = $("#txtFechaNueva").val();
    accion = "ImprimirFacturaVentas";
                    // Valir el checbox
                  if($("#cambiar_fecha").is(':checked')) {  
                      //  alert("Está activado");
                        valor = 1;
                    } else {  
                       // alert("No está activado");
                        valor = 0;
                    } 
                    // Valir el checbox
                  if($("#no_fecha").is(':checked')) {  
                      //  alert("Está activado");
                        valor_no_fecha = 1;
                    } else {  
                       // alert("No está activado");
                        valor_no_fecha = 0;
                    } 
    // CATPURAR EL CODIGO TIPO FACTURA.
     $.ajax({
               cache: false,
                type: "POST",
	dataType: "json",
	url:"php_libs/soporte/FacturasVentas.php",
	data:"&accion=" + accion + "&id_=" + id_ + "&id=" + Math.random(),
	success: function(data){
                               // Si el valor es 01 PARA CARGAR LA FACTURA CONSUMIDOR FINAL.
                                if (data[0].codigo_tipo_factura == "01") {
                                   // construir la variable con el url.
                                      varenviar = "/sistema_facturacion/php_libs/reportes/factura_consumidor_final.php?numero_factura="+numero_factura+"&fecha_nueva="+fecha+"&cambiar_fecha="+valor+"&no_fecha="+valor_no_fecha;
                                   // Ejecutar la función
                                      AbrirVentana(varenviar);
                                }
                               // Si el valor 02 PARA CARGAR LA FACTURA CREDITO FISCAL.
                                if (data[0].codigo_tipo_factura == "02") {
                                   // construir la variable con el url.
                                      varenviar = "/sistema_facturacion/php_libs/reportes/factura_credito_fiscal.php?numero_factura="+numero_factura+"&fecha_nueva="+fecha+"&cambiar_fecha="+valor+"&no_fecha="+valor_no_fecha;
                                   // Ejecutar la función
                                      AbrirVentana(varenviar);
                                }
                      }
	});
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. CREAR HOJA DE CALCULO CON EL DETALLE DE LA FACTURA
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoVentas').on( 'click', 'a.hoja', function () {
	id_ =$(this).parents('tr').find('td').eq(0).html();
    numero_factura =$(this).parents('tr').find('td').eq(2).html();
	codigo_tipo_factura =$(this).parents('tr').find('td').eq(3).html();
	
    fecha = $("#txtFechaNueva").val();
    accion = "CrearFacturasVentas";
    // Valir el checbox
       if($("#cambiar_fecha").is(':checked')) {             
           //  alert("Está activado");           
             valor = 1;           
         } else {             
            // alert("No está activado");           
             valor = 0;           
         }            
    // CATPURAR EL CODIGO TIPO FACTURA.
       $.ajax({                 
              cache: false,                 
              type: "POST",                          
              dataType: "json",                          
              url:"php_libs/soporte/CrearFacturasVentas.php",                          
              data: "id_=" + id_ + "&numero_factura=" + numero_factura + "&codigo_tipo_factura=" + codigo_tipo_factura + "&id=" + Math.random() +"&fecha_nueva="+fecha+"&cambiar_fecha="+valor,                          
              success: function(response){                          
                  // Validar mensaje de error                          
                  if(response.respuesta === false){                          
                          alertify.log("Archivo no creado.");                          
                  }                          
                  else{                          
                        alertify.success("Archivo Creado.");}                          
              },                          
              error:function(){                          
                  alertify.log("Archivo no creado.");                          
              }                          
          });                          
	 });
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoVentas').on( 'click', 'a.remove', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
            numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_tipo_factura =$(this).parents('tr').find('td').eq(3).html();
			cliente_empresa =$(this).parents('tr').find('td').eq(4).html();
			// Acción a Ejecutar
			accion = "EliminarRegistro";
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaEliminar').modal("show");
				$("span[for='NumeroFactura']").text(numero_factura);
				$("span[for='TipoFactura']").text(codigo_tipo_factura);
				$("span[for='ClienteEmpresa']").text(cliente_empresa);
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
                    url:"php_libs/soporte/FacturasVentas.php",
		            data:"accion="+ accion  + "&codigo_tipo_factura=" + codigo_tipo_factura  + "&id_=" + id_ + "&numero_factura=" + numero_factura + "&id=" + Math.random(),
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
	accion = ""; numero_factura = ""; codigo_tipo_factura = ""; cliente_empresa = "";
	$('#VentanaEliminar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoVentas').on( 'click', 'a.editar', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
            numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_tipo_factura =$(this).parents('tr').find('td').eq(3).html();
			cliente_empresa =$(this).parents('tr').find('td').eq(4).html();
			// Acción a Ejecutar
			accion = "EditarRegistro";	// variable global
			// Abrimos el Formulario Modal y Rellenar For.
				$('#VentanaModificar').modal("show");
				$("span[for='NumeroFactura']").text(numero_factura);
				$("span[for='TipoFactura']").text(codigo_tipo_factura);
				$("span[for='ClienteEmpresa']").text(cliente_empresa);
				
				$.post("php_libs/soporte/FacturasVentas.php", {accion: accion, id_: id_},
				       function(data){
							// Cargar valores a los objetos
								$('#txtFecha').val(data[0].fecha);
								//////////////////////////////////////////////////////////////
								// Cambiar el accion a Actualizar REgistro
								//////////////////////////////////////////////////////////////
                                    alertify.success("Registro(s) listo para Editar.");
									accion = "ActualizarRegistro";	// variable global
				}, "json");
					// Cerrar el Formulario Modal y reinicar variables.
					accion = ""; numero_factura = ""; codigo_tipo_factura = ""; cliente_empresa = "";
					$('#VentanaModificar').modal("hide");	
});
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonActualizarRegistro").on('click', function(){
	// Actuliar la nueva fecha.
	fecha_nueva_factura = $("#txtFecha").val();
				$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"php_libs/soporte/FacturasVentas.php",
		            data:"accion="+ accion  + "&id_=" + id_ + "&fecha=" + fecha_nueva_factura + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                alertify.success("Registro(s) Actualizado(s).");
								$('#VentanaModificar').modal("hide");
								// Cerrar el Formulario Modal y reinicar variables.
								accion = ""; numero_factura = ""; codigo_tipo_factura = ""; cliente_empresa = ""; fecha_nueva_factura = "";
								listar();
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.error("Registro(s) No Actualizado(s). Fecha Incorrecta");
                           }
		            },
		            error:function(){
		                alert('Error, ejecución de la consulta');
		            }
		        });		
});	
		
}); // Cierre princial de la función document.
///////////////////////////////////////////////////////////
// ABRE VEMTANA PARA LOS FACTURAS.
////////////////////////////////////////////////////////////
function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}