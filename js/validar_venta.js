
$(document).ready(function(){

  $('.frm-venta').validate({

    //var $pagos = $('#pagos').val();

    //for(i=0; i<=$num_pagos-2; i++)
    //{

    //}


    rules: {
      
      monto : {required : true,
                number : true
                },
      cierre : {required : true},

      anticipo : {required: true, number: true},

      comisionanticipo : {required: true, number: true},

      fechaanticipo : {required: true, date: true}



      
      
    },

    messages : {
      
      monto: {required : "<span class='label label-important'>Campo obligatorio</span>",
              number : "<span class='label label-important'>Ingresar un valor nùmerico</span>"},   
      cierre: {required : "<span class='label label-important'>Campo obligatorio</span>"},

      anticipo: {required : "<span class='label label-important'>Campo obligatorio</span>",
              number : "<span class='label label-important'>Ingresar un valor nùmerico</span>"}, 

      comisionanticipo: { required : "<span class='label label-important'>Campo obligatorio</span>",
        number : "<span class='label label-important'>Ingresar un valor nùmerico</span>"},

      fechaanticipo: { required : "<span class='label label-important'>Campo obligatorio</span>",
          date : "<span class='label label-important'>Ingresar el valor en formato de fecha (Ej. 20014-10-26)</span>"}
              
    }

  });


});