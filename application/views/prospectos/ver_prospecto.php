

	<div class="row-fluid bg1" align="center">	
		<div class="span6 margen">
			<label class="nombre"><i class="fa fa-user fa-lg"></i> <?= $prospecto->titulo." ".$prospecto->nombre." ".$prospecto->apellidos?></label>
			<label class="puesto"><?= $prospecto->puesto ?></label>
		</div>
		<div class="span6 margen">
			<label class="empresa"><i class="fa fa-building-o fa-lg"></i> <?= $prospecto->empresa ?></label>
		</div>
	</div> <!--.row -->

	<div class="row-fluid bg2">
		<div class="margen2 span4">
			<label class="datos"><i class="fa fa-mobile fa-lg"></i> <?= $prospecto->movil ?></label><br>
			<label class="datos"><i class="fa fa-phone"></i> <?= $prospecto->telefono ?></label><br>
			<label class="datos"><i class="fa fa-envelope "></i> <?= $prospecto->email ?></label>
		</div>
		<div class="margen2 span4">
			<label class="datos"><i class="fa fa-map-marker fa-lg"></i> <?= $prospecto->domicilio ?></label>
			<label class="datos"><?= $prospecto->cp?> <?= $prospecto->ciudad ?> <?= $prospecto->estado?> <?= $prospecto->pais ?></label><br>
			<a href="<?= $prospecto->web ?>" target="_blank"> <label class="datos"><i class="fa fa-link"></i> <?= $prospecto->web ?></label> </a>
		</div>

		<div class="margen2 span4">
			<label class="datos">Origen: <?=$prospecto->origen?></label><br>
			<label class="datos">Creación: <?=$prospecto->creacion?></label>
		</div>
	</div><!--.row-->

	<div class="row-fluid bg3">
		<div class="span12">
			<span class="label label-important titulo"> SEGUIMIENTO </span>
			<table class="table table-condensed table-striped">
				<thead>
					<tr class="tr1">
						<th></th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Seguimiento</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$var = 0;

						$query= $this->model_prospectos->mostrar_seguimiento($prospecto->id_prospectos);

						foreach ($query as $seguimiento):

							if($var == 0)
							{
					?>

					<tr class="error tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $seguimiento->hora ?></td>
						<td><?= $seguimiento->fecha ?></td>
						<td><?= $seguimiento->seguimiento ?></td>
					</tr>

					<?php } 
					else{
					?>	
						<tr class="warning tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $seguimiento->hora ?></td>
						<td><?= $seguimiento->fecha ?></td>
						<td><?= $seguimiento->seguimiento ?></td>
					</tr>

					<?php } endforeach; ?>  

				</tbody>
			</table>
		</div>
	</div><!--.row -->

	<div class="row-fluid bg3">
		<div class="span12">
			<span class="label label-important titulo"> ACTIVIDADES </span>
			<table class="table table-condensed table-striped">
				<thead>
					<tr class="tr1">
						<th></th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Actividad</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$var = 0;

						$query1= $this->model_prospectos->mostrar_actividad($prospecto->id_prospectos);

						foreach ($query1 as $actividad):

							if($var == 0)
							{
					?>

					<tr class="error tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $actividad->hora ?></td>
						<td><?= $actividad->fecha ?></td>
						<td><?= $actividad->actividad?></td>
						<td><?= $actividad->estatus?></td>
					</tr>

					<?php } 
					else{
					?>	
						<tr class="success tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $actividad->hora ?></td>
						<td><?= $actividad->fecha ?></td>
						<td><?= $actividad->actividad?></td>
						<td><?= $actividad->estatus ?></td>
					</tr>

					<?php } endforeach; ?>  

				</tbody>
			</table>
		</div>
	</div><!--.row -->
	
	</div>



	<link href="<?= base_url('css/verprospecto.css')?>" rel="stylesheet"  type= "text/css" media="screen">















