$(document).ready(function(){

	$('.modal-seguimiento-opt').on('click', peticion);

	function getOportunidad(id,callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get',
				//id_prospectos : idp,
				id_oportunidades: id
			},
			url: 'buscar_oportunidad'
		}).done(callback);
	}

	function peticion()
	{
		//var id_p = $(this).attr('data-idp');
		var id_o = $(this).attr('data-ido');

		getOportunidad(id_o,imprimirOpt);
	}

	function imprimirOpt(jsonData)
	{
		 $datos = JSON.parse(jsonData);
		 

		 $('#concepto').val($datos.concepto);
		 $('#monto').val($datos.monto);
		 $('#comision').val($datos.comision);
		 $('#porcentaje').val($datos.porcentaje);
		 $('#cierre').val($datos.cierre);
		 $('#certeza').val($datos.certeza);
		 $('#fase').val($datos.fase);

		  $('#s-id_prospectos').val($datos.id_prospectos);
		  $('#id_opt').val($datos.id_oportunidades);


	}


});