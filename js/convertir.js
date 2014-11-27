$(document).ready(function(){


	
	$('.modalConvertir').on('click', peticion);
	$('.modalConvertir').on('click', cargarFases);
	$('.modal-seguimiento-opt').on('click', cargarFases);
	$('.modal-seguimiento-opt').on('click', peticion);

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
		 
		 document.getElementById("convertir1").innerHTML = out;
		 document.getElementById("convertir2").innerHTML = empresa;
		 $('#c-id_prospectos').val($datos.id_prospectos);
	}

	/*function cargarFases(){
		var path = '<?php echo base_url()?>';

    	$.get(path + 'prospectos/cargarFases',function(resp) {
      		$('#fase').empty().html(resp);
    	});
 	}*/

 	function cargarFases()
 	{
 		obtenerFases(imprimirFases);
 	}

 	function obtenerFases(callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get'
			},
			url: 'cargarFases',
		}) .done(callback);
	}

	function imprimirFases(jsonData)
	{
		$('#fase').empty();
		$opciones = JSON.parse(jsonData);
		

		for(i=0; i<$opciones.length;i++)
		{
			$('#fase').append('<option value="'+ $opciones[i].id_fases_opt +'">'+ $opciones[i].fase +'</option>');
		}
	

	}




});
	



