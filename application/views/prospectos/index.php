
<div class="container">
	<ul class="nav nav-tabs">
	  	<li class="active"><?= anchor('prospectos/index','<i class="icon-user"></i>  Prospectos'); ?></li>
	  	<li><a data-toggle="modal" href="#" data-target="#myModal" class="mymodal"> Nuevo Prospecto</a></li>
	  	

	 	 <li><?= anchor('prospectos/ie_prospecto','<i class="icon-download-alt"></i> Importar/Exportar Prospectos'); ?></li>
	</ul>

	<div class="row-fluid" align="center">
		
		<div class="span12">
			<div class="table-responsive">
				<div class="alert alert-info">
					<i class="fa fa-user fa-fw fa-lg"></i> Tienes <strong><?= $this->model_prospectos->numprospectos($this->session->userdata('id_usuarios'));?></strong> prospectos
				</div>
				 
				 <p align="right"><input type="text" id="search_string" class="input_txt" placeholder="Buscar"></p>

				 <table class="table table-condensed table-hover table-bordered" id="myTable">
				 	<thead class="thead-prosp">
				 		<tr>
			                <th class="th-prosp"></th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Nombre y Empresa</th>
			                <th class="th-prosp">Puesto</th>
			                <th class="th-prosp">Datos de Contacto</th>                          
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Creación</th>
			                <th class="th-prosp">Acciones</th> 
                      	</tr> 
				 	</thead>

				 	<tbody>

				 		<?php
				 			$var = 0;
				 			$query = $this->model_prospectos->mostrar_prospectos($this->session->userdata('id_usuarios'));

				 			foreach ($query as $prospecto):
				 		?>

				 		<tr>
				 			<td class="td-prosp"> <?php echo  $var = $var+1; ?></td>
				 			<td class="td-prosp nombre"><?= $prospecto->titulo ?>
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
				 			<td class="td-prosp"><?= $prospecto->creacion ?>

				 			<!--Acciones -->

				 			<td class="td-acciones">
				 				
				 				<a href="#modalSeguimientoP" data-toggle="modal" class="label label-info modalSeguimientoP"
					 			 data-id ="<?php echo $prospecto->id_prospectos ?>"  >Seguimiento</a>

					 			 <?= anchor('prospectos/convertir_prospecto/'.$prospecto->id_prospectos,'Convertir', array('class' => 'label label-warning',
				 									  'Convertir'));?>
					 			
					 			<a href="#modalEditar" data-toggle="modal" class="label label-success modalEditar"
					 			 data-id ="<?php echo $prospecto->id_prospectos ?>">Editar</a>

					 			<?= anchor('prospectos/descartar/'.$prospecto->id_prospectos,
					 				'Descartar', array('class' => 'label label-important',
					 							'Descartar',
					 				 			'OnClick' => "return confirm
					 				 	('¿Estas seguro de descartar este prospecto?')"));?>
					 			
					 			<?= anchor('prospectos/ver_prospecto/'.$prospecto->id_prospectos,'Ver', array('class' => 'label label-inverse','Ver'))?>
		
				 			</td>
				 		</tr>
				 		<?php endforeach; ?>   		
				 	</tbody>
				 </table>
		</div> <!-- .table-responsive-->		
	</div> <!--.row-fluid -->
</div> <!--.container -->


<!-- MODAL NUEVO PROSPECTO -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
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

<!-- MODAL NUEVO EDITAR-->
<div id="modalEditar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
				</button>
				<h1 class="modal-title"> <i class=" fa fa-user fa-lg"></i> Editar Prospecto</h1>
			</div>
			<div class="modal-body mb">
				<div id="contenido-modal">
		<div>
					<?= form_open('prospectos/validar_editar_prospecto',array('class'=>'frm-prosp form-horizontal','id' => 'frmeditarprosp')); ?>

						<input type="hidden" name="id_prospectos" id="e-id_prospectos">

						<div class="control-group form-group">
							<label class="lab control-label" for="empresa"><font color="red"><strong>*</strong></font>Empresa: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'empresa','id'=>'e-empresa','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="lab control-label" for="titulo">Título: </label>
							<div class="controls">
								<select class="form-control" name="titulo" id="e-titulo">
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
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'nombre','id'=>'e-nombre','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="apellidos">Apellidos: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'apellidos','id'=>'e-apellidos','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="puesto">Puesto: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'puesto','id'=>'e-puesto','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="email">Email: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'email','name'=>'email','id'=>'e-email','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="telefono">Teléfono: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'telefono','id'=>'e-telefono','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="movil">Móvil: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'movil','id'=>'e-movil','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="domicilio">Domicilio: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'domicilio','id'=>'e-domicilio','value'=>''));?>

								<?= form_input(array('class'=>'input_txt span1','type'=>'text','name'=>'cp','id'=>'e-cp','placeholder'=>'C.P.','value'=>''));?>
							</div>
 
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad">Ciudad: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'ciudad','id'=>'e-ciudad','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="estado">Estado: </label>
							<div class="controls">
								<?= form_dropdown('estado',$estados,'','id="e-estado"'); ?>
							</div>
						</div>


						<div class="control-group">
							<label class="control-label lab" for="pais">País: </label>
							<div class="controls">
								<?= form_dropdown('pais',$paises,'','id="e-pais"'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="origen">Origen: </label>
							<div class="controls">
								<?= form_dropdown('origen',$origen,'','id="e-origen"'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="web">Página Web: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'web','id'=>'e-web','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad"><font color="red"><strong>*</strong></font>Comentarios: </label>
							<div class="controls">

								<?php $datos = array(
						              'name'        => 'comentarios',
						              'id'          => 'e-comentarios',
						              'rows'        => '4',
						              'class'       => 'span3 required',
						              'value'		=>	''

						            );

        						echo form_textarea($datos);?> 

							</div>
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

<!-- MODAL SEGUIMIENTO-->
<div id="modalSeguimientoP" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    <h1><i class=" fa fa-comment fa-lg"></i>  Seguimiento del Prospecto</h1>
	</div>

	<div class="modal-body">
		<?= form_open('prospectos/validar_seguimiento',array('class'=>'frmsegp form-horizontal','id' => 'frmsegp'));; ?>
			
			<input type="hidden" name="id_prospectos" id="s-id_prospectos">

			<div class="row-fluid fs1" align="center">
				<div class="span6"><p id="info1"></p></div>
				<div class="span6"><p id="info2"></p></div>
				
			</div><!--.row-fluid -->
		

			<div class="row-fluid" align="center">

				<div class="span12">
					<textarea name="seguimiento" id="seguimiento" rows="4" cols="50" placeholder="Escríba aquí lo que hablo con el cliente..." class="seguimiento" required></textarea>
				</div>
			
			</div> <!--.row-fluid -->

			<div class="row-fluid" align="center">
				<div class="span12">
					<span class="label label-info subtitulo">AGENDAR ACTIVIDAD</span><br>

					<strong>Fecha:</strong> <input type="text" name="fecha" id="fecha" class="input-medium txt_input datepicker">
					<strong>Hora:</strong> <input type="text" name="hora" id="hora" class="input-medium txt_input timepicker"><br>

					<div class="input-prepend margin_top">
			          <span class="add-on"><i class="icon-calendar"></i></span>
			           <input type="text" class="txt_input_large input-xxlarge" placeholder="Describa aquí la actividad a agendar." name="actividad" id="actividad">
			        </div>

				</div>
			</div><!--.row-fluid -->

	</div><!--.modal-body -->


	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-success">Aceptar</button>
	</div>
		<?= form_close();?>
</div> <!--FIN MODAL SEGUIMIENTO -->





			<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>

			<script src="<?= base_url('js/validaciones.js')?>"></script>
			<script src="<?= base_url('js/editar_prospecto.js')?>"></script>
			<script src="<?= base_url('js/seguimiento.js')?>"></script>
			

			<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/timepicker.css')?>" rel="stylesheet"  type= "text/css" media="screen">












