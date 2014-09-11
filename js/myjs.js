

$(document).ready(function(){

	//Datapicker
	$( "#datepicker" ).datepicker({ 
        minDate: 0,
        dateFormat: " yy-mm-dd",
        dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
        autoSize: true

      });


	//Desvanece las alertas
	window.setTimeout(function() {
    	$(".alerta").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove(); 
    	});
	}, 5000);

   

    $("#myTable").tablesorter();

    //BUSCAR
    
    // Con estas 3 líneas sobreescribimos el Constains para que no sea case sensitive pues por default en jquery  viene con case sensitive. Si no lo pones, queda como Case sensitive
    $.expr[':'].Contains = function(x, y, z){
        return jQuery(x).text().toLowerCase().indexOf(z[3].toLowerCase())>=0;
    };

    // cada que escribamos, vamos a revisar lo que hay escrito 
    $('#search_string').keyup(function() 
    {
        //tomamos el valor que tiene el input
        var search = $('#search_string').val();
        //mostramos todos los valores, para despues ir ocultando los que no coinciden
        $('#mytable tr').show();
        
        //esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
        if(search.length>0)
        {
        // con la clase .nombre le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
        $("#mytable tr td.nombre").not(":Contains('"+search+"')").parent().hide();
        }

});






});

