
<div class="container">
	<ul class="nav nav-tabs">
	  	<li class="active"><?= anchor('prospectos/index','<i class="icon-user"></i>  Prospectos'); ?></li>

	 	 <li><a href="#myModal" data-toggle="modal" class="mymodal"><i class="icon-plus-sign"> </i> Nuevo Prospecto</a></li>

	 	 <li><?= anchor('prospectos/ie_prospecto','<i class="icon-download-alt"></i> Importar/Exportar Prospectos'); ?></li>
	</ul>

	<div class="row-fluid" align="center">
		
		<div class="span12">
			<div class="table-responsive">

				 <table class="table table-condensed table-hover table-bordered" id="myTable">
				 	
				 		<tr>
			                <th class="th-prosp"></i> Nombre y Empresa</th>
			                <th class="th-prosp">Puesto</th>
			                <th class="th-prosp">Datos de Contacto</th>                          
			                <th class="th-prosp">Domicilio</th> 
						</tr> 

                      	<tr>
				 			<td class="td-prosp"><?= $prospecto->titulo ?>
				 				<?= $prospecto->nombre ?> <?= $prospecto->apellidos ?>
				 				<h5><?= $prospecto->empresa ?></h5>
				 			</td>
				 			<td class="td-prosp"><?= $prospecto->puesto ?></td>
				 			<td class="td-contacto"><i class="fa fa-phone fa-fw"></i>
				 				<?= $prospecto->telefono ?><br>
				 			
				 			<i class="fa fa-mobile fa-fw"></i>
				 				<?= $prospecto->movil ?><br>
				 			
				 			<i class="fa fa-envelope-o fa-fw"></i>
				 				<?= $prospecto->email ?><br>
				 				
				 			</td>

				 			<td class="td-prosp">
				 				<?= $prospecto->domicilio ?>, 
				 				<?= $prospecto->ciudad ?>, 
				 				<?= $prospecto->estado ?>, 
				 				<?= $prospecto->pais ?>
				 				<?= $prospecto->cp ?>
				 			</td>
				 		</tr>

				 		<tr></tr>

                      	<tr>
                      		<th class="th-prosp">Página Web</th>
			                <th class="th-prosp">Origen</th>
			                <th class="th-prosp">Creación</th>
			                <th class="th-prosp">Comentarios</th>
			                
                      	</tr>
				 		<tr>
				 			<td class="td-prosp"><?= $prospecto->web ?></td>
				 			<td class="td-prosp"><?= $prospecto->origen ?></td>
				 			<td class="td-prosp"><?= $prospecto->creacion ?> </td>
				 			<td class="td-prosp"><?= $prospecto->comentarios ?></td>
							
				 		</tr>
	
				 </table>

			</div>

		</div>
	
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

















