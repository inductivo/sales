
<!--CLIENTES -->
	<div class="row-fluid" align="center">
		
		<div class="span12">
			<div class="table-responsive">
				<div class="alert alert-info">
					<i class="fa fa-check-square fa-fw fa-lg"></i> Tienes <strong><?= $this->model_clientes->numclientes($this->session->userdata('id_usuarios'));?></strong> Clientes
				</div>
				 
				 <p align="right"><input type="text" id="search_string" class="input_txt" placeholder="Buscar"></p>

				 <table class="table table-condensed table-hover table-bordered" id="myTable">
				 	<thead class="thead-opt">
				 		<tr>
			                <th class="th-opt"></th>
			                <th class="th-opt"><i class="fa fa-caret-down fa-fw"></i> Nombre y Empresa</th>
			                <th class="th-opt">Datos de Contacto</th>                          
			                <th class="th-opt">Concepto/Fase</th>
			                <th class="th-opt">Monto</th>
			                <th class="th-opt">Anticipos</th>
			                <th class="th-opt">Saldo</th>
			                <th class="th-opt">Comision</th>
			                <th class="th-opt">Eje</th>
			                <th class="th-opt">Acciones</th> 
                      	</tr> 
				 	</thead>

				 	<tbody>

				 		<?php
				 			$var = 0;
				 			$query = $this->model_clientes->mostrar_clientes($this->session->userdata('id_usuarios'));

				 			foreach ($query as $clientes):
				 		?>

				 		<tr>
				 			<td class="td-opt"> <?php echo  $var = $var+1; ?></td>
				 			<td class="td-opt nombre"><?= $clientes->titulo ?>
				 				<?= $clientes->nombre ?> <?= $clientes->apellidos ?><br>
				 				<strong><?= $clientes->empresa ?></strong><br>
				 				<small><?= $clientes->puesto ?></small>
				 			</td>
				
				 			<td class="td-contacto"><i class="fa fa-phone fa-fw"></i>
				 				<?= $clientes->telefono ?><br>
				 			
				 			<i class="fa fa-mobile fa-fw"></i>
				 				<?= $clientes->movil ?><br>
				 			
				 			<i class="fa fa-envelope-o fa-fw"></i>
				 				<?= $clientes->email ?><br>
				 				
				 			</td>

				 			<td class="td-opt">
				 				<?= $clientes->concepto?><br> 
				 				<?= $clientes->fase?>

				 			</td>

				 			<td class="td-opt"><span class="label label-info">$ <?= $clientes->monto?></span></td>
				 			<td class="td-opt"><span class="label label-success">$ <?=$clientes->anticipo ?> </span></td>
				 			<td class="td-opt"><span class="label label-important">$<?=$clientes->saldo ?></span></td>
				 			<td class="td-opt"><span class="label label-warning">$<?=$clientes->comision ?></span></td>
				 			<td class="td-opt"><?= $this->session->userdata('iniciales');?></td>

				 			<!--Acciones -->

				 			<td class="td-acciones">

				 				<a href="#modalConvertir" data-toggle="modal" class="label label-warning modalConvertir"
					 			 data-id ="<?php echo $clientes->id_prospectos ?>"  >Crear Nueva Oportunidad</a>

					 			 <a href="#modalEditar" data-toggle="modal" class="label label-success modalEditar"
					 			 data-id ="<?php echo $clientes->id_prospectos ?>">Editar Contacto</a>

				 				<a href="#modalSeguimientoP" data-toggle="modal" class="label label-info modalSeguimientoP"
					 			 data-id ="<?php echo $clientes->id_prospectos ?>"  >Seguimiento Post-Venta</a>
				 				
				 				<?= anchor('clientes/ver_cliente/'.$clientes->id_ventas,'Ver', array('class' => 'label label-inverse','Ver'))?>	
					 			 
				 			</td>
				 		</tr>

				 		<?php endforeach; ?>  
				 		
				 	</tbody>

				 </table>

			</div>

		</div>
		
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
</div> <!-- .modalSeguimientoP -->

