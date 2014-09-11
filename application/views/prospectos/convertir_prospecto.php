
<div class="container">
	<ul class="nav nav-tabs">
	  	<li class="active"><?= anchor('prospectos/index','<i class="icon-user"></i>  Prospectos'); ?></li>
	</ul>

	<div class="row-fluid" align="center">
		<div class="span1"></div>
		<div class="span10">
			<div class="page-header"><h3><i class="fa fa-line-chart fa-lg"></i> Crear Oportunidad de Negocio</h3></div>

	<?= form_open_multipart('prospectos/validar_conversion', array('class' => 'form-horizontal frm-opt','id' => '#frm-opt')); ?>

			<?= form_hidden('id_prospectos',$prospecto->id_prospectos);?>

			<div class="row">
				
				<div class="span12">
					<div class="alert alert-info">
						<strong class="titulo-prosp"><i class="fa fa-user fa-fw fa-lg"></i><?= $prospecto->nombre ?> <?= $prospecto->apellidos ?></strong>
						<?= $prospecto->empresa ?>
					</div>
				</div> <!--.span4 -->
				
			</div> <!-- .row-->

			
					
			

		<div class="row">
			<div class="span6">
				
				<div class="control-group">
					<label class="control-label lab" for="concepto"><font color="red"><strong>*</strong></font>Concepto: </label>
					<div class="controls control-align">
						<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'concepto','id'=>'concepto','value'=>'','autofocus'=>'autofocus'));?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label lab" for="monto"><font color="red"><strong>*</strong></font>Monto: </label>
					<div class="controls control-align">
						<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'monto','id'=>'monto'));?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label lab" for="comision"><font color="red"><strong>*</strong></font>Comision: </label>
					<div class="controls control-align">
						<?= form_input(array('class'=>'input_txt span4','type'=>'text','name'=>'comision','id'=>'comision','readonly'=>'readonly'));?>
						<div class="input-append">
	                  		<input class="span3" id="porcentaje" name="porcentaje" type="text" value="10" required>
	                  		<span class="add-on">%</span>
                		</div>
					</div>
						
				</div>

				<div class="control-group">
					<label class="control-label lab " for="cierre"><font color="red"><strong>*</strong></font>Cierre estimado: </label>
					<div class="controls control-align">
						<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'cierre','id'=>'datepicker','readonly'=>'readonly'));?>
						    
					</div>
				</div>

			</div><!-- .span3-->


			<div class="span6">

				<div class="control-group">
					<label class="control-label lab" for="certeza">Certeza: </label>
					<div class="controls control-align">
						<?php $opciones = array('10'=>'10%',
												'20'=>'20%',
												'30'=>'30%',
												'40'=>'40%',
												'50'=>'50%',
												'60'=>'60%',
												'70'=>'70%',
												'80'=>'80%',
												'90'=>'90%',
												'100'=>'100%'); 

						echo form_dropdown('certeza',$opciones,'10');
						?>
					</div>
				</div>

				 <div class="control-group">
					<label class="control-label lab" for="fase">Fase: </label>
					<div class="controls control-align">
						<?= form_dropdown('fase',$fases); ?>
					</div>

				  </div>


				<div class="control-group">
					<label class="control-label lab " for="archivo">Adjuntar archivo: </label>
					<div class="controls control-align">
						<?= form_input(array('class'=>'input_txt','type'=>'file','name'=>'userfile','id'=>'userfile'));?>
					</div>
				</div>

			</div><!-- .span3-->

		</div> <!--.row -->

		<div class="row">
			<div class="span12">
				<div class="control-group">
					<label class="control-label lab" for="comentarios"><font color="red"><strong>*</strong></font>Comentarios: </label>
					<div class="controls control-align">
						<?= form_textarea(array('class'=>'textarea required','type'=>'text','name'=>'comentarios','id'=>'comentarios','value'=>'','rows'=>'5','col'=>'20'));?>
					</div>
				</div>

			</div> <!--.Span10 -->
			
		</div> <!--.row -->

		<div class="row">
			<div class="span4"></div>
			<div class="span4"></div>

			<div class="span4">
				<?= anchor('prospectos/index','Cancelar ',array('class'=>'btn btn-danger')); ?>
				<button type="submit" class="btn btn-success">Guardar</button>
			</div> <!--.span4 -->
		</div> <!--.row -->

	<?=form_close(); ?>
				

		</div>
		<div class="span1"></div>
	
	</div>
</div>

			
			<script src="<?= base_url('js/valid_opt.js')?>"></script>
			<!-- Calcula comisión-->
			<script src="<?= base_url('js/calcular_comision.js')?>"></script>
			
			

			<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
			

			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">

