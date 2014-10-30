

$(document).ready(function(){


//Calcula la comisión
      
    $('#monto').ready(calcularcomision); 
    $('#monto').on('keyup',calcularcomision); 
    $('#cierre').on('change',cambiarfecha);  

    $('#anticipo').on('change',recalcularpagos); 



     function calcularcomision()
     {
        var $monto = $('#monto');
        var $porcentaje = $('#porcentaje');
        var $anticipo = $('#anticipo');

        var $pct =parseFloat($porcentaje.val()/100);
        var $comision = parseFloat($monto.val()*$pct);
        
        $('#comision').val($comision.toFixed(2));
        $('#comisionanticipo').val($comision.toFixed(2));
        $('#anticipo').val($monto.val());

        agregarpagos();
      
      }
      //Cambia la fecha de anticipo al cambiar la fecha de cierre
      function cambiarfecha()
      {
        var $cierre = $('#cierre').val();
        $('#fechaanticipo').val($cierre);
        calcularcomision();
      }

     /*Desplegar Inputs dinamicos*/
     $('#pagos').on('change',agregarpagos);
     $('#periodicidad').on('change',agregarpagos);
     $('#tipocomision').on('change',agregarpagos);

    

     function agregarpagos()
     {

      var $num_pagos = $('#pagos').val();
      var $tipofecha = $('#periodicidad').val();
      var $tipocomision = $('#tipocomision').val();
      var $cierre = $('#cierre').val();
      var $monto = $('#monto').val();
      var $comision = $('#comision').val();

      var html1 = '';
      var html2 = '';
      var html3 = '';
      var html4 = '';
      

      if($tipocomision == 1) //Prorrateadas
      {
         var $comisionfinal = parseFloat($comision/$num_pagos);
         var $montofinal = parseFloat($monto/$num_pagos);

         $('#anticipo').val($montofinal);
         $('#comisionanticipo').val($comisionfinal);

          for(i=0; i<=$num_pagos-2; i++)
          {
             var $cierre = obtenerFecha($tipofecha,$cierre);

            html1+= '<div class="control-group"><label class="control-label lab" for="Pago'+(i+2)+'">Pago'+(i+2)+': </label><div class="controls"><input class="input_txt input-small required" type="text" name="pago'+(i+2)+'" id="pago'+(i+2)+'" value='+$montofinal+'></input></div></div>';
            html2+= '<input class="input_txt margin-input required" type="text" name="comisionanticipo'+(i+2)+'" id="comisionanticipo'+(i+2)+'" value='+$comisionfinal+'></input>';
            html3+= '<input class="input_txt margin-input datepicker required  span8" type="text" name="fechaanticipo'+(i+2)+'" id="fechaanticipo'+(i+2)+'" value='+$cierre+'></input>';
            html4+= '<input class="input_txt margin-input span10" type="text" name="referencia'+(i+2)+'" id="referencia'+(i+2)+'"> <label class="checkbox span2"><input class= "margin-input" type="checkbox" id="pagorealizado'+(i+2)+'" name="pagorealizado'+(i+2)+'" value="pagado"></input></label>';
            
          }

          $('#anticipo-dinamico').html(html1);
          $('#comision-dinamico').html(html2);
          $('#fecha-dinamico').html(html3);
          $('#referencia-dinamico').html(html4);
         

          //Se agrega la suma de los pagos en campo hidden
          // var vm = validarmonto();
          //$('#validarmonto').val(vm);

          validarmonto();

          //Se agrega la suma de comisiones en campo hidden
          var vd = validarcomision();
          $('#validarcomision').val(vd);

      } else if($tipocomision == 2) //Primer Pago
      { 

         var $montofinal = parseFloat($monto/$num_pagos);
         $('#anticipo').val($montofinal);
         $('#comisionanticipo').val($comision);

          for(i=0; i<=$num_pagos-2; i++)
          {
             var $cierre = obtenerFecha($tipofecha,$cierre);

            html1+= '<div class="control-group"><label class="control-label lab" for="Pago'+(i+2)+'">Pago'+(i+2)+': </label><div class="controls"><input class="input_txt input-small required" type="text" name="pago'+(i+2)+'" id="pago'+(i+2)+'" value='+$montofinal+'></input></div></div>';
            html2+= '<input class="input_txt margin-input required" type="text" name="comisionanticipo'+(i+2)+'" id="comisionanticipo'+(i+2)+'" value="0"></input>';
            html3+= '<input class="input_txt margin-input datepicker required  span8" type="text" name="fechaanticipo'+(i+2)+'" id="fechaanticipo'+(i+2)+'" value='+$cierre+'></input>';
            html4+= '<input class="input_txt margin-input span10" type="text" name="referencia'+(i+2)+'" id="referencia'+(i+2)+'"></input> <label class="checkbox span2"><input class= "margin-input" type="checkbox" id="pagorealizado'+(i+2)+'" name="pagorealizado'+(i+2)+'" value="pagado"></input></label>';
            
          }

          $('#anticipo-dinamico').html(html1);
          $('#comision-dinamico').html(html2);
          $('#fecha-dinamico').html(html3);
          $('#referencia-dinamico').html(html4);
         

          //Se agrega la suma de los pagos en campo hidden
         //  var vm = validarmonto();
          //$('#validarmonto').val(vm);

          validarmonto();

          var vd = validarcomision();
          $('#validarcomision').val(vd);

      } else if($tipocomision == 3) //Último pago
      {

        var $montofinal = parseFloat($monto/$num_pagos);
        $('#comisionanticipo').val(0);       
        $('#anticipo').val($montofinal);

          for(i=0; i<=$num_pagos-2; i++)
          {
             var $cierre = obtenerFecha($tipofecha,$cierre);
             

            html1+= '<div class="control-group"><label class="control-label lab" for="Pago'+(i+2)+'">Pago'+(i+2)+': </label><div class="controls"><input class="input_txt input-small required" type="text" name="pago'+(i+2)+'" id="pago'+(i+2)+'" value='+$montofinal+'></input></div></div>';

            if(i == $num_pagos-2)
            {
             html2+= '<input class="input_txt margin-input required" type="text" name="comisionanticipo'+(i+2)+'" id="comisionanticipo'+(i+2)+'" value='+$comision+'></input>';
             html3+= '<input class="input_txt margin-input datepicker required  span8" type="text" name="fechaanticipo'+(i+2)+'" id="fechaanticipo'+(i+2)+'" value='+$cierre+'></input>';
             html4+= '<input class="input_txt margin-input span10" type="text" name="referencia'+(i+2)+'" id="referencia'+(i+2)+'"></input><label class="checkbox span2"><input class= "margin-input" type="checkbox" id="pagorealizado'+(i+2)+'" name="pagorealizado'+(i+2)+'" value="pagado"></input></label>';
             
            } 
            else{

            html2+= '<input class="input_txt margin-input required" type="text" name="comisionanticipo'+(i+2)+'" id="comisionanticipo'+(i+2)+'" value="0"></input>';
            html3+= '<input class="input_txt margin-input datepicker required  span8" type="text" name="fechaanticipo'+(i+2)+'" id="fechaanticipo'+(i+2)+'" value='+$cierre+'></input>';
            html4+= '<input class="input_txt margin-input span10" type="text" name="referencia'+(i+2)+'" id="referencia'+(i+2)+'"></input><label class="checkbox span2"><input class= "margin-input" type="checkbox" id="pagorealizado'+(i+2)+'" name="pagorealizado'+(i+2)+'" value="pagado"></input></label>';
            
            }
            
          }

          $('#anticipo-dinamico').html(html1);
          $('#comision-dinamico').html(html2);
          $('#fecha-dinamico').html(html3);
          $('#referencia-dinamico').html(html4);
          

          //Se agrega la suma de los pagos en campo hidden
          validarmonto();
           //var vm = validarmonto();
          //$('#validarmonto').val(vm);

          var vd = validarcomision();
          $('#validarcomision').val(vd);

      } // tipo comision 3
      else if($tipocomision == 4) //Manual
      {
         var $montofinal = parseFloat($monto/$num_pagos);
         $('#anticipo').val($montofinal);
         $('#comisionanticipo').val($comision);

          for(i=0; i<=$num_pagos-2; i++)
          {
             var $cierre = obtenerFecha($tipofecha,$cierre);

            html1+= '<div class="control-group"><label class="control-label lab" for="Pago'+(i+2)+'">Pago'+(i+2)+': </label><div class="controls"><input class="input_txt input-small required" type="text" name="pago'+(i+2)+'" id="pago'+(i+2)+'" value='+$montofinal+'></input></div></div>';
            html2+= '<input class="input_txt margin-input required" type="text" name="comisionanticipo'+(i+2)+'" id="comisionanticipo'+(i+2)+'" value="0"></input>';
            html3+= '<input class="input_txt margin-input datepicker required  span8" type="text" name="fechaanticipo'+(i+2)+'" id="fechaanticipo'+(i+2)+'" value='+$cierre+'></input>';
            html4+= '<input class="input_txt margin-input span10" type="text" name="referencia'+(i+2)+'" id="referencia'+(i+2)+'"></input><label class="checkbox span2"><input class= "margin-input" type="checkbox" id="pagorealizado'+(i+2)+'" name="pagorealizado'+(i+2)+'" value="pagado"></input></label>';
           
          }

          $('#anticipo-dinamico').html(html1);
          $('#comision-dinamico').html(html2);
          $('#fecha-dinamico').html(html3);
          $('#referencia-dinamico').html(html4);
          

          //Se agrega la suma de los pagos en campo hidden
         //  var vm = validarmonto();
          //$('#validarmonto').val(vm);

          validarmonto();

          var vd = validarcomision();
          $('#validarcomision').val(vd);
      }

     }


  function validarcomision()
  {
    var num_pagos = $('#pagos').val();
    var comision = $('#comision').val();
    var comisionanticipo = $('#comisionanticipo').val();
    var sumacomisiones=parseFloat(0);
    //var comisiontotal=parseFloat(0);

    for(i=0; i<=num_pagos-2; i++)
    {
      var comisiones = $('#comisionanticipo'+(i+2)).val();
      
      sumacomisiones = parseFloat(sumacomisiones) + parseFloat(comisiones);
      //alert($sumacomisiones);
    }
      sumacomisiones = parseFloat(sumacomisiones) + parseFloat(comisionanticipo);

     return sumacomisiones.toFixed(2);
      
  } //validarcomision

  function validarmonto()
  {
    var num_pagos = $('#pagos').val();
    var monto = $('#monto').val();
    var anticipo = $('#anticipo').val();
    var sumamonto=parseFloat(0);
    //var comisiontotal=parseFloat(0);

    for(i=0; i<=num_pagos-2; i++)
    {
      var pagos = $('#pago'+(i+2)).val();
      
      sumamonto = parseFloat(sumamonto) + parseFloat(pagos);
      //alert($sumacomisiones);
    }
      sumamonto = parseFloat(sumamonto) + parseFloat(anticipo);

     $('#validarmonto').val(sumamonto.toFixed(2));
      
  } //validarcomision

  function recalcularpagos()
  {
      var anticipo = $('#anticipo').val();
      var monto = $('#monto').val();
      var num_pagos = $('#pagos').val();
      var comision = $('#comision').val();

      var recalcular = parseFloat(monto-anticipo)/parseFloat(num_pagos-1);

      //var comisionanticipo = parseFloat(anticipo*comision) / monto;

      for(i=0; i<=num_pagos-2; i++)
      {
        $('#pago'+(i+2)).val(recalcular);
      }

  }

  function obtenerFecha(tf,fc)
      {
        var tipofecha= tf;
        var fechafinal = "";
        
           //Semanal
        if (tipofecha == 1)
        {
          
           //Sumar 7 DIAS
         var sumarDias=parseInt(8);
         var fechasemanal = fc;

         fechasemanal= new Date(fechasemanal);
         fechasemanal.setDate(fechasemanal.getDate()+sumarDias);



          var anio=fechasemanal.getFullYear(); //Año de 4 digitos
          var mes= fechasemanal.getMonth()+1;  // Mes
          var dia= fechasemanal.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          fechafinal = anio+"-"+mes+"-"+dia;

          return fechafinal;

        }

        //Quincenal
        else if (tipofecha == 2)
        {
          
          //Sumar 15 DIAS
           
          var sumarDias=parseInt(15);
          var fechasemanal = fc;

         fechasemanal= new Date(fechasemanal);
         fechasemanal.setDate(fechasemanal.getDate()+sumarDias);

          var anio=fechasemanal.getFullYear(); //Año de 4 digitos
          var mes= fechasemanal.getMonth()+1;  // Mes
          var dia= fechasemanal.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }
          fechafinal = anio+"-"+mes+"-"+dia;
          return fechafinal;

        }

        //Mensual
        else if (tipofecha == 3)
        {        
          //Sumar 1 Mes
          //var d2 = new Date(79,5,24)
          var fecha;
             //alert(fc.toString().length);
         
        var fechames = new Date(fc);
        var sumarMes=parseInt(1);
        var sumarDia=parseInt(1);

        var year = fechames.getFullYear();
        var month = fechames.getMonth();
        var date = fechames.getDate();

        fecha = new Date(year,month,date); 
        //fecha.setFullYear(year,month,date);
        fecha.setMonth(fecha.getMonth()+sumarMes);
        fecha.setDate(fecha.getDate()+sumarDia);

          var anio=fecha.getFullYear(); //Año de 4 digitos
          var mes= fecha.getMonth()+1;  // Mes
          var dia= fecha.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
          if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          var fechafinal = anio+"-"+mes+"-"+dia;
          return fechafinal;
          
        }

        //Bimestral  
        else if (tipofecha == 4)
        {

          //Sumar 2 MESES  
          var sumarMes=parseInt(2);
          var sumarDia=parseInt(1);
          var fechames = fc;

         fechames= new Date(fechames);
         fechames.setMonth(fechames.getMonth()+sumarMes);
         fechames.setDate(fechames.getDate()+sumarDia);

          var anio=fechames.getFullYear(); //Año de 4 digitos
          var mes= fechames.getMonth()+1;  // Mes
          var dia= fechames.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          fechafinal = anio+"-"+mes+"-"+dia;

          return fechafinal; 
          

        }

        //Trimestral
        else if (tipofecha == 5)
        {
         
             //Sumar 3 MESES
          
          var sumarMes=parseInt(3);
          var sumarDia=parseInt(1);
          var fechames = fc;

         fechames= new Date(fechames);
         fechames.setMonth(fechames.getMonth()+sumarMes);
         fechames.setDate(fechames.getDate()+sumarDia);

          var anio=fechames.getFullYear(); //Año de 4 digitos
          var mes= fechames.getMonth()+1;  // Mes
          var dia= fechames.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          fechafinal = anio+"-"+mes+"-"+dia;

          return fechafinal;
          
        }

        //Semestral
        else if (tipofecha == 6)
        {
          
          //Sumar 6 MESES

          var sumarMes=parseInt(6);
          var sumarDia=parseInt(1);

          var fechames = fc;

         fechames= new Date(fechames);
         fechames.setMonth(fechames.getMonth()+sumarMes);
         fechames.setDate(fechames.getDate()+sumarDia);

          var anio=fechames.getFullYear(); //Año de 4 digitos
          var mes= fechames.getMonth()+1;  // Mes
          var dia= fechames.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          fechafinal = anio+"-"+mes+"-"+dia;

          return fechafinal;
          
        }

        //Anual
        else if (tipofecha == 7)
        {

             //Sumar 1 AÑO

          var sumarMes=parseInt(1);
          var sumarDia=parseInt(1);
          var fechames = fc;

         fechames= new Date(fechames);
         fechames.setFullYear(fechames.getFullYear()+sumarMes);
         fechames.setDate(fechames.getDate()+sumarDia);

          var anio=fechames.getFullYear(); //Año de 4 digitos
          var mes= fechames.getMonth()+1;  // Mes
          var dia= fechames.getDate();  

          if(mes.toString().length<2){
          mes="0".concat(mes);        
           }    
       
        if(dia.toString().length<2){
          dia="0".concat(dia);        
          }

          fechafinal = anio+"-"+mes+"-"+dia;

          return fechafinal;
          
        }

        //Otros
       else if (tipofecha == 8)
        {
          return "";
        }

      }



 //Datapicker para input dinamicos
    $(document).on("focus",".datepicker",function() {
      $( ".datepicker" ).datepicker({ 
        minDate: 0,
        dateFormat: " yy-mm-dd",
        dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        autoSize: true

      });   

     
     });

    


});

