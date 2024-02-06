// id de user global
var idUser_ok = 0;
var accion = 'noAccion';
var codigo_medida = "";
var printer = "";

$(function(){
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BLOQUE PARA ADMINISTRAR LAS MEDIDAS.
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BUSCAR REGISTROS (MEDIDAS)
// funcionalidad del botón Actualizar
				$('#goMedidaCancelar').on('click',function(){
                $("#goBuscarMedida").prop("disabled",false);
                $("#goNuevoMedida").prop("disabled",false);
                $("#goMedidaActualizar").prop("disabled",true);
                        $('#listaMedidaOK').empty();
        });
// Botón Buscar
		$('#goBuscarMedida').on('click',function(){
			accion = $('#goBuscarMedida').val();
            //variables checked
				if($('#c1').is(":checked")) {codigo_medida= '01';}
				if($('#c2').is(":checked")) {codigo_medida = '02';}
				printer = $('#lstPrinter').val();

                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/phpAjaxMedidas.php",  {accion: accion, codigo_modalidad: codigo_medida, printer: printer},
                                  function(response) {
                                    if (response.respuesta === true) {
                                                toastr.success("Registros Encontrados.");
												console.log("Registros Encontrados...");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                    
                                                        $("#goBuscarMedida").prop("disabled",true);
                                                        $("#goNuevoMedida").prop("disabled",true);
                                                        $("#goMedidaActualizar").prop("disabled",false);
                                    }
                                     if (response.respuesta === false) {
                                                toastr.info("Registros No Encontrados.");
												console.log("Registros no En contrados...");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                    }
                                  },"json");
                                
		});
                
      // funcionalidad del botón Actualizar
	$('#goMedidaActualizar').on('click',function(){
                accion = 'ActualizarDatosMedida';
                                
             // Información de la Página 1.                               
                var $objCuerpoTabla=$("#tablaMedida").children().prev().parent();
                var linea_ = []; var columna_ = []; var codigo_medida_ = [];
                var codigo_fuente_ = []; var codigo_estilo_ = []; var codigo_tamano_ = [];
                
                var fila = 0;
                // recorre el contenido de la tabla.
                $objCuerpoTabla.find("tbody tr").each(function(){
                                var codigo_medida =$(this).find('td').eq(1).find("input[name='codigo_medida']").val();
                                var linea =$(this).find('td').eq(5).find("input[name='linea']").val();
                                var columna =$(this).find('td').eq(6).find("input[name='columna']").val();
                                var codigo_fuente =$(this).find('td').eq(7).find("select[name='codigo_fuente']").val();
                                var codigo_estilo =$(this).find('td').eq(8).find("select[name='codigo_estilo']").val();
                                var codigo_tamano =$(this).find('td').eq(9).find("select[name='codigo_tamano']").val();
                
                                $(this).css("background-color", "#ECF8E0");
                // dar valor a las arrays.
                        codigo_medida_[fila]=codigo_medida;
                        linea_[fila]=linea;
                        columna_[fila]=columna;
                        codigo_fuente_[fila]=codigo_fuente;
                        codigo_estilo_[fila]=codigo_estilo;
                        codigo_tamano_[fila]=codigo_tamano;

                        fila = fila + 1;
                });
                   
				                
                $.ajax({
  		            beforeSend: function(){
						console.log("Actualizando Medidas...");
		            },
                                cache: false,
                                type: "POST",
                                dataType: "json",
                                url:"php_libs/soporte/phpAjaxMedidas.php",
                                data: {
                                        accion: accion, codigo_medida: codigo_medida_, linea: linea_, columna: columna_, fila: fila,
                                        codigo_fuente: codigo_fuente_, codigo_estilo: codigo_estilo_, codigo_tamano: codigo_tamano_,
                                        },
                    success: function(response) {
                                        if (response.respuesta === true) {
                                            // lIMPIAR LOS VALORES DE LAS TABLAS.
												toastr.success("Registros Actualizados...");
												console.log("Registros Actualizados...");
                                                $("#goBuscarMedida").prop("disabled",false);
                                                $("#goNuevoMedida").prop("disabled",false);
                                                $("#goMedidaActualizar").prop("disabled",true);
                                                $('#listaMedidaOK').empty();
                                        }
                                        
                                }
                            });                
        });
                
           /////////////////////////////////////////////////////     
                // BLOQUE PARA GRABAR REGISTROS (MEDIDAS)
		$('#goSaveMedida').on('click',function(){
                        // Asignamos valor a la variable acción
			var accion = 'addMedida';
                        var descripcion_medida = $('#descripcion_medida').val();
                        var codigo_medida = $('#codigo_medida').val();
                        
                        $('#codigo_medida').attr('disabled',false);
                        
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/phpAjaxMedidas.php",  { accion: accion, nombre_medida: descripcion_medida, codigo_medida: codigo_medida},
                                  function(response) {
                                    if (response.respuesta == true) {
                                                alertify.success("Registros Grabado.");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                                 $('#editarMedidas').dialog('close');
                                    }else{
                                           alertify.success("Registros Ya Existe.");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                                 $('#editarMedidas').dialog('close');
                                    }
                                  },"json");
                                
			// Abrimos el Formulario
			$('#editarMedidas').dialog({
				title:'Agregar Registro',
				autoOpen:true
			});
		});
                // BLOQUE PARA NUEVO REGISTRO (SECCIÓN)
		$('#goNuevoMedida').on('click',function(){
                        // Buscar el último codigo de la sección
			var accion = 'BuscarCodigoMedida';
                        // Ocultar botón actualizar y mostrar botón guardar.
                        $('#goActualizarMedidas').hide();
                        $('#goSaveMedidas').show();
                        
                        $('#codigo_medida').attr('disabled',false);
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/phpAjaxMedidas.php",  { accion: accion},
                                  function(data) {
                                     $("label[for='lblcodigomedida']").text('Último agregado: '+data[0].codigo_medida);
                                  },"json");
                                    
			// Abrimos el Formulario
			$('#editarMedidas').dialog({
				title:'Agregar Registro',
				autoOpen:true
			});
		});
                // BLOQUE PARA GRABAR REGISTROS (MEDIDAS)
		$('#goSaveMedidas').on('click',function(){
                        // Asignamos valor a la variable acción
			var accion = 'addMedida';
                        var descripcion_medida = $('#descripcion_medida').val();
                        var codigo_medida = $('#codigo_medida').val();
                        
                        $('#codigo_medida').attr('disabled',false);
                        
                        // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/phpAjaxMedidas.php",  { accion: accion, nombre_medida: descripcion_medida, codigo_medida: codigo_medida},
                                  function(response) {
                                    if (response.respuesta == true) {
                                                alertify.success("Registros Grabado.");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                                 $('#editarMedidas').dialog('close');
                                    }else{
                                           alertify.success("Registros Ya Existe.");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                                 $('#editarMedidas').dialog('close');
                                    }
                                  },"json");
                                
			// Abrimos el Formulario
			$('#editarMedidas').dialog({
				title:'Agregar Registro',
				autoOpen:true
			});
		});
                // BLOQUE PARA ACTUALIZAR (MEDIDAS)
		$('#goActualizarMedidas').on('click',function(){
			// Asignamos valor a la variable acción
			$('#accion').val('ModificarMedida');
                                var accion = 'modificar_medida';
                                var id_ = $('#IdMedidas').val();
                                
                                var linea_x = $('#linea-x').val();
                                var columna_x = $('#columna-x').val();
                                
                                // Llamar al archivo php para hacer la consulta y presentar los datos.
                                $.post("php_libs/soporte/phpAjaxMedidas.php",  { id_x: id_, accion: accion, linea_x: linea_x, columna_x: columna_x},
                                  function(response) {
                                    if (response.respuesta == true) {
                                                alertify.success("Registros Actualizados.");
                                                // si es exitosa la operación
                                                 $('#listaMedidaOK').empty();
                                                 $('#listaMedidaOK').append(response.contenido);
                                                 $('#editarMedidas').dialog('close');
                                    }
                                  },"json");
                                
		});
                


});