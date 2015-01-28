$(document).ready(function(){


	$('.modalEmail').on('click', tipoEmail);

 	function tipoEmail()
 	{
 		obtenerEmail(imprimirEmail);
 	}

 	function obtenerEmail(callback) {
		$.ajax({
			data : {
				format :'jsonp',
				method : 'get'
			},
			url: 'obtener_tipo_email',
		}) .done(callback);
	}

	function imprimirEmail(jsonData)
	{
		$('#tipo_email').empty();
		$opciones = JSON.parse(jsonData);
		

		for(i=0; i<$opciones.length;i++)
		{
			$('#tipo_email').append('<option value="'+ $opciones[i].id_tipo_email +'">'+ $opciones[i].tipo_email+'</option>');
		}

	}
	

	/*Desplegar Inputs dinamicos en la Configuración del Email*/
     $('#tipo_email').on('change',agregarOpciones);

     function agregarOpciones()
     {
     	 var $opcion = $('#tipo_email').val();
     	 var html1 = '';
     	 var html2 = '';
     	 var html3 = '';
     	 var html4 = '';
     	 var html5 = '';
     	 var html6 = '';
     	 var html7 = '';
     	 var html8 = '';

     	 if($opcion == 3)
     	 {

     	 	html1= '<div class="span6"> <label class="lab" for="entrada"><font color="red"><strong>*</strong></font>Servidor de Entrada (POP3): </label><input class="required input_txt" type="text" name="entrada" id="entrada"></div>';
			html2=	'<div class="span6"><label class="lab" for="puertoentrada"><font color="red"><strong>*</strong></font>Puerto: </label><input class="required input_txt input-small" type="text" name="puertoentrada" id="puertoentrada"></div>';

			html3= '<div class="span6"> <label class="lab" for="salida"><font color="red"><strong>*</strong></font>Servidor de Salida (SMTP): </label><input class="required input_txt" type="text" name="salida" id="salida"></div>';
			html4=	'<div class="span6"><label class="lab" for="puertosalida"><font color="red"><strong>*</strong></font>Puerto: </label><input class="required input_txt input-small" type="text" name="puertosalida" id="puertosalida"></div>';

			html5= '<div class="span6"> <label class="lab"> Conexión Segura: </label> </div>';
			html6= '<div class="span6"> <label class="radio inline lab"><input type="radio" name="conexion" value="1" checked> No necesita</label>';
			html7= '<label class="radio inline lab"><input type="radio" name="conexion" value="2"> SSL</label>';
			html8= '<label class="radio inline lab"><input type="radio" name="conexion" value="3"> TLS</label> </div>';

			$('#servidorEntrada').html(html1+html2);
			$('#servidorSalida').html(html3+html4);
			$('#conexionSegura').html(html5+html6+html7+html8);

     	 }
     	 else
     	 {
     	 	 document.getElementById("servidorEntrada").innerHTML="";
     	 	 document.getElementById("servidorSalida").innerHTML="";
     	 	 document.getElementById("conexionSegura").innerHTML="";

     	 }
     }



});
	



