// id de user global
var id_ = 0;
var id_porcentaje = 0;
var accion_productos = 'noAccion';
var accion_porcentaje = 'noAccion';
var accion_unidad_medida = "noAccion";

var codigo_producto = "";
var codigo_categoria = "";
var codigo_unidad_medida = "";
var precio_compra = 0;
var precio_venta = 0;
var precio_venta_ajuste = 0;
var precio_venta_publico = 0;
var producto_exento = "";
var codigos_activos = 1;
$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// FUNCION QUE CARGA LA TABLA COMPLETA CON LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
		$(document).ready(function () {
			listar();
		});		
///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE LOS REGISTROS
///////////////////////////////////////////////////////////////////////////////
var listar = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos"; 
		// Tabla que contrendrá los registros.
			var table = $("#listadoProductos").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProductos.php",
					data: {"accion_productos_buscar": buscartodos, "codigos_activos": codigos_activos}
				},
				"deferRender": true,
				"columns":[
					{"data":"id_productos"},
                    {"data":"codigo_producto"},
					{"data":"codigo_barra"},
					{"data":"descripcion"},
                    {"data":"precio"},
                    {"data":"existencia"},
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
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
	  };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoProductos').on( 'click', 'a.imprimir', function () {
    id_ =$(this).parents('tr').find('td').eq(0).html();
    //enviar códigos de barra de un producto.
	// construir la variable con el url.
		varenviar = "/sistema_facturacion/php_libs/reportes/informe_catalogo_productos_codigo_barras_individual.php?id_="+id_;
    // Ejecutar la función
               AbrirVentana(varenviar);
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoUsers').on( 'click', 'a.remove', function () {
			id_ =$(this).parents('tr').find('td').eq(0).html();
			codigo_producto =$(this).parents('tr').find('td').eq(1).html();
			accion_productos = "EliminarRegistro";

});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoProductos').on( 'click', 'a.editar', function () {
				id_ =$(this).parents('tr').find('td').eq(0).html();
				accion_productos = "EditarRegistro";	// variable global
				
				$.post("php_libs/soporte/CatalogoProductos.php", {accion_productos_buscar: accion_productos, id_: id_},
				       function(data){
							// Cargar valores a los objetos
								$('#txtCodigoProducto').val(data[0].codigo_productos);
                                $('#lstCodigoCategoria option[value='+data[0].codigo_categoria+']').attr('selected',true);
								// REllenar el select Municipio con un Código específico 02 - Santa Ana.
								var miselectE=$("#lstCodigoEstatus");
								var codigo_estatus = data[0].codigo_estatus;
								/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
								miselectE.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
									
									$.post("includes/cargar_estatus.php", 
										function(data){
										miselectE.empty();
										for (var i=0; i<data.length; i++) {
											if(data[i].codigo == codigo_estatus)
											{
												miselectE.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');
											}else{	
											miselectE.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
											}
										}
									}, "json");	
								codigo_categoria = data[0].codigo_categoria;
								codigo_producto = data[0].codigo_productos;
								$('#txtCodigoCategoria').val(codigo_categoria);
								$('#txtCodigoBarra').val(data[0].codigo_barra);
								$('#txtDescripcionProducto').val(data[0].descripcion);
                                $('#txtPrecioVenta').val(data[0].precio_venta);
								$('#txtPrecioVentaAjuste').val(data[0].precio_ajuste);
                                $('#txtPrecioCosto').val(data[0].precio_costo);
                                //$('#txtComentario').val(data[0].comentario);
								$('#lstProductoExento option[value='+data[0].producto_exento+']').prop('selected',true);
                                $('#txtExistencia').val(data[0].existencia);
                                $('#txtExistenciaMinima').val(data[0].existencia_minima);
								$('#txtConvertirCantidad').val(data[0].convertir_cantidad);
								//
								// GENERAR O NO GENERAR CODIGO NUEVO PARA EL PRODUCTO.
								//
								$("#CambiarCodigoProducto").val("no");
								//////////////////////////////////////////////////////////////
								// Cambiar el accion a Actualizar REgistro
								//////////////////////////////////////////////////////////////
                                    alertify.success("Registro(s) listo para Editar.");
									accion_productos = "ActualizarRegistro";	// variable global
								//////abrir ventana modal////////////////////////////////////////////////////////
									$('#VentanaProductos').modal("show");
									$("#lstCodigoCategoria").attr("disabled",true);
										// Desabilitar boton Agregar Unidad de Medida.
									$("#goUnidadMedida").prop("disabled",false);
								// VOLVER A LLENAR LA TABLA DE PROEDUCTOS UNIDAD MEDIDA.
										$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
											function(data) {
												var miselect_u=$("#lstUnidadMedida");
												miselect_u.empty();
												for (var i=0; i<data.length; i++) {
															miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
												}
											}, "json");
                                    listarPorcentaje(); // Actualiza la tabla con los codigos de producto y categoria.
									
				}, "json");
				// VOLVER A LLENAR LA TABLA DE CATALOGO CATEGORIA.
						$.post("includes/cargar_catalogo_categoria.php",
							function(data) {
								var miselect=$("#lstCodigoCategoria");
								miselect.empty();
									miselect.append('<option value=000>Seleccionar...</option>');
								for (var i=0; i<data.length; i++) {
									if(codigo_categoria == data[i].codigo)
										{
											miselect.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');
										}
										else{
											miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
										}
								}
							}, "json");
						
});
///////////////////////////////////////////////////
// funcionalidad del botón que abre el formulario
///////////////////////////////////////////////////
$('#NuevoProducto').on('click',function(){
				// VOLVER A LLENAR LA TABLA DE CATALOGO CATEGORIA.
						$.post("includes/cargar_catalogo_categoria.php",
							function(data) {
								var miselect=$("#lstCodigoCategoria");
								miselect.empty();
									miselect.append('<option value=000>Seleccionar...</option>');
								for (var i=0; i<data.length; i++) {
										miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
								}
							}, "json");
	
		// Acción nuevo registro y variables default.
			codigo_categoria = $("#lstCodigoCategoria").val();
			$("#txtCodigoCategoria").val(codigo_categoria);
			$("#lstCodigoCategoria").prop("disabled",false);
		// Desabilitar boton Agregar Unidad de Medida.
			$("#goUnidadMedida").prop("disabled",true);
		// Abrimos el Formulario Modal y Rellenar For.
			$('#VentanaProductos').modal("show");
		// cambiar aacion_cliente para poder guardar el registro.
			accion_productos = "GuardarRegistro";
});
///////////////////////////////////////////////////
// funcionalidad del botón que abre el formulario
///////////////////////////////////////////////////
	    $("#VentanaProductos").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea
				$("#formProductos")[0].reset();
				accion_productos = "noAccion";
			//
			// GENERAR O NO GENERAR CODIGO NUEVO PARA EL PRODUCTO.
			//
				$("#CambiarCodigoProducto").val("si");
				listar();
		});
		///////////////////////////////////////////////////
		// FOCUS en la Ventana Modal Cliente/Empresa
		///////////////////////////////////////////////////
			$('#VentanaProductos').on('shown.bs.modal', function() {
			  $(this).find('[autofocus]').focus();
			});
