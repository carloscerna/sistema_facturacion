$(document).ready(function () {
///////////////////////////////////////////////////////////////////////////////
// CONFIGURACIÓND E LA FECHA, Y PASAR A CIERTOS OBJETOS.
///////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
	listar_ann(year);
});
                var now = new Date();
                
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                ann = now.getFullYear();
                var year = now.getFullYear();
                var today = (day)+"/"+(month)+"/"+now.getFullYear() ;
				var mesYanno = (month)+"/"+now.getFullYear() ;
                // 
				$('#txtFechaVentas').val(today);
				$('#txtFechaInicio').val(today);
				$('#txtFechaFin').val(today);
				$('#txtFechaInicioDetalle').val(today);
				$('#txtFechaFinDetalle').val(today);
				$('#txtFechaComprasVentas').val(mesYanno);				
				
				$("#txtFechaVentas").datetimepicker({
					format: 'DD/MM/YYYY'
				});
				$("#txtFechaInicio").datetimepicker({
					format: 'DD/MM/YYYY'
				});
				$("#txtFechaFin").datetimepicker({
					format: 'DD/MM/YYYY'
				});
				$("#txtFechaInicioDetalle").datetimepicker({
					format: 'DD/MM/YYYY'
				});
				$("#txtFechaFinDetalle").datetimepicker({
					format: 'DD/MM/YYYY'
				});

				$("#txtFechaComprasVentas").datetimepicker({
					format: 'MM/YYYY'
				});
///////////////////////////////////////////////////////////////////////////////
// LLAMAR AL REPORTE QUE VA MOSTRAR LOS CONSOLIDADOS DE LA VENTA DIARIA
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
$('#formVentasRD').validate({
			rules:{
					txtFechaVentas:{
					   required: true,
					   maxlength: 10,
					   minlength: 10
					},
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
		        var str = $('#formVentasRD').serialize();
				fecha = $("#txtFechaVentas").val();
				
		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/BuscarFechaResumenDiario.php",
		            data: str + "&fecha="+fecha + "&accion_fecha_buscar=BuscarFechas",
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.respuesta == true) {
									if (response.mensaje == "Si Registro") {
											fecha = $("#txtFechaVentas").val();
										// construir la variable con el url.
											varenviar = "/sistema_facturacion/php_libs/reportes/ventas_resumen_diario.php?fecha="+fecha+"&accion_fecha_buscar=MostrarResumen";
										// Ejecutar la función
											AbrirVentana(varenviar);
									}
                                }
                                
                                if (response.respuesta == false) {
                                    toastr.info("No se encontraron Ventas.");
                                }
						}
		        });
			}
});
///////////////////////////////////////////////////////////////////////////////
// LLAMAR AL REPORTE QUE VA MOSTRAR EL INVENTARIO.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////	  
$('#goCrearCodigosBarra').on( 'click', function () {
			$.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/BuscarFechaResumenDiario.php",
		            data: "accion_fecha_buscar=BuscarCodigosBarra",
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.respuesta == true) {
									if (response.mensaje == "Si Registro") {
											fecha = $("#txtFechaVentas").val();
										// construir la variable con el url.
											varenviar = "/sistema_facturacion/php_libs/reportes/CrearCodigosBarra.php?";
										// Ejecutar la función
											AbrirVentana(varenviar);
									}
                                }
                                
                                if (response.respuesta == false) {
                                    toastr.error("No se encontraron Registros.");
                                }
						}
		        });
}); // Cierre princial de la función document.
///////////////////////////////////////////////////////////////////////////////
// LLAMAR AL REPORTE QUE VA MOSTRAR EL INVENTARIO.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////	  
$('#goBuscarInventario').on( 'click', function () {
	fecha_inicio = $("#txtFechaInicio").val();
	fecha_fin = $("#txtFechaFin").val();
	                    // Valir el checbox
                  if($("#actualizar_existencia").is(':checked')) {  
                      //  alert("Está activado");
                        valor = 1;
                    } else {  
                       // alert("No está activado");
                        valor = 0;
                    } 
// construir la variable con el url.
    varenviar = "/sistema_facturacion/php_libs/reportes/inventario_2015.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&actualizar_existencia="+valor;
// Ejecutar la función
    AbrirVentana(varenviar);
}); // Cierre princial de la función document.
///////////////////////////////////////////////////////////////////////////////
// LLAMAR AL REPORTE QUE VA MOSTRAR EL INVENTARIO COMPRAS.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////	  
$('#goBuscarInventarioProducto').on( 'click', function () {
	fecha_inicio = $("#txtFechaInicio").val();
	fecha_fin = $("#txtFechaFin").val();
// construir la variable con el url.
    varenviar = "/sistema_facturacion/php_libs/reportes/inventario_por_producto_resumen.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin;
// Ejecutar la función
    AbrirVentana(varenviar);
}); // Cierre princial de la función document.


