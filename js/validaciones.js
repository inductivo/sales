

	$(document).ready(function(){
						
		$('#frmnuevoprosp').validate({

			rules: {
					empresa : {required : true},
					nombre : {required : true},
					comentarios : {required : true},
					email : {email : true},
					cp : {number : true},
					telefono : {number : true},
					movil : {number : true}
			},

			messages : {
					empresa: {required : "<span class='label label-important'>Campo obligatorio</span>"},
					nombre: {required : "<span class='label label-important'>Campo obligatorio</span>"},
					comentarios : {required : "<span class='label label-important'>Campo obligatorio</span>"},
					email : {email : "<span class='label label-important'>Ingresar una dirección valida de email</span>"},
					cp : {number : "<span class='label label-important'>El campo C.P. debe de ser númerico</span>"},
					telefono : {number : "<span class='label label-important'>Ingresar un valor númerico</span>"},
					movil: {number : "<span class='label label-important'>Ingresar un valor númerico</span>"}
			}

			/*, submitHandler: function() {
     		 alert("Prospecto agregado correctamente");
   		    }*/

		});

		$('#frmeditarprosp').validate({

			rules: {
					empresa : {required : true},
					nombre : {required : true},
					comentarios : {required : true},
					email : {email : true},
					cp : {number : true},
					telefono : {number : true},
					movil : {number : true}
			},

			messages : {
					empresa: {required : "<span class='label label-important'>Campo obligatorio</span>"},
					nombre: {required : "<span class='label label-important'>Campo obligatorio</span>"},
					comentarios : {required : "<span class='label label-important'>Campo obligatorio</span>"},
					email : {email : "<span class='label label-important'>Ingresar una dirección valida de email</span>"},
					cp : {number : "<span class='label label-important'>El campo C.P. debe de ser númerico</span>"},
					telefono : {number : "<span class='label label-important'>Ingresar un valor númerico</span>"},
					movil: {number : "<span class='label label-important'>Ingresar un valor númerico</span>"}
			}

			/*, submitHandler: function() {
     		 alert("Prospecto agregado correctamente");
   		    }*/

		});

		
		$('#frmsegp').validate({

			rules: {
					seguimiento: {required : true}
			},

			messages : {
				seguimiento : {required : "<span class='label label-important'>Campo obligatorio</span>"}
			}
		});

		

	})