///////////////////////////////////////////////////
// funcionalidad del botón que cerrar el formulario
///////////////////////////////////////////////////
	    $("#VentanaUnidadMedida").on('hidden.bs.modal', function () {
            // Limpiar variables Text, y textarea

				accion_unidad_medida = "noAccion";
		});			
///////////////////////////////////////////////////////////////////////////////
// BOTÓN GUARDAR. QUE ESTA DENTRO DEL FORM AGREGARUSER
///////////////////////////////////////////////////////////////////////////////	
		$('#formProductos').validate({
			rules:{
			        txtDescripcionProducto: {
						required: true,
						maxlength: 80
					},
					txtCodigoBarra:{
					   maxlength: 50
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
		        var str = $('#formProductos').serialize();
				//alert(str);

		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/CatalogoProductos.php",
		            data:str + "&accion_productos_buscar=" + accion_productos + "&id_=" + id_ + "&id=" + Math.random(),
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.mensaje == "Si Registro") {
                                    alertify.success("Registro(s) Guardado(s).");
									// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaProductos').modal("hide");
									listar();
                                }
                                
                                if (response.mensaje == "No Registro") {
                                    alertify.notify("Registro(s) No Guardado(s).");
									$('#VentanaProductos').modal("hide");
									listar();
                                }
                                if (response.mensaje == "Si Actualizado") {
                                    alertify.success("Registro(s) Actualizado(s).");
                                    // Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaProductos').modal("hide");
									listar();
                                }
								// Regresar al estado normal $accion
									accion_productos = 'GuardarRegistro';
						}
		        });
			}
		});		 

