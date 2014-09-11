

$(document).ready(function(){


//Calcula la comisión

     $('#monto').keyup(function(){
      var $monto = $('#monto');
      var $porcentaje = $('#porcentaje');

      var $pct =parseFloat($porcentaje.val()/100);
      var $comision = parseFloat($monto.val()*$pct);
      
      $('#comision').val($comision.toFixed(2));
      

     });

     $('#porcentaje').keyup(function(){
      var $monto = $('#monto');
      var $porcentaje = $('#porcentaje');

      var $pct =parseFloat($porcentaje.val()/100);
      var $comision = parseFloat($monto.val()*$pct);


      $('#comision').val($comision.toFixed(2));
      

     });


});

