<script type="text/javascript">
	$(document).ready(function() {

//$("#mytable").tablesorter();

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

})

</script>



<div class="container">
	<ul class="nav nav-tabs">
  		<li class="active"><a href="#"><i class="icon-tasks"></i> Actividades</a></li>	
	</ul>	

	<div class="row-fluid" align="center">
		<div class="span1"></div>
		<div class="span10">
			<div class="table-responsive">
				<div class="alert alert-info">
					<i class="fa fa-calendar-o fa-fw fa-lg"></i> Fecha actual:
          			<strong>
            		<?php
 
			          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			 
			           echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
              			//Salida: Viernes 24 de Febrero del 2012 
            		?>
          			</strong>
				</div> <!--Alert info -->

				<p align="right">
					<input type="text" id="search_string" placeholder="Buscar" />
				</p>

				<table class="table table-condensed table-hover table-striped table-bordered" id="mytable" >
					<thead>
						<tr>
			                <th></th>
			                <!--<th></th>-->
			                <th>Fecha</th>
			                <th>Hora</th>
			                <th>Nombre y Empresa</th>
			                <th>Datos de Contacto</th>
			                
			                <th>Actividad</th>
			                <th>Fase</th>
			                <th>Acciones</th>                
              			</tr>   
					</thead>

					<tbody>

					</tbody>

				</table>

			</div>
		</div>
		<div class="span1"></div>
	</div>

</div> <!--Container -->