

$(document).ready(function(){

	$('.modalactividad').on('click', peticion);
	$('.modalactividad').on('click', actividad);
	$('.modalReagendar').on('click', actividad_reagenda);

	function peticion(){
		var id = $(this).attr('data-id');

		getDatos(id,llenarDatos);	
	}

	function getDatos(id,callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get',
				id_prospectos : id
			},
			url: 'buscar_prospecto'
		}).done(callback);
		
	}

	function llenarDatos(jsonData){

		 $datos = JSON.parse(jsonData);

		 var out = "<label class='nombre'>"+ $datos.titulo+ " " + $datos.nombre +" "+ $datos.apellidos + "</label>";
		 out+= "<label class='puesto'>"+ $datos.puesto + "</label>";

		 var empresa = "<label class='empresa'>"+ $datos.empresa +"</label>";
		 
		 document.getElementById("informacion1").innerHTML = out;
		 document.getElementById("informacion2").innerHTML = empresa;
		 $('#act-id_prospectos').val($datos.id_prospectos);
	}


	function actividad(){
		var id = $(this).attr('data-act');

		getAct(id,llenarAct);	
	}

	function getAct(id,callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get',
				id_actividad : id
			},
			url: 'buscar_actividad'
		}).done(callback);
		
	}

	function llenarAct(jsonData){

		 $datos = JSON.parse(jsonData); 
		 $('#act-id_actividad').val($datos.id_actividad);
	}

	/*Funcion para obtener el id_actividad al reagendar para posteriormente cambiar el estatus*/
	function actividad_reagenda()
	{
		var id = $(this).attr('data-act');
		getAct(id,llenar_act_reagenda);	
	}

	function llenar_act_reagenda(jsonData){

		 $datos = JSON.parse(jsonData); 
		 $('#r-id_actividad').val($datos.id_actividad);
		 $('#r-id_tipo').val($datos.id_tipo);

	}


 });


