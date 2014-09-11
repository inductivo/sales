$(document).ready(function(){

  $('.frm-opt').validate({

    rules: {
      concepto : {required : true},
      monto : {required : true,
                number : true},
      porcentaje : {required : true,
                    number : true},
      cierre : {required : true},
      comentarios : {required : true}
    },

    messages : {
      concepto: {required : "<span class='label label-important'>Campo obligatorio</span>"},
      monto: {required : "<span class='label label-important'>Campo obligatorio</span>",
              number : "<span class='label label-important'>Ingresar un valor nùmerico</span>"},   
      porcentaje : {required : "<span class='label label-important'>Campo obligatorio</span>",
                    number : "<span class='label label-important'>Ingresar un valor nùmerico</span>"},
      cierre: {required : "<span class='label label-important'>Campo obligatorio</span>"},
      comentarios: {required : "<span class='label label-important'>Campo obligatorio</span>"},
              
    }
  });


});