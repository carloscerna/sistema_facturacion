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

	// Carga la INformación de Tabla Genero.
	$(document).ready(function()
	{
			var miselect=$("#lstGenero");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_genero.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});

	// Carga la INformación de Tabla Estado Civil.
	$(document).ready(function()
	{
			var miselect=$("#lstEstadoCivil");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_estado_civil.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});

	// Carga la INformación de Tabla Nivel Escolaridad.
	/*$(document).ready(function()
	{
			var miselect=$("#lstEstudios");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
/*			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_nivel_escolaridad.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});

	*/
	// Carga la INformación de Tabla AFP
	/*
	$(document).ready(function()
	{
			var miselect=$("#lstVivienda");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_tipo_vivienda.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});*/
	
	// Carga la INformación de Tabla Tipo de Discapacidad
	$(document).ready(function()
	{
			var miselect=$("#lstAfp");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
			miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_afiliado.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});

	// Carga la INformación de Tabla Servicio de Apoyo Educativo.
	/*$(document).ready(function()
	{
			var miselect=$("#lstCargo");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_cargo.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});*/
        
        	// Carga la INformación de Tabla Zona Residencia
	/*$(document).ready(function()
	{
			var miselect=$("#lstCargoDepartamento");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_departamento_cargo.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});
        
        	// Carga la INformación de Tabla Zona Residencia
	/*$(document).ready(function()
	{
			var miselect=$("#lstTaller");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_taller.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});*/

        	// Carga la INformación de Tabla Zona Residencia
	/*$(document).ready(function()
	{
			var miselect=$("#lstRuta");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_ruta.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});*/

        	// Carga la INformación de Tabla Zona Residencia
	/*$(document).ready(function()
	{
			var miselect=$("#lstClaseLicencia");
			/* VACIAMOS EL SELECT Y PONEMOS UNA OPCION QUE DIGA CARGANDO... */
		/*	miselect.find('option').remove().end().append('<option value="">Cargando...</option>').val('');
			
			$.post("includes/cargar_clase_licencia.php",
				function(data) {
					miselect.empty();
					for (var i=0; i<data.length; i++) {
						miselect.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
					}
			}, "json");
	});*/
        
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
			$.post("includes/cargar_municipio.php", { departamento: departamento },
			    function(data){
			    miselectM.empty();
				for (var i=0; i<data.length; i++) {
				    miselectM.append('<option value="' + data[i].codigo + '">' + data[i].descripcion + '</option>');
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

///////////////////////////////////////////////////////////
// Convertir a mayúsculas cuando abandone el input.
////////////////////////////////////////////////////////////
   function conMayusculas(field)
   {
        field.value = field.value.toUpperCase()
   }