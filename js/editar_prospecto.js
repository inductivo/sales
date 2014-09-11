

$(document).ready(function(){


	//Llena los campos del modal editar prospecto

	$('.modalEditar').on('click', peticion);

	function getDatosEditar(id,callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get',
				id_prospectos : id
			},
			url: 'buscar_prospecto'
		}).done(callback);
	}

	function peticion(){
		var id = $(this).attr('data-id');

		getDatosEditar(id,llenarDatos);
	}

	function llenarDatos(jsonData){

		 $datos = JSON.parse(jsonData);

		 $('#e-id_prospectos').val($datos.id_prospectos);
		 $('#e-empresa').val($datos.empresa);
		 $('#e-titulo').val($datos.titulo);
		 $('#e-nombre').val($datos.nombre);
		 $('#e-apellidos').val($datos.apellidos);
		 $('#e-puesto').val($datos.puesto);
		 $('#e-email').val($datos.email);
		 $('#e-telefono').val($datos.telefono);
		 $('#e-movil').val($datos.movil);
		 $('#e-domicilio').val($datos.domicilio);
		 $('#e-cp').val($datos.cp);
		 $('#e-ciudad').val($datos.ciudad);
		 $('#e-estado').val($datos.estado);
		 $('#e-pais').val($datos.pais);
		 $('#e-origen').val($datos.origen);
		 $('#e-web').val($datos.web);
		 $('#e-comentarios').val($datos.comentarios);
		

	}


});

