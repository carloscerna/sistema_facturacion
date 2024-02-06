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
                   alertify.log("Directorio Actualizado.");
		});
                // ***************************************************************************************************
                // LLAMAR AL ARCHIVO IMPORTAR HOJA DE CALCULO PARA QUE ACTUALICE LAS NOTAS SEGÚN PERIODO O TRIMESTRE.
                // **************************************************************************************************

                $('body').on('click','#listaArchivosOK a',function (e)
                {
                        
                        baseUrl = "";
                        var ajax_load = "<div class='progress'>" + "<div id='progress_id' class='progress-bar progress-bar-striped active' " +
                        "role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>" +
                        "n/100</div></div>";
                          // estas dos lineas no cambian
                          e.preventDefault();
                          accion_ok = $(this).attr('data-accion');
        
                          // obtener el valor del nombre del archivo.
                          var nombre_archivo = $(this).parent().parent().children('td:eq(0)').text();
                         // condicionar si existe selecciona periodo o trimestre.
                                var periodo = $('#lstperiodo option:selected').html();
                                // sustituir el contenido de subpagina con el mensaje de carga       
                         $("#subpagina").html(ajax_load);
                if($(this).attr('data-accion') == 'goActualizarOk'){
                        // hacer llamada ajax al href
                        if (periodo !="Seleccionar...") {
                                $.ajax({
          		            beforeSend: function(){
                                                      $('#ajaxLoader').toggle();
                                        // abrir caja de dialogo.
                                        $('#AjaxLoaderActualizar').dialog('open');
                                        Pace.start();
        		            },
                                  cache: false,
                                    type: "POST",
                                    dataType: "json",
                                    url:"includes/importar_hoja_calculo.php",
                                    data: "nombre_archivo_=" + nombre_archivo + "&periodo_=" + periodo + "&id=" + Math.random(),
                                    success: function(data){
                                        // validar
                                        if (data[0].registro == "Si_registro") {
                                                alertify.log("Hoja de Calculo Actualizada."); 
                                                        Pace.stop();
                                                        $('#ajaxLoader').toggle();
                                                        $('#formArchivo select > option').removeAttr('selected');
                                                        // rellenar la subpagina con el HTML obtenido
                                                        //$("#subpagina").html("COMPLETADO!");
                                                }
                                                        //$('#AjaxLoaderActualizar').dialog('close'); // abrir caja de dialogo.
                                    },
                                        // modificar el valor de xhr a nuestro gusto
                                        xhr: function(){
                                          // obtener el objeto XmlHttpRequest nativo
                                          var xhr = $.ajaxSettings.xhr() ;
                                          // añadirle un controlador para el evento onprogress
                                          xhr.onprogress = function(evt){ 
                                            // calculamos el porcentaje y nos quedamos sólo con la parte entera
                                            var porcentaje = Math.floor((evt.loaded/evt.total*100));
                                            // actualizamos el texto con el porcentaje mostrado
                                            $("#progress_id").text(porcentaje + "/100");
                                            // actualizamos la cantidad avanzada en la barra de progreso
                                            $("#progress_id").attr("aria-valuenow", porcentaje); 
                                            $("#progress_id").css("width", porcentaje + "%"); 
                                          };
                                          // devolvemos el objeto xhr modificado
                                          return xhr ;
                                        },
                                    error:function(){
                                      //  $('#AjaxLoaderActualizar').dialog('close'); // abrir caja de dialogo.
                                        error_usuario();
                                        //alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE --- fase del ajax');
                                    }
                                }); // Cierre de Ajax.
                        }else{
                                alertify.error("Debe seleccionar un periodo o Trimestre");
                        }
                } // body de la tabla botón actualizar.
                        
                        // ***************************************************************************************************
			// Mandar datos para eliminar un registro.
                        // ***************************************************************************************************
			       if($(this).attr('data-accion') == 'goEliminarOk'){
					$('#ajaxLoader').toggle();
					// Llamar al archivo php para hacer la consulta y presentar los datos.
						$.post("includes/borrar_hoja_calculo.php",  { nombre_archivo_: nombre_archivo},
						function(data_borrar) {
							// validar
							if (data_borrar[0].registro == "Si_registro") {
								alertify.log("Hoja de Calculo Borrada."); 
								$('#ajaxLoader').toggle();
								$('#formArchivo select > option').removeAttr('selected');
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
                        
                }); // body de la tabla
               /* });*/
});


/*
 *          <!doctype html>
<html>
  <head>
    <title>Test Onprogress</title>
  </head>
  <body>

    <a id="menu_navegacion_inicio" href="https://i.imgur.com/Bq6ryBM.jpg">Click here</a>
    <div id="subpagina"></div>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
    <script>
      baseUrl = "";
      var ajax_load = "<div class='progress'>" + "<div id='progress_id' class='progress-bar progress-bar-striped active' " +
          "role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>" +
          "n/100</div></div>";

      $("#menu_navegacion_inicio").on("click", function(ev) {
        // estas dos lineas no cambian
        ev.preventDefault();
        var href = $(this).attr('href');

        // sustituir el contenido de subpagina con el mensaje de carga       
        $("#subpagina").html(ajax_load);

        // hacer llamada ajax al href
        $.ajax({
          url: baseUrl + href,
          // cuando se completa la petición
          success: function(codigo){
            // rellenar la subpagina con el HTML obtenido
            $("#subpagina").html("COMPLETADO!");
          },
          // modificar el valor de xhr a nuestro gusto
          xhr: function(){
            // obtener el objeto XmlHttpRequest nativo
            var xhr = $.ajaxSettings.xhr() ;
            // añadirle un controlador para el evento onprogress
            xhr.onprogress = function(evt){ 
              // calculamos el porcentaje y nos quedamos sólo con la parte entera
              var porcentaje = Math.floor((evt.loaded/evt.total*100));
              // actualizamos el texto con el porcentaje mostrado
              $("#progress_id").text(porcentaje + "/100");
              // actualizamos la cantidad avanzada en la barra de progreso
              $("#progress_id").attr("aria-valuenow", porcentaje); 
              $("#progress_id").css("width", porcentaje + "%"); 
            };
            // devolvemos el objeto xhr modificado
            return xhr ;
          }
        });
      });
    </script>
  </body>
</html>


		/*$('body').on('click','#listaArchivosOK a',function (e){
			e.preventDefault();

			accion_ok = $(this).attr('data-accion');
                        
			// obtener el valor del nombre del archivo.
                                var nombre_archivo = $(this).parent().parent().children('td:eq(0)').text();
			// condicionar si existe selecciona periodo o trimestre.
				var periodo = $('#lstperiodo option:selected').html();
			
				// Mandar datos para actualizar notas.
			       if($(this).attr('data-accion') == 'goActualizarOk'){
				if (periodo !="Seleccionar...") {
					$('#ajaxLoader').toggle();
					// Llamar al archivo php para hacer la consulta y presentar los datos.
						$.post("includes/importar_hoja_calculo.php",  { nombre_archivo_: nombre_archivo, periodo_: periodo },
						function(data) {
							// validar
							if (data[0].registro == "Si_registro") {
								alertify.log("Hoja de Calculo Actualizada."); 
								$('#ajaxLoader').toggle();
								$('#formArchivo select > option').removeAttr('selected');
							}
						}, "json");
				}else{
					alertify.error("Debe seleccionar un período o Trimestre");
				}	
			       }*/