///////////////////////////////////////////////////////////////////////////////
//	FUNCION LISTAR BUSQUEDA DE REGISTROS TABLA PRODUCTO_PORCENTAJE_PRECIO_VENTA
///////////////////////////////////////////////////////////////////////////////
var listarPorcentaje = function(){
		// Varaible de Entorno para llamar a phpAjaxDatosFianzasPrestamos.php
			var buscartodos = "BuscarTodos";
            codigo_producto = $("#txtCodigoProducto").val();
            codigo_categoria = $("#lstCodigoCategoria").val();
            codigo_producto = codigo_categoria + codigo_producto;
		// Tabla que contrendrá los registros.
			var table = $("#listadoPorcentaje").dataTable({
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"destroy": true,
                "searching": false,
                "paging": false, 
                "info": false,
				"order": [[1, "asc"]],
				"ajax":{
					method:"POST",
					url:"php_libs/soporte/CatalogoProductoPorcentaje.php",
					data: {"accion_porcentaje_buscar": buscartodos, "codigo_producto":codigo_producto}
				},
				"columns":[
					{"data":"id_pro_por_precio_venta"},
					{"data":"codigo"},
                    {"data":"descripcion"},
                    {"data":"porcentaje"},
                    {"data":"precio_venta"},
					{"data":"precio_ajuste"},
					{"data":"precio"},
					{
						data: null,
						defaultContent: '<a href="#" class="editarAjuste btn btn-info" data-toggle="tooltip" data-placement="right" title="Editar"> <span class="fa fa-edit"></span>',
						orderable: false
					},
					{
                        data: null,
						defaultContent: '<a href="#" class="removePorcentaje btn btn-warning" data-toggle="modal" data-target="#VentanaEliminarPorcentaje" data-toggle="tooltip" data-placement="right" title="Anular"> <span class="fa fa-trash"></span></a>',
						orderable: false
					},
				],
				// LLama a los diferentes mensajes que están en español.
				"language": idioma_espanol
		});
		// BUSCAR EL PRECIO POR EL VALOR DEL PORCENTAJE CODIGO = 01 o CODIGO = 02
			accion_porcentaje = "BuscarPorcentaje01";
			$.post("php_libs/soporte/CatalogoProductoPorcentaje.php", {accion_porcentaje_buscar: accion_porcentaje, codigo_producto: codigo_producto},
				       function(data){
							// Validar
							if(data[0].no_registros == "no_registros"){
								var valor = 0;
								$('#txtPrecioVenta').val(valor);
								$('#txtPrecioVentaAjuste').val(valor);									
							}else{
								precio_venta = parseFloat(data[0].precio_venta);
								precio_ajuste = parseFloat(data[0].precio_ajuste);
								precio_venta_publico = precio_venta + precio_ajuste;
								
								$('#txtPrecioVenta').val(data[0].precio_venta);
								$('#txtPrecioVentaAjuste').val(data[0].precio_ajuste);
								$('#txtPrecioVentaPublico').val(precio_venta_publico);
								}
				}, "json");
	  };
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoPorcentaje').on( 'click', 'a.removePorcentaje', function () {
			id_porcentaje =$(this).parents('tr').find('td').eq(0).html();
			accion_porcentaje = "EliminarPorcentaje";
            codigo_producto = $('#lstCodigoCategoria').val() + $('#txtCodigoProducto').val();
            precio_compra = $('#txtPrecioCosto').val();
			producto_exento = $('#lstProductoExento').val();
		// Abrimos el Formulario Modal y Rellenar For.
			$('#VentanaEliminarPorcentaje').modal("show");
});
///////////////////////////////////////////////////////////////////////////////
//	FUNCION que al dar clic buscar el registro para posterior mente abri una
// ventana modal. EDITAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$('#listadoPorcentaje').on( 'click', 'a.editarAjuste', function () {
				id_porcentaje =$(this).parents('tr').find('td').eq(0).html();
				accion_porcentaje = "EditarPorcentaje";
				//$('#accion').val(accion);	// input text hidden
				$.post("php_libs/soporte/CatalogoProductoPorcentaje.php", {accion_porcentaje_buscar: accion_porcentaje, id_: id_porcentaje},
				       function(data){
							// Cargar valores a los objetos
								$('#txtPrecioVentaAjusteModificar').val(data[0].precio_ajuste);
								//////////////////////////////////////////////////////////////
								// Cambiar el accion a Actualizar REgistro
								//////////////////////////////////////////////////////////////
                                    alertify.success("Registro(s) listo para Editar.");
									accion_porcentaje = "ActualizarPorcentaje";	// variable global
								// Abrimos el Formulario Modal y Rellenar For.
									$('#VentanaModificarAjuste').modal("show");
				}, "json");
});

