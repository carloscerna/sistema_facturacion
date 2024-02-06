/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// INPUT MASK U OTROS.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        					
								$(document).ready( function () {
						       // Jquery-mask - entrado de datos.
										$("#txtTelefonoResidencia").inputmask("9999-9999");
										$("#txtTelefonoCelular").inputmask("9999-9999");
													
										$("#txtDui").inputmask("99999999-9");
										$("#txtNit").inputmask("9999-999999-999-9");
										//$("#txtNumeroRegistro").inputmask("999999-9");
								});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//// CARGAR INFORMACIÓN DE LAS TABLAS PARA LOS SELECT
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
	$(document).ready(function()
	{
			var miselect=$("#lstEstatus");
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



        
	// Carga la INformación de Tabla Departamento
	$(document).ready(function()
	{
	    // REllenar el select Departamento.
		var miselect=$("#lstDepartamento");
	    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
		$.post("includes/cargar_departamento.php",
		    function(data) {
			miselect.empty();
			    for (var i=0; i<data.length; i++) {
				miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
				}
			}, "json");
 // REllenar el select Municipio con un Código específico 02 - Santa Ana.
		var miselectM=$("#lstMunicipio");
	    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		miselectM.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
  		    departamento="01";
			 codigo_municipio = "10";
			$.post("includes/cargar_municipio.php", { departamento: departamento },
			    function(data){
			    miselectM.empty();
				for (var i=0; i<data.length; i++) {
					if(data[i].codigo == codigo_municipio)
					{
						miselectM.append('<option value="' + data[i].codigo + '" selected>' + data[i].descripcion + '</option>');
					}else{	
				    miselectM.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
				}
			}, "json");	
	});
	
	// Carga la INformación de Tabla Departamento
	$(document).ready(function()
	{
		// Parametros para el lstmuncipio.
	$("#lstDepartamento").change(function () {
	    	    var miselect=$("#lstMunicipio");
		    /* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
   		$("#lstDepartamento option:selected").each(function () {
				elegido=$(this).val();
				departamento=$("#lstDepartamento").val();
				$.post("includes/cargar_municipio.php", { departamento: departamento },
				       function(data){
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");			
	    });
	});
	});