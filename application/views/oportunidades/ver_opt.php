
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

	<div class="row-fluid margen">
		<div class="span12">
			<span class="label label-info titulo"> INFORMACIÓN DE LA OPORTUNIDAD </span>
			<table class="table table-bordered">
				<thead>
					<tr class="tr1">
						<th class="th">Concepto</th>
						<th class="th">Monto</th>
						<th class="th">Comision</th>
						<th class="th">Porcentaje</th>
					</tr>

				</thead>
				<tbody>
					<tr class="tr2">
						<td class="th"><?= $opt->concepto ?></td>
						<td class="th">$<?= $opt->monto ?></td>
						<td class="th">$<?= $opt->comision ?></td>
						<td class="th"><?= $opt->porcentaje ?>%</td>
					</tr>
				</tbody>
			</table>

			<table class="table table-bordered">
				<thead>
					<tr class="tr1">
						<th class="th">Cierre</th>
						<th class="th">Certeza</th>
						<th class="th">Fase</th>
					</tr>
				</thead>
				<tbody>
					<tr class="tr2">
						<td class="th"> <?php $this->model_oportunidades->convertir_fecha($opt->cierre); ?></td>
						<td class="th"><?= $opt->certeza ?>%</td>
						<td class="th"><?= $opt->fase ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div><!--.row-fluid -->

	<div class="row-fluid">
		<div class="span12">
			<span class="label label-info titulo"> ARCHIVOS </span>
			<table class="table table-bordered">
				<thead>
					<tr class="tr1">
						<th class="th">Nombre</th>
						<th class="th">Peso</th>
						<th class="th">Fecha</th>
					</tr>
				</thead>
				<tbody>
				<?php $consulta = $this->model_oportunidades->ver_archivos($opt->id_oportunidades);

					foreach ($consulta as $archivo):
				?>
					<tr>
						<td> <a href="http://www.sumaventas.com.mx/sales/uploads/<?= $archivo->nombre?>" download><?= $archivo->nombre?></a></td>
						<td><?= $archivo->peso?> Kb</td>
						<td><?php $this->model_oportunidades->convertir_fecha($archivo->fecha); ?></td>

					</tr>
					
				<?php endforeach; ?> 
				</tbody>

			</table>

		</div><!--.span -->

	</div><!--.row-fluid -->

	<div class="row-fluid bg3">
		<div class="span12">
			<span class="label label-important titulo"> SEGUIMIENTO </span>
			<table class="table table-condensed table-striped">
				<thead>
					<tr class="tr1">
						<th class="th"></th>
						<th class="th">Hora</th>
						<th class="th">Fecha</th>
						<th class="th">Seguimiento</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$var = 0;

						$query= $this->model_prospectos->mostrar_seguimiento($prospecto->id_prospectos);
						$query2= $this->model_oportunidades->mostrar_seguimiento($opt->id_oportunidades);

						
						foreach ($query2 as $seg_opt):

						if($var == 0)
							{
					?>

					<tr class="error tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $seg_opt->hora ?></td>
						<td><?= $seg_opt->fecha ?></td>
						<td><?= $seg_opt->seguimiento ?></td>
					</tr>

					<?php } 
					else{
					?>	
						<tr class="warning tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $seg_opt->hora ?></td>
						<td><?= $seg_opt->fecha ?></td>
						<td><?= $seg_opt->seguimiento ?></td>
					</tr>

					<?php } endforeach; ?> 



					<?php	foreach ($query as $seguimiento):

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


					<?php  } endforeach; ?>  

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
						<th class="th"></th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Actividad</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$var = 0;

						$query_pros= $this->model_prospectos->mostrar_actividad($prospecto->id_prospectos);
						$query_opt= $this->model_oportunidades->mostrar_actividad($opt->id_oportunidades);

						foreach ($query_pros as $actividad):

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


					 <?php
					  foreach ($query_opt as $act_opt):

							if($var == 0)
							{
					?>

					<tr class="error tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $act_opt->hora ?></td>
						<td><?= $act_opt->fecha ?></td>
						<td><?= $act_opt->actividad?></td>
						<td><?= $act_opt->estatus?></td>
					</tr>

					<?php } 
					else{
					?>	
						<tr class="success tr2">
						<td><?php echo  $var = $var+1; ?></td>
						<td><?= $act_opt->hora ?></td>
						<td><?= $act_opt->fecha ?></td>
						<td><?= $act_opt->actividad?></td>
						<td><?= $act_opt->estatus ?></td>
					</tr>

					<?php } endforeach; ?>  

				</tbody>
			</table>
		</div>
	</div><!--.row -->


	<link href="<?= base_url('css/verprospecto.css')?>" rel="stylesheet"  type= "text/css" media="screen">
