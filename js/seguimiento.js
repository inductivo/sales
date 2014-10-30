

$(document).ready(function(){

	$('.modalSeguimientoP').on('click', peticion);

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

		 //out+= "<label class='nombre'>"+ $datos.nombre  + "</label>";
		 //out+= "<label class='nombre'>"+ $datos.apellidos + "</label>";

		 out+= "<label class='puesto'>"+ $datos.puesto + "</label>";

		 var empresa = "<label class='empresa'>"+ $datos.empresa +"</label>";

/*		 $('#id_prospectos-s').val($datos.id_prospectos);
		 $('.empresa-s').val($datos.empresa);
		 $('.titulo-s').val($datos.titulo);
		 $('.nombre-s').val($datos.nombre);
		 $('#apellidos-s').val($datos.apellidos);
		 $('#puesto-s').val($datos.puesto);*/

		 
		 document.getElementById("info1").innerHTML = out;
		 document.getElementById("info2").innerHTML = empresa;
		 $('#s-id_prospectos').val($datos.id_prospectos);
	}

 });


