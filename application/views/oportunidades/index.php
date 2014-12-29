
<!--OPORTUNIDADES -->
	<div class="row-fluid" align="center">
		
		<div class="span12">
			<div class="table-responsive">
				<div class="alert alert-info" align="center">
					<i class="fa fa-check-square fa-fw fa-lg"></i> Tienes <strong><?= $this->model_oportunidades->numoportunidades($this->session->userdata('id_usuarios'));?></strong> Oportunidades de Negocio
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
			                <th class="th-opt">Comision</th>
			                <th class="th-opt"> Certeza</th>
			                <th class="th-opt"> Cierre Estimado</th>
			                <th class="th-opt">Eje</th>
			                <th class="th-opt">Acciones</th> 
                      	</tr> 
				 	</thead>

				 	<tbody>

				 		<?php
				 			$var = 0;
				 			$query = $this->model_oportunidades->mostrar_oportunidades($this->session->userdata('id_usuarios'));

				 			foreach ($query as $oportunidad):
				 		?>

				 		<tr>
				 			<td class="td-opt"> <?php echo  $var = $var+1; ?></td>
				 			<td class="td-opt nombre"><?= $oportunidad->titulo ?>
				 				<?= $oportunidad->nombre ?> <?= $oportunidad->apellidos ?><br>
				 				<strong><?= $oportunidad->empresa ?></strong><br>
				 				<small><?= $oportunidad->puesto ?></small>
				 			</td>
				
				 			<td class="td-contacto"><i class="fa fa-phone fa-fw"></i>
				 				<?= $oportunidad->telefono ?><br>
				 			
				 			<i class="fa fa-mobile fa-fw"></i>
				 				<?= $oportunidad->movil ?><br>
				 			
				 			<i class="fa fa-envelope-o fa-fw"></i>
				 				<?= $oportunidad->email ?><br>
				 				
				 			</td>

				 			<td class="td-opt">
				 				<?= $oportunidad->concepto?><br> 
				 				<?= $oportunidad->fase?>

				 			</td>


				 			<td class="td-opt">$<?= $oportunidad->monto?></td>
				 			<td class="td-opt">$<?= $oportunidad->comision?></td>
				 			<td class="td-opt">
				 			<?php $this->model_oportunidades->obtener_certeza($oportunidad->certeza); ?>
				 			</td>

				 			<td class="td-opt"><?php $this->model_oportunidades->convertir_fecha($oportunidad->cierre); ?></td>
				 			<td class="td-opt"><?= $this->session->userdata('iniciales');?></td>

				 			<!--Acciones -->

				 			<td class="td-acciones">

				 				<a href="#modalSeguimientoOPT" data-toggle="modal" class="label label-info modal-seguimiento-opt"
					 			 data-ido ="<?php echo $oportunidad->id_oportunidades?>" data-id ="<?php echo $oportunidad->id_prospectos ?>" >Seguimiento</a>	

					 			 <?= anchor('oportunidades/venta/'.$oportunidad->id_oportunidades.'/'.$oportunidad->id_prospectos,'Realizar Venta', array('class' => 'label label-warning',
				 									  'Realizar Venta'));?>
					 			

					 			<?= anchor('oportunidades/descartar/'.$oportunidad->id_oportunidades,
					 				'Descartar', array('class' => 'label label-important',
					 							'Descartar',
					 				 			'OnClick' => "return confirm
					 				 	('¿Estas seguro de descartar esta oportunidad?')"));?>
					 			
					 			<?= anchor('oportunidades/ver_opt/'.$oportunidad->id_prospectos.'/'.$oportunidad->id_oportunidades,'Ver', array('class' => 'label label-inverse','Ver'))?>
		
				 			</td>
				 		</tr>

				 		<?php endforeach; ?>  
				 		
				 	</tbody>

				 </table>

			</div>

			<!-- Tabla de Certeza-->
			<div class="table-responsive">
				<table class="table table-condensed table-hover table-bordered">
					<thead class="thead-opt">
						<tr>
							<th class="th-opt">Prioridad</th>
							<th class="th-opt">Monto</th>
							<th class="th-opt">Comisión</th>
							<th class="th-opt">Certeza</th>
						</tr>
					</thead>
					<tbody>
						<?php
                                              
                        $que = $this->model_oportunidades->mostrar_oportunidades($this->session->userdata('id_usuarios'));
                          $monto_verde =0;
                          $monto_amarillo=0;
                          $monto_rojo=0;
                          $comision_verde =0;
                          $comision_amarillo=0;
                          $comision_rojo=0; 
                      

                        foreach ($que as $registro): 
                         
                          if($registro->certeza <= 40 )
                          {
                            $monto_rojo = $registro->monto + $monto_rojo;
                            $comision_rojo = $registro->comision + $comision_rojo;

                          }else if($registro->certeza > 40 && $registro->certeza < 80 )
                              {
                                $monto_amarillo = $registro->monto + $monto_amarillo;
                                $comision_amarillo = $registro->comision + $comision_amarillo;

                              }else if ($registro->certeza >= 80)
                                      {
                                        $monto_verde = $registro->monto + $monto_verde;
                                        $comision_verde = $registro->comision + $comision_verde;
                                      }

                         endforeach; ?>

                         <tr>
                        <td class="td-opt">Baja</td> 
                        <td class="td-opt">$<?= $monto_rojo ?></td>
                        <td class="td-opt">$<?= $comision_rojo ?></td>
                        <td class="td-opt"><font color="#953b39";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>

                      <tr>
                        <td class="td-opt">Media </td> 
                        <td class="td-opt">$<?= $monto_amarillo ?></td>
                        <td class="td-opt">$<?= $comision_amarillo ?></td>
                        <td class="td-opt"><font color="#c67605";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>
                      
                      <tr>
                        <td class="td-opt">Alta</td> 
                        <td class="td-opt">$<?= $monto_verde ?></td>
                        <td class="td-opt">$<?= $comision_verde ?></td>
                        <td class="td-opt"><font color="#468847";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>

                      <tr>
                        <td class="td-opt2"><strong>TOTALES</strong></td> 
                        <td class="td-opt2"><strong>$<?= $monto_amarillo + $monto_rojo + $monto_verde ?> </strong></td>
                        <td class="td-opt2"><strong>$<?= $comision_amarillo + $comision_rojo + $comision_verde ?></strong></td>
                        <td class="td-opt"></td>
                      </tr>

					</tbody>
				</table>
			</div>

		</div>
		
	</div>

<!-- MODAL SEGUIMIENTO OPT-->
<div id="modalSeguimientoOPT" class="modal hide fade modal-seguimiento-opt" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    <h1><i class="fa fa-comments fa-lg"></i>  Seguimiento a la Oportunidad</h1>
	</div><!--.modal-header -->

	<div class="modal-body">

	<?= form_open_multipart('oportunidades/seguimiento_opt', array('class' => 'form-horizontal frm-opt','id' => '#frm-seguimiento-opt')); ?>

		<input type="hidden" name="id_prospectos" id="s-id_prospectos">
		<input type="hidden" name="id_oportunidades" id="id_opt">
		
		<div class="row-fluid fs1" align="center">
			<div class="span6"><p id="convertir1"></p></div>
			<div class="span6"><p id="convertir2"></p></div>	
		</div><!--.row-fluid -->		
			
		<div class="row-fluid margen">
			<div class="span6">	
				<label class="lab" for="concepto"><font color="red"><strong>*</strong></font>Concepto: </label>
				<input class="required input_txt" type="text" name="concepto" id="concepto" autofocus="autofocus" value="">
			</div>

			<div class="span6">
				<label class="lab" for="monto"><font color="red"><strong>*</strong></font>Monto: </label>
				<input class="required input_txt" type="text" name="monto" id="monto" value=" ">
			</div>

		</div> <!--.row-fluid -->

		<div class="row-fluid margen">
			<div class="span6">
				<label class="lab" for="comision"><font color="red"><strong>*</strong></font>Comisión: </label>
					<div class="input-append">
						<input class="required input_txt2" type="text" name="comision" id="comision" value="">
					
						<input class="input_txt_small required" name="porcentaje" id="porcentaje" type="text" value="">
						<span class="add-on">%</span>
					</div>
			</div>

			<div class="span6">
				<label class="lab" for="cierre"><font color="red"><strong>*</strong></font>Cierre: </label>	
				<input class="input_txt datepicker required" type="text" name="cierre" id="cierre" readonly="readonly" value="">
			</div>
		</div><!--.row-fluid -->

		<div class="row-fluid margen">
			<div class="span6">
				<label class="lab" for="certeza">Certeza: </label>
				<select name="certeza" id="certeza">
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
			<textarea class="textarea required" type="text" name="comentarios" id="comentarios" row="5" col="20" value=""></textarea>
		</div>

	</div><!--.row-fluid -->		


	<div class="row-fluid margentop" align="center">
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
			<script src="<?= base_url('js/seguimiento_opt.js')?>"></script>
			<!-- Calcula comisión-->
			<script src="<?= base_url('js/calcular_comision.js')?>"></script>
			

			<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/timepicker.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">