///////////////////////////////////////////////////////////////////////////////
// ACTUALIZAR EL ARCHIVO DE INVENTARIO AJUSTE AGOSTO.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////	  
$('#goActualizarInventarioProducto').on( 'click', function () {
	// ACTUALIZA EL ARCHVIO DE LA HOJA DE CALCULO LA CUAL CONTIENE EL VALOR DEL AJUSTE DEL INVENTARIO.
		Pace.track(function(){
				$.ajax({
		            beforeSend: function(){
						console.log("Actualizando Ajuste...");
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
                    url:"includes/importar_hoja_calculo_inventario_fisico_ajuste.php",
		            success: function(response){
		            	// Validar mensaje de error
                        // Si el valor si existe compararlo con mensaje error.
                           if (response.mensaje == "Si Registro") {
                                toastr.success("Registro(s) Actualizado(s).");
								console.log("Registros Actualizados...");
                           }                                                
                           if (response.mensaje == "No Registro") {
                                toastr.info("Registro(s) No Encontrados(s).");
								console.log("Registros No Actualizados...");
                           }
					},
					error: function(){
						console.log("Error...");
					}
		        });	
		});
});

///////////////////////////////////////////////////////////////////////////////
// LLAMAR AL REPORTE QUE VA MOSTRAR EL INVENTARIO.
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////	  
$('#goBuscarComprasVentas').on( 'click', function () {
	var mes = $("#txtFechaComprasVentas").val();
	
			$.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/BuscarFechaResumenDiario.php",
		            data: "accion_fecha_buscar=BuscarFacturasComprasVentas" + "&mes=" + mes,
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.respuesta == true) {
									if (response.mensaje == "Si Registro") {
                                	// Cargar valores a los objetos
                                                $("#listaCompras").empty();
                                                $('#listaCompras').append(response.contenido);
												toastr.success("Registro(s) Encontrado(s).");
									}
                                }
                                
                                if (response.respuesta == false) {
									$("#listaCompras").empty();
                                    toastr.error("No se encontraron Compras.");
                                }
						}
		        });
				////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// COMPRAS POR MES
				////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/BuscarFechaResumenDiario.php",
		            data: "accion_fecha_buscar=BuscarFacturasComprasVentasMes" + "&mes=" + mes,
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.respuesta == true) {
									if (response.mensaje == "Si Registro") {
                                	// Cargar valores a los objetos
                                                $("#listaComprasMeses").empty();
                                                $('#listaComprasMeses').append(response.contenido);
												toastr.success("Registro(s) Encontrado(s).");
									}
                                }
                                
                                if (response.respuesta == false) {
									$("#listaComprasMeses").empty();
                                    toastr.error("No se encontraron Registros.");
                                }
						}
		        });
////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// VENTAS POR MES
				////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/BuscarFechaResumenDiario.php",
		            data: "accion_fecha_buscar=BuscarFacturasVentasMes" + "&mes=" + mes,
		            success: function(response){
                               // Si el valor si existe compararlo con mensaje error.
                                if (response.respuesta == true) {
									if (response.mensaje == "Si Registro") {
                                	// Cargar valores a los objetos
                                                $("#listaVentasMeses").empty();
                                                $('#listaVentasMeses').append(response.contenido);
												//toastr.success("Registro(s) Encontrado(s).");
									}
                                }
                                
                                if (response.respuesta == false) {
									$("#listaVentasMeses").empty();
                                    toastr.error("No se encontraron Ventas en Este mes.");
                                }
						}
		        });
}); // Cierre princial de la función compras ventas
///////////////////////////////////////////////////////////////////////////////////
// Extracciòn del valor que va utilizar para Eliminar y Edición de Registros tabla TEMP DETALLE FACTURA
///////////////////////////////////////////////////////////////////////////////////
	$('body').on('click','#listaCompras a',function (e){
        e.preventDefault();
			numero_factura =$(this).parents('tr').find('td').eq(2).html();
			codigo_proveedor =$(this).parents('tr').find('td').eq(3).html();
		// Si el valor es 01 PARA CARGAR LA FACTURA CONSUMIDOR FINAL.
		// construir la variable con el url.
		    varenviar = "/sistema_facturacion/php_libs/reportes/factura_compras_informe.php?numero_factura="+numero_factura+"&codigo_proveedor="+codigo_proveedor;
        // Ejecutar la función
		    AbrirVentana(varenviar);
		});
	
	
	

}); // FIN DE LA FUNCION


///////////////////////////////////////////////////////////////////////////////
// ABRE NUEVA PESTAÑA.
///////////////////////////////////////////////////////////////////////////////
function AbrirVentana(url)
{
    window.open(url, '_blank');
    return false;
}
// FUNCION LISTAR TABLA catalogo_ruta
////////////////////////////////////////////////////////////
function listar_ann(codigo_ann){
    var miselect=$("#lstFechaAño");
    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
    miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
    
    $.post("includes/cargar_ann.php", 
        function(data) {
            miselect.empty();
            for (var i=0; i<data.length; i++) {
                if(codigo_ann == data[i].codigo){
                    miselect.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');
                }else{
                    miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
                }
            }
    }, "json");    
}