<!-- MODAL CONVERTIR-->
<div id="modalConvertir" class="modal hide fade modal-convertir" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    <h1><i class="fa fa-line-chart fa-lg"></i>  Convertir a Oportunidad</h1>
	</div><!--.modal-header -->

	<div class="modal-body">

	<?= form_open_multipart('prospectos/validar_conversion', array('class' => 'form-horizontal frm-opt','id' => '#frm-opt')); ?>

		<input type="hidden" name="id_prospectos" id="c-id_prospectos">
		
		<div class="row-fluid fs1" align="center">
			<div class="span6"><p id="convertir1"></p></div>
			<div class="span6"><p id="convertir2"></p></div>	
		</div><!--.row-fluid -->		
			
		<div class="row-fluid margen">
			<div class="span6">	
				<label class="lab" for="concepto"><font color="red"><strong>*</strong></font>Concepto: </label>
				<input class="required input_txt" type="text" name="concepto" id="concepto" autofocus="autofocus">
			</div>

			<div class="span6">
				<label class="lab" for="monto"><font color="red"><strong>*</strong></font>Monto: </label>
				<input class="required input_txt" type="text" name="monto" id="monto">
			</div>

		</div> <!--.row-fluid -->

		<div class="row-fluid margen">
			<div class="span6">
				<label class="lab" for="comision"><font color="red"><strong>*</strong></font>Comisión: </label>
					<div class="input-append">
						<input class="required input_txt2" type="text" name="comision" id="comision">
					
						<input class="input_txt_small required" name="porcentaje" id="porcentaje" type="text" value="10">
						<span class="add-on">%</span>
					</div>
			</div>

			<div class="span6">
				<label class="lab" for="cierre"><font color="red"><strong>*</strong></font>Cierre: </label>	
				<input class="input_txt datepicker required" type="text" name="cierre" id="cierre" readonly="readonly">
			</div>
		</div><!--.row-fluid -->

		<div class="row-fluid margen">
			<div class="span6">
				<label class="lab" for="certeza">Certeza: </label>
				<select name="certeza">
					<option value="10">10%</option>
					<option value="20">20%</option>
					<option value="30">30%</option>
					<option value="40">40%</option>
					<option value="50">50%</option>
					<option value="60">60%</option>
					<option value="70">70%</option>
					<option value="80">80%</option>
					<option value="90">90%</option>
					<option value="100">100%</option>
				</select>
			</div>

			<div class="span6">
				<label class="lab" for="fase">Fase: </label>
				<select name="fase" id="fase"></select>
			</div>

		</div><!--.row-fluid -->

	<div class="row-fluid margen">
		<div class="span12">
			<label class="lab" for="archivo">Adjuntar archivo:</label>
			<input class="input_txt" type="file" name="userfile" id="userfile">
		</div>

	</div><!--.row-fluid -->	

		<div class="row-fluid margen">
		<div class="span12">
			<label class="lab" for="comentarios">Comentarios:</label>
			<textarea class="textarea required" type="text" name="comentarios" id="comentarios" row="5" col="20"></textarea>
		</div>

	</div><!--.row-fluid -->		

	

	</div><!--.modal-body-->

	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-success">Aceptar</button>
	</div> <!-- .modal-footer -->

	<?=form_close(); ?>

	</div> <!--.modalConvertir -->



			<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>

			<script src="<?= base_url('js/validaciones.js')?>"></script>
			<script src="<?= base_url('js/editar_prospecto.js')?>"></script>
			<script src="<?= base_url('js/seguimiento.js')?>"></script>
			<script src="<?= base_url('js/convertir.js')?>"></script>
			<script src="<?= base_url('js/valid_opt.js')?>"></script>
			<!-- Calcula comisión-->
			<script src="<?= base_url('js/calcular_comision.js')?>"></script>
			

			<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/timepicker.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">






			<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>

			<script src="<?= base_url('js/validaciones.js')?>"></script>
			<script src="<?= base_url('js/editar_prospecto.js')?>"></script>
			<script src="<?= base_url('js/seguimiento.js')?>"></script>
			<script src="<?= base_url('js/convertir.js')?>"></script>
			<script src="<?= base_url('js/valid_opt.js')?>"></script>
			<script src="<?= base_url('js/seguimiento_opt.js')?>"></script>
			<!-- Calcula comisión-->
			<script src="<?= base_url('js/calcular_comision.js')?>"></script>
			

			<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/timepicker.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">











