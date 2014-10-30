
<div class="container">
	<ul class="nav nav-tabs">
	  	<li class="active"><?= anchor('prospectos/index','<i class="icon-user"></i>  Prospectos'); ?></li>

	 	 <li><a href="#myModal" data-toggle="modal" class="mymodal"><i class="icon-plus-sign"> </i> Nuevo Prospecto</a></li>

	 	 <li><?= anchor('prospectos/ie_prospecto','<i class="icon-download-alt"></i> Importar/Exportar Prospectos'); ?></li>
	</ul>

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

</div>


<!-- MODAL NUEVO PROSPECTO -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
				</button>
				<h1 class="modal-title"> <i class=" fa fa-user fa-lg"></i> Nuevo Prospecto</h1>
			</div>
			<div class="modal-body">
				<div>
					<?= form_open('prospectos/validar_prospecto',array('class'=>'frm-prosp form-horizontal','id' => 'frmnuevoprosp')); ?>

						
						<div class="control-group form-group">
							<label class="lab control-label" for="empresa"><font color="red"><strong>*</strong></font>Empresa: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'empresa','id'=>'empresa','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="lab control-label" for="titulo">Título: </label>
							<div class="controls">
								<select class="form-control" name="titulo">
									<option value="">Elegir</option>
									<option>Lic.</option>
									<option>Ing.</option>
									<option>Dr.</option>
									<option>Sr.</option>
									<option>Sra.</option>
								</select>
							</div>
						</div>

						<div class="control-group form-group"> 
							<label class="control-label lab" for="nombre"><font color="red"><strong>*</strong></font>Nombre: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'nombre','id'=>'nombre','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="apellidos">Apellidos: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'apellidos','id'=>'apellidos','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="puesto">Puesto: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'puesto','id'=>'puesto','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="email">Email: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'email','name'=>'email','id'=>'email','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="telefono">Teléfono: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'telefono','id'=>'telefono','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="movil">Móvil: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'movil','id'=>'movil','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="domicilio">Domicilio: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'domicilio','id'=>'domicilio','value'=>''));?>

								<?= form_input(array('class'=>'input_txt span1','type'=>'text','name'=>'cp','id'=>'cp','placeholder'=>'C.P.','value'=>''));?>
							</div>
 
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad">Ciudad: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'ciudad','id'=>'ciudad','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="estado">Estado: </label>
							<div class="controls">
								<?= form_dropdown('estado',$estados,24); ?>
							</div>
						</div>


						<div class="control-group">
							<label class="control-label lab" for="pais">País: </label>
							<div class="controls">
								<?= form_dropdown('pais',$paises,146); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="origen">Origen: </label>
							<div class="controls">
								<?= form_dropdown('origen',$origen); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="web">Página Web: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'web','id'=>'web','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad"><font color="red"><strong>*</strong></font>Comentarios: </label>
							<div class="controls">

								<?php $datos = array(
						              'name'        => 'comentarios',
						              'id'          => 'comentarios',
						              'rows'        => '4',
						              'class'       => 'span3 required',
						              'value'		=>''

						            );

        						echo form_textarea($datos);?> 

							</div>
						</div>

				</div>
			


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar
				</button>

				<button type="submit" class="btn btn-success">Guardar</button>
			</div>

			

		</div>
	</div>
	<?= form_close(); ?>
</div>

	<link href="<?= base_url('css/verprospecto.css')?>" rel="stylesheet"  type= "text/css" media="screen">















