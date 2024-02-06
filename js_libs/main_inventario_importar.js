//Iniciamos nuestra función jquery.
$(function(){
// funcionalidad del botón que actualiza el directorio file.                
	$('#goActualizarDirectorio').on('click',function(){
		$.post("includes/cargar-nombre-archivos.php",
				function(data) {
					$('#listaArchivosOK').empty();                                  
					var filas = data.length;                                  
													  
					if (filas != 0 ) {                                  
							for (fila=0;fila<filas;fila++) {                                  
									$('#listaArchivosOK').append(data[fila].archivo);                                  
							}                                                                                  
					}else{                                  
							$('#listaArchivosOK').append(data[fila].archivo);                                  
					}                                  
			}, "json");
		toastr.info("Directorio Actualizado.");
	});		
// ***************************************************************************************************                
// LLAMAR AL ARCHIVO IMPORTAR HOJA DE CALCULO PARA QUE ACTUALICE LAS NOTAS SEGÚN PERIODO O TRIMESTRE.                
// **************************************************************************************************                
$('body').on('click','#listaArchivosOK a',function (e)                
{                
   // estas dos lineas no cambian                       
	e.preventDefault();                       
	accion_ok = $(this).attr('data-accion');
	valor_check = $('input:radio[name=customHoja]:checked').val();
   // obtener el valor del nombre del archivo.
    var url_archivo = "xxx";
    var url_archivo_data = false;
	var nombre_archivo = $(this).parent().parent().children('td:eq(0)').text();                       
   // condicionar si existe selecciona periodo o trimestre.                      
   // Al seleccionar dentro de la tabla.
    if($(this).attr('data-accion') == 'goActualizarOk'){
		// mostra rel modal. que contiene el mensaje del nombre del archivo y mensajes de veririvación o actualización.
		$('#myModal').modal('show');
		// valores a la consola
			console.log(" Archivo: " + nombre_archivo);
			$("label[for='NombreArchivo']").text(nombre_archivo);
			$("label[for='VerificarActualizar']").text("Verificando...");
		/*/
			CAMBIAR LA URL DEL ARCHIVO
		*/
			url_archivo = "includes/importar_hoja_calculo_inventario_fisico_ajuste.php";
		//
		$("label[for='VerificarActualizar']").text("Actualizando...");
						url_archivo_data = true;
						console.log(url_archivo_data);
						
						// Comenzar el proceso del AJAX PARA EL NUEVO ARCHIVO.
						// alert(url_archivo);
							$.ajax({
								cache: false,		
								type: "POST",		
								dataType: "json",		
								url: url_archivo,		
								data: "nombre_archivo_=" + nombre_archivo + "&id=" + Math.random(),		
								success: function(data){		
								// validar		
									if (data[0].registro == "Si_registro") {		
										toastr.success("Hoja de Calculo Actualizada.");
									}		
								},		
								error:function(){		
									toastr.error(":(");		
								}		
							}); // Cierre de Ajax. QUE TIENE EL NOMBRE DEL ARCHIVO A ACTUALIZAR.
	// 	por ser utnico archivo.
	/*		$.ajax({
				cache: false,		
				type: "POST",		
				dataType: "json",		
				url: "includes/verificar_importar_notas_hoja_calculo.php",		
				data: "nombre_archivo_=" + nombre_archivo + "&id="+Math.random(),		
				success: function(data){		
				// validar		
					if (data[0].registro == "No_registro") {		
						toastr.error("Archivo Incorrecto...");
						url_archivo_data = false;
						return;
					}
					
					if (data[0].registro == "Si_registro") {		
						$("label[for='VerificarActualizar']").text("Actualizando...");
						url_archivo_data = true;
						console.log(url_archivo_data);
						
						// Comenzar el proceso del AJAX PARA EL NUEVO ARCHIVO.
						// alert(url_archivo);
							$.ajax({
								cache: false,		
								type: "POST",		
								dataType: "json",		
								url: url_archivo,		
								data: "nombre_archivo_=" + nombre_archivo + "&id=" + Math.random(),		
								success: function(data){		
								// validar		
									if (data[0].registro == "Si_registro") {		
										toastr.success("Hoja de Calculo Actualizada.");
									}		
								},		
								error:function(){		
									toastr.error(":(");		
								}		
							}); // Cierre de Ajax. QUE TIENE EL NOMBRE DEL ARCHIVO A ACTUALIZAR.
					}
					
				},		
				error:function(){		
					toastr.error(":(");		
				}	
			}); // Cierre de Ajax.*/	
	} // If Data-accion - Actualizar.
            // ***************************************************************************************************
			// Mandar datos para eliminar un registro.
            // ***************************************************************************************************
			
			       if($(this).attr('data-accion') == 'goEliminarOk'){
					// Llamar al archivo php para hacer la consulta y presentar los datos.
						$.post("includes/borrar_hoja_calculo.php",  { nombre_archivo_: nombre_archivo},
						function(data_borrar) {
							// validar
							if (data_borrar[0].registro == "Si_registro") {
								toastr.info("Hoja de Calculo Borrada."); 
                                // Volver a cargar la información de los archivos.
                                    $.post("includes/cargar-nombre-archivos.php",
                                        function(data) {
                                            $('#listaArchivosOK').empty();
                                            var filas = data.length;
                                            if (filas !== 0 ) {
                                                for (fila=0;fila<filas;fila++) {
													$('#listaArchivosOK').append(data[fila].archivo);
                                                }                                                
                                            }else{
                                                    $('#listaArchivosOK').append(data[fila].archivo);
                                                }
                                        }, "json");
							}
						}, "json");
			       }                                             	
});
});