///////////////////////////////////////////////////
// funcionalidad del botón que guarde el porcentaje del articulo.
///////////////////////////////////////////////////
$('#goPorcentajeGuardar').on('click',function(){
			// Asignamos valor a la variable acción y asignar valor a accion
			accion_porcentaje = "GuardarPorcentaje";
            codigo_categoria = $("#lstCodigoCategoria").val();
            codigo_producto = $("#txtCodigoProducto").val();
            codigo_porcentaje = $("#lstPorcentajeVenta").val();
            precio_compra = $('#txtPrecioCosto').val();
			producto_exento = $('#lstProductoExento').val();
            
			// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoProductoPorcentaje.php", {accion_porcentaje_buscar: accion_porcentaje, precio_compra: precio_compra, codigo_categoria: codigo_categoria, codigo_producto: codigo_producto, codigo_porcentaje: codigo_porcentaje, producto_exento: producto_exento},
				       function(response){
						// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                alertify.success("Registro(s) Guardado.");
								listarPorcentaje();
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.notify("Registro(s) No Guardado.");
                           }
                           if (response.mensaje == "No Porcentaje") {
                                alertify.notify("Porcentaje Ya Ingresado.");
                           }						   
				}, "json");
});
///////////////////////////////////////////////////
// funcionalidad del botón que guarde el porcentaje del articulo.
///////////////////////////////////////////////////
		$('#goActualizarAjuste').on('click',function(){
            precio_ajuste = $("#txtPrecioVentaAjusteModificar").val();
			producto_exento = $('#lstProductoExento').val();
            
			// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoProductoPorcentaje.php", {accion_porcentaje_buscar: accion_porcentaje, precio_ajuste: precio_ajuste, id_porcentaje: id_porcentaje, producto_exento: producto_exento},
				       function(response){
			// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                alertify.success("Registro(s) Actualizado.");
								listarPorcentaje();
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.notify("Registro(s) No Actualizado.");
                           }
							// Abrimos el Formulario Modal y Rellenar For.
								$('#VentanaModificarAjuste').modal("hide");
				}, "json");
		});
