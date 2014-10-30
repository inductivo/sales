
<div class="container">
	<ul class="nav nav-tabs">
  		<li class="active"><a href="#"><i class="icon-tasks"></i> Actividades</a></li>	
	</ul>	

	<div class="alert alert-info" align="center">
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

	<div class="row-fluid" align="center">
		<div class="span1"></div>
		<div class="span10">

			<div class="row">
				<div class="span3 stats1">
					<p class="text-center"><i class="fa fa-user fa-5x"></i><font size="14px"> 23</font></p>
						<p class="subtitle">prospectos </p>
				</div>
				<div class="span3 stats2">
					<p><i class="fa fa-dot-circle-o fa-5x"></i><font size="14px"> 9</font></p> 
					<p class="subtitle">oportunidades de venta</p>
				</div>
				<div class="span3 stats3">
					<p><i class="fa fa-bar-chart fa-5x"></i><font size="14px"> 5</font> </p>
					<p class="subtitle">ventas realizadas</p>
				</div>
				<div class="span3 stats4">
					<i class="fa fa-usd fa-5x"></i><font size="14px"> 3500</font></p>
					 <p class="subtitle"> de comisiones</p>
				</div>
			
			</div> <!--.row --> <br>




			<div class="table-responsive">
				

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