$(function(){       
	////////////////////////////////////////////////////////////////////////
	// Validar Formulario, para posteriormente Guardar o Modificarlo.
	////////////////////////////////////////////////////////////////////////
	$('#formLogin').validate({
			rules:{
			        txtnombre: {
						required: true,
					},
					txtpassword:{
						required: true,
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
		var str = $('#formLogin').serialize();
	       // alert(str);
		// Inicio del Ajax.
		        $.ajax({
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"php_libs/soporte/Login.php",
		            data:str + "&id=" + Math.random(),
		            success: function(response){
		            	// Validar mensaje de error
					if(response.respuesta === false){
						if(response.contenido == "Error Usuario"){
							error_usuario();        
						}
						if(response.contenido == "Error Institucion"){
							error_institucion();        
						}
					}
					else{
						// si es exitosa la operación
						ok();
						window.location.href = 'index.php';
					}
				    },
				    error:function(){
					error_dbname();
				    }
			});
		}
	});
});
			function ok(){
				alertify.success("Conexión Exitosa."); 
				return false;
			}
		
			function error_usuario(){
				alertify.error("Usuario o Contraseña Incorrecta."); 
				return false; 
			}
                        function error_dbname(){
				alertify.error("NO Existe la base de datos."); 
				return false; 
			}
                       function error_institucion(){
				alertify.error("La Institución no ha sido creada."); 
				return false; 
			}	