///////////////////////////////////////////////////////////////////////////////
//	BOTON. ELIMINAR REGISTRO
///////////////////////////////////////////////////////////////////////////////	  
$("#BotonEliminarPorcentaje").on('click', function(){
	// proceso para eliminar el registro cargar variables públicas.
				// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoProductoPorcentaje.php", {accion_porcentaje_buscar: accion_porcentaje, codigo_producto: codigo_producto, precio_compra: precio_compra, id_porcentaje: id_porcentaje, producto_exento: producto_exento},
				       function(response){
			// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                alertify.success("Registro(s) Actualizado.");
								listarPorcentaje();
                           }                                                
                           if (response.mensaje == "No Registro") {
                                alertify.notify("Registro(s) No Actualizado.");
                           }
							// Abrimos el Formulario Modal y Rellenar For.
								$('#VentanaEliminarPorcentaje').modal("hide");
				}, "json");
});
///////////////////////////////////////////////////////////////////////////////
// VENTANA PRODUCTO UNIDAD MEDIDA
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////
// funcionalidad del botón que guarde el porcentaje del articulo.
///////////////////////////////////////////////////
		$('#goUnidadMedida').on('click',function(){           
			// CARGAR CATALOGO UNIDAD MEDIDA.
			$.post("includes/cargar_catalogo_unidad_medida.php",
				       function(data){
							var miselect_cat=$("#lstCatUnidadMedida");
								miselect_cat.empty();
								for (var i=0; i<data.length; i++) {
									if(data[i].codigo == '01'){
										miselect_cat.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
									}else{
										miselect_cat.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
									}
								}
							// Abrimos el Formulario Modal y Rellenar For.
								$('#VentanaUnidadMedida').modal("show");
				}, "json");
			// VOLVER A LLENAR LA TABLA DE PROEDUCTOS UNIDAD MEDIDA.
				codigo_categoria = $("#lstCodigoCategoria").val();
				codigo_producto = $("#txtCodigoProducto").val();
				$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
					function(data) {
						var miselect_u=$("#lstProUnidadMedida");
						miselect_u.empty();
							for (var i=0; i<data.length; i++) {
									if(data[i].codigo == '01'){
										miselect_u.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
									}else{
										miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
									}
							}
				}, "json");
		});
///////////////////////////////////////////////////
// funcionalidad del botón que guarda la unidad de medida
///////////////////////////////////////////////////
		$('#goAgregarUnidadMedida').on('click',function(){           
			// CARGAR CATALOGO UNIDAD MEDIDA.
			codigo_unidad_medida = $('select[name=lstCatalogoUnidadMedida]').val();
			accion_unidad_medida = "GuardarRegistro";
						// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoUnidadMedida.php", {accion_unidad_medida: accion_unidad_medida, codigo_unidad_medida: codigo_unidad_medida, codigo_producto: codigo_producto, codigo_categoria: codigo_categoria},
				       function(response){
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                				$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
													function(data) {
														var miselect_u=$("#lstProUnidadMedida");
														var miselect_=$("#lstUnidadMedida");
														miselect_u.empty(); miselect_.empty();
														// rellenar el del select multiple
															for (var i=0; i<data.length; i++) {
																	if(data[i].codigo == '01'){
																		miselect_u.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
																	}else{
																		miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
																	}
															}
														// rellenar el del select del catalogo productos.
															for (var j=0; j<data.length; j++) {
																		miselect_.append('<option value="' + data[j].codigo + '">' + data[j].descripcion + '</option>');	
															}
												}, "json");
                           }                                                
                           if (response.mensaje == "Ya Existe") {
                                alertify.notify("Registro(s) Ya existe.");
                           }
						    if (response.mensaje == "No Seleccionado") {
                                alertify.notify("Unidad de Medida No Seleccionada");
                           }
				}, "json");
		});
///////////////////////////////////////////////////
// funcionalidad del botón que guarda la unidad de medida
///////////////////////////////////////////////////
		$('#goAgregarUnidadMedida').on('click',function(){           
			// CARGAR CATALOGO UNIDAD MEDIDA.
			codigo_unidad_medida = $('select[name=lstCatalogoUnidadMedida]').val();
			accion_unidad_medida = "GuardarRegistro";
						// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoUnidadMedida.php", {accion_unidad_medida: accion_unidad_medida, codigo_unidad_medida: codigo_unidad_medida, codigo_producto: codigo_producto, codigo_categoria: codigo_categoria},
				       function(response){
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                				$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
													function(data) {
														var miselect_u=$("#lstProUnidadMedida");
														var miselect_=$("#lstUnidadMedida");
														miselect_u.empty(); miselect_.empty();
														// rellenar el del select multiple
															for (var i=0; i<data.length; i++) {
																	if(data[i].codigo == '01'){
																		miselect_u.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
																	}else{
																		miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
																	}
															}
														// rellenar el del select del catalogo productos.
															for (var j=0; j<data.length; j++) {
																		miselect_.append('<option value="' + data[j].codigo + '">' + data[j].descripcion + '</option>');	
															}
												}, "json");
                           }                                                
                           if (response.mensaje == "Ya Existe") {
                                alertify.notify("Registro(s) Ya existe.");
                           }
						    if (response.mensaje == "No Seleccionado") {
                                alertify.notify("Unidad de Medida No Seleccionada");
                           }
				}, "json");
		});
		///////////////////////////////////////////////////
