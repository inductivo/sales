$(document).ready(function(){
	
	$('.modalReasignar').on('click', cargarUsuarios);
	$('.modalReasignar').on('click', cargarDatos);

 	function cargarUsuarios()
 	{
 		
 		obtenerUsuarios(imprimirUsuarios);
 	}

 	function obtenerUsuarios(callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get'
			},
			url: 'cargarUsuarios',
		}) .done(callback);
	}

	function imprimirUsuarios(jsonData)
	{
		$('#usuarios').empty();
		$opciones = JSON.parse(jsonData);
		
		for(i=0; i<$opciones.length;i++)
		{
			$('#usuarios').append('<option value="'+ $opciones[i].id_usuarios +'">'+ $opciones[i].nombre +' '+ $opciones[i].apellidos +'</option>');
		}
	}

	//Cargar Datos

	function cargarDatos(){
		var id = $(this).attr('data-id');
		obtenerDatos(id,imprimirDatos);
	}

	function obtenerDatos(id,callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get',
				id_prospectos : id
			},
			url: 'buscar_prospecto'
		}).done(callback);
	}

	function imprimirDatos(jsonData){

		 $datos = JSON.parse(jsonData);
		 var out = "<label class='nombre'>"+ $datos.titulo+ " " + $datos.nombre +" "+ $datos.apellidos + "</label>";
		 out+= "<label class='puesto'>"+ $datos.puesto + "</label>";
		 var empresa = "<label class='empresa'>"+ $datos.empresa +"</label>";
	
		 document.getElementById("info1").innerHTML = out;
		 document.getElementById("info2").innerHTML = empresa;
		 $('#id_prospectos').val($datos.id_prospectos);
	}



});
	



