var cambiar_codigo_producto = "";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// INPUT MASK U OTROS.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        					
								$(document).ready( function () {
						       // Jquery-mask - entrado de datos.
										$("#txtPrecioCosto").inputmask("decimal",{
											radixPoint:".",
											groupSeparator:",",
											digits:5,
											prefix:"$",
											autoGroup: true
										});
										$("#txtPrecioVenta").inputmask("decimal",{
											radixPoint:".",
											groupSeparator:",",
											digits:5,
											prefix:"$",
											autoGroup: true
										});
										$("#txtPrecioVentaPublico").inputmask("decimal",{
											radixPoint:".",
											groupSeparator:",",
											digits:5,
											prefix:"$",
											autoGroup: true
										});
										$("#txtPrecioVentaAjuste").inputmask("decimal",{
											radixPoint:".",
											groupSeparator:",",
											digits:5,
											prefix:"$",
											autoGroup: true
										});
										$("#txtPrecioVentaAjusteModificar").inputmask("decimal",{
											radixPoint:".",
											groupSeparator:",",
											digits:5,
											prefix:"$",
											autoGroup: true
										});
								});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// CARGAR INFORMACIÓN DE LAS TABLAS PARA LOS SELECT
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
	$(document).ready(function()
	{
			var miselect=$("#lstCodigoCategoria");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_catalogo_categoria.php",
				function(data) {
					miselect.empty();
					miselect.append('<option value="000" selected>Seleccionar...</option>');
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});
	// Carga la INformación de Tabla Codigo Categoria
	$(document).ready(function()
	{
		// Parametros para el lstmuncipio.
                $("#lstCodigoCategoria").change(function () {
								/////////////////////////////////////////////////////////////////////////////////////////////////
								// GENERAR O NO GENERAR CODIGO NUEVO PARA EL PRODUCTO.
								/////////////////////////////////////////////////////////////////////////////////////////////////
								cambiar_codigo_producto = $("#CambiarCodigoProducto").val();
								if(cambiar_codigo_producto == "si")
								{
										$("#lstCodigoCategoria option:selected").each(function () {
												  accion_productos_buscar = "GenerarCodigoNuevo";
												  codigo_categoria=$(this).val();
												  // Generar el Código Nuevo.
												  $.post("php_libs/soporte/CatalogoProductos.php", {accion_productos_buscar: accion_productos_buscar, codigo_categoria: codigo_categoria},
													function(data){
													// Información de la Tabla Datos Personal.
														$("#txtCodigoCategoria").val(codigo_categoria);
														$("#txtCodigoProducto").val(data[0].codigo_nuevo);
													}, "json");		
										});
								}else{
										$("#lstCodigoCategoria option:selected").each(function () {
											  codigo_categoria=$(this).val();
												$("#txtCodigoCategoria").val(codigo_categoria);
										});									
								}
                });
	});        
///////////////////////////////////////////////////////////
// ttabla porcentaje venta.
////////////////////////////////////////////////////////////
	$(document).ready(function()
	{
			var miselect=$("#lstPorcentajeVenta");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_catalogo_porcentaje_venta.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + ' -->  ' + data[i].porcentaje + ' % ' + '</option>');
					}
			}, "json");
	});
///////////////////////////////////////////////////////////
// ttabla porcentaje venta.
////////////////////////////////////////////////////////////
	$(document).ready(function()
	{
			var miselect=$("#lstCodigoEstatus");
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