// funcionalidad del botón que guarda la unidad de medida
///////////////////////////////////////////////////
		$('#goAgregarUnidadMedida').on('click',function(){           
			// CARGAR CATALOGO UNIDAD MEDIDA.
			codigo_unidad_medida = $('select[name=lstCatalogoUnidadMedida]').val();
			accion_unidad_medida = "GuardarRegistro";
						// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoUnidadMedida.php", {accion_unidad_medida: accion_unidad_medida, codigo_unidad_medida: codigo_unidad_medida, codigo_producto: codigo_producto, codigo_categoria: codigo_categoria},
				       function(response){
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                				$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
													function(data) {
														var miselect_u=$("#lstProUnidadMedida");
														var miselect_=$("#lstUnidadMedida");
														miselect_u.empty(); miselect_.empty();
														// rellenar el del select multiple
															for (var i=0; i<data.length; i++) {
																	if(data[i].codigo == '01'){
																		miselect_u.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
																	}else{
																		miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
																	}
															}
														// rellenar el del select del catalogo productos.
															for (var j=0; j<data.length; j++) {
																		miselect_.append('<option value="' + data[j].codigo + '">' + data[j].descripcion + '</option>');	
															}
												}, "json");
                           }                                                
                           if (response.mensaje == "Ya Existe") {
                                alertify.notify("Registro(s) Ya existe.");
                           }
						    if (response.mensaje == "No Seleccionado") {
                                alertify.notify("Unidad de Medida No Seleccionada");
                           }
				}, "json");
		});
		///////////////////////////////////////////////////
// funcionalidad del botón que guarda la unidad de medida
///////////////////////////////////////////////////
		$('#goQuitarUnidadMedida').on('click',function(){           
			// CARGAR CATALOGO UNIDAD MEDIDA.
			codigo_unidad_medida = $('select[name=lstProductoUnidadMedida]').val();
			accion_unidad_medida = "EliminarRegistro";
						// Generar el Código Nuevo.
			$.post("php_libs/soporte/CatalogoUnidadMedida.php", {accion_unidad_medida: accion_unidad_medida, codigo_unidad_medida: codigo_unidad_medida, codigo_producto: codigo_producto, codigo_categoria: codigo_categoria},
				       function(response){
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Eliminado") {
                                				$.post("includes/cargar_unidad_medida.php", {codigo_categoria: codigo_categoria, codigo_producto: codigo_producto},
													function(data) {
														var miselect_u=$("#lstProUnidadMedida");
														var miselect_=$("#lstUnidadMedida");
														miselect_u.empty(); miselect_.empty();
														// rellenar el del select multiple
															for (var i=0; i<data.length; i++) {
																	if(data[i].codigo == '01'){
																		miselect_u.append('<option value="' + data[i].codigo + '" disabled>' + data[i].descripcion + '</option>');	
																	}else{
																		miselect_u.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');	
																	}
															}
														// rellenar el del select del catalogo productos.
															for (var j=0; j<data.length; j++) {
																		miselect_.append('<option value="' + data[j].codigo + '">' + data[j].descripcion + '</option>');	
															}
												}, "json");
                           }                                                
						    if (response.mensaje == "No Seleccionado") {
                                alertify.notify("Unidad de Medida No Seleccionada");
                           }
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
			"sLoadingRecords": "No se encontraron resultados",
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
        field.value = field.value.toUpperCase()
   }
   
   function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}