

	<div class="row" align="center">			
		<div class="span12">
			<div class="alert alert-info">
				<strong class="titulo-prosp"><i class="fa fa-user fa-fw fa-lg"></i><?=$prospecto->titulo ?> <?=$prospecto->nombre ?> <?=$prospecto->apellidos?></strong>  <?=$prospecto->empresa ?>
			</div>
		</div> <!--.span12 -->
				
	</div> <!-- .row-->


	
	<?= form_open('oportunidades/validar_venta', array('class' => 'form-horizontal frm-venta','id' => '#frm-venta')); ?>
		
		<?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

		<input type="hidden" id="prospecto" name="prospecto" value=<?= $prospecto->id_prospectos?>></input>
		<input type="hidden" id="oportunidad" name="oportunidad" value= <?= $oportunidad->id_oportunidades ?> ></input>

		<div class="row-fluid">
			
			<div class="span4">
				<div class="control-group">
					<label class="control-label lab " for="cierre"><font color="red"><strong>*</strong></font>Cierre estimado: </label>
					<div class="controls">
						<?= form_input(array('class'=>'input_txt datepicker required','type'=>'text','name'=>'cierre','id'=>'cierre','readonly'=>'readonly','value'=>$oportunidad->cierre));?>					    
					</div>
				</div><!--.control-group Cierre -->
			</div><!--.span4 -->
			
			<div class="span4">
				<div class="control-group">
					<label class="control-label lab" for="monto"><font color="red"><strong>*</strong></font>Monto: </label>
					<div class="controls">
						<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'monto','id'=>'monto','value'=>$oportunidad->monto));?>
					</div>
				</div><!--.control-group monto -->
			</div><!--.span4 -->

			<div class="span4">
				<div class="control-group">
					<label class="control-label lab" for="comision">Comision: </label>
					<div class="controls controls-row" >
						<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'comision','id'=>'comision','readonly'=>'readonly','value'=>$oportunidad->comision));?>
						<div class="input-append">
	                  		<input class="input_txt input-mini" id="porcentaje" name="porcentaje" type="text" value=<?= $oportunidad->porcentaje ?> required readonly>
	                  		<span class="add-on">%</span>
                		</div>
					</div>		
				</div> <!--.control-group comision -->

			</div><!--.span4 -->
		
		</div><!--.row-fluid -->

		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
					<label class="control-label lab" for="observaciones">Observaciones: </label>
					<div class="controls control-align">
						<?= form_textarea(array('class'=>'textarea','type'=>'text','name'=>'observaciones','id'=>'observaciones','value'=>'','rows'=>'4','col'=>'20'));?>
					</div>
				</div>
			</div> <!--.span12 -->

		</div> <!--.row-fluid observaciones -->


		<div class="row-fluid margen-pagos" align="left">			
			<div class="span12">	
				<span class="label"><i class="fa fa-calendar fa-fw fa-2x"></i><strong class="calendario-pagos">Calendario de Pagos</strong></span>		
			</div> <!--.span12 -->		
		</div> <!-- .row-->

		<div class="row-fluid">

			<div class="span4">
				<div class="control-group">
					<label class="control-label lab" for="pagos">Número de pagos: </label>
					<div class="controls ">

						<?php $opciones1 = array('1'=>'1',
												'2'=>'2',
												'3'=>'3',
												'4'=>'4',
												'5'=>'5',
												'6'=>'6',
												'7'=>'7',
												'8'=>'8',
												'9' =>'9',
												'10' =>'10',
												'11'=>'11',
												'12'=>'12'
												); 

						echo form_dropdown('pagos',$opciones1,'1','class="span6" id="pagos"');
						?>
						
					</div>
				</div><!--.control-group monto -->
			</div><!--.span4 -->

			<div class="span4">
				<div class="control-group">
					<label class="control-label lab" for="periodicidad">Periodicidad: </label>
					<div class="controls ">
						<?php $opciones2 = array('1'=>'Semanal',
												'2'=>'Quincenal',
												'3'=>'Mensual',
												'4'=>'Bimestral',
												'5'=>'Trimestral',
												'6'=>'Semestral',
												'7'=>'Anual',
												'8'=>'Otro'
												); 

						echo form_dropdown('periodicidad',$opciones2,'Mensual','class="span10" id="periodicidad"');
						?>
					
					</div>
				</div><!--.control-group periodicidad -->
			</div><!--.span4 -->

			<div class="span4">
				<div class="control-group">
					<label class="control-label lab" for="comisiones">Comisiones: </label>
					<div class="controls ">
						<?php $opciones3 = array('1'=>'Prorrateadas',
												'2'=>'Primer Pago',
												'3'=>'Último Pago',
												'4'=>'Manual'
												); 

						echo form_dropdown('tipocomision',$opciones3,'Prorrateadas','class="span10" id="tipocomision"');
						?>
					
					</div>
				</div><!--.control-group monto -->

			</div><!--.span4 -->

		</div> <!--.row-fluid -->

		<div class="row-fluid">
			<div class="span3"></div> <!-- .span3 -->
			<div class="span3"><label class="lab2 label label-info">Comision: $</label> </div> <!-- .span3 -->
			<div class="span3"><label class="lab2 label label-info">Fecha:</label>  </div> <!-- .span3 -->
			<div class="span3"><label class="lab2 label label-info">Referencia:</label> </div> <!-- .span3 -->

		</div><!-- row-fluid pagos -->

		<div class="row-fluid">

			<div class="span3">
				<div class="control-group">
					<label class="control-label lab" for="anticipo"><font color="red"><strong>*</strong></font>Anticipo: </label>
					<div class="controls">
						<?= form_input(array('class'=>'input_txt input-small required','type'=>'text','name'=>'anticipo','id'=>'anticipo'));?>
					</div>
				</div><!--.control-group anticipo -->
			</div><!--.span3 -->

			<div class="span3">

				<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'comisionanticipo','id'=>'comisionanticipo'));?>
			</div><!--.span3 -->

			<div class="span3">
				<?= form_input(array('class'=>'input_txt span8 datepicker required','type'=>'text','name'=>'fechaanticipo','id'=>'fechaanticipo','value'=> $oportunidad->cierre));?>	
			</div><!--.span3 -->

			<div class="span3">
				<?= form_input(array('class'=>'input_txt span10','type'=>'text','name'=>'referencia','id'=>'referencia'));?>
				<label class="checkbox span2"><input type="checkbox" id="pagorealizado" name="pagorealizado" value="pagado"></input></label>
				
			</div><!--.span3 -->

		

		</div> <!--.row-fluid -->

		<div class="row-fluid" id="pagos-dinamicos">
			<div class="span3" id="anticipo-dinamico"></div>
			<div class="span3" id="comision-dinamico"></div>
			<div class="span3" id="fecha-dinamico"></div>
			<div class="span3" id="referencia-dinamico"></div>
			
		</div> <!--.row -->

		<div class="row">
			<div class="span2">
				<input type="hidden" id="validarmonto" name="validarmonto" value=""></input>
				<input type="hidden" id="validarcomision" name="validarcomision" value=""></input>
			</div>
			<div class="span9" align="right">
				<?= anchor('oportunidades/index','Cancelar ',array('class'=>'btn btn-large btn-danger')); ?>
				<button type="submit" class="btn btn-large btn-success">Aceptar</button>
			</div>
			<div class="span1"></div>
		</div>

		
		

	<?= form_close(); ?>
	



	<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
			<script src="<?= base_url('js/validar_venta.js')?>"></script>


			<!-- Calcula comisión-->
			<script src="<?= base_url('js/realizarventa.js')?>"></script>
			<!-- CSS -->
			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">





