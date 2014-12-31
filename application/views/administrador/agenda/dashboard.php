
	<div class="row-fluid" align="center">
		<div class="span12">

			<div class="row">
				<div class="span3 stats1">
					<p class="text-center"><i class="fa fa-user fa-5x"></i><font size="14px"><?= $this->model_prospectos->numprospectos($this->session->userdata('id_usuarios'));?></font></p>
						<p class="subtitle">prospectos </p>
				</div>
				<div class="span3 stats2">
					<p><i class="fa fa-dot-circle-o fa-5x"></i><font size="14px"><?= $this->model_oportunidades->numoportunidades($this->session->userdata('id_usuarios'));?></font></p> 
					<p class="subtitle">oportunidades de venta</p>
				</div>
				<div class="span3 stats3">
					<p><i class="fa fa-bar-chart fa-5x"></i><font size="14px"><?= $this->model_clientes->numclientes($this->session->userdata('id_usuarios'));?> </font> </p>
					<p class="subtitle">ventas realizadas</p>
				</div>
				<div class="span3 stats4">
					<i class="fa fa-usd fa-5x"></i><font size="14px"><?= $this->model_clientes->obtener_comisiones($this->session->userdata('id_usuarios')); ?></font></p>
					 <p class="subtitle"> de comisiones</p>
				</div>
			
			</div> <!--.row --> <br>

	<div class="alert alert-info" align="center">
				<i class="fa fa-calendar-o fa-fw fa-lg"></i> Fecha actual:
		          	<strong>
		            	<?php
		 
					        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					 
					        echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
		              			
		            	?>
		          	</strong>
	</div> <!--Alert info -->
	<p align="right"><input type="text" id="search_string" placeholder="Buscar" class="input_txt" /></p>


			<div class="table-responsive">

				<table class="table table-condensed table-hover table-striped table-bordered" id="myTable" >
					<thead class="thead-prosp">
						<tr>
			                <th class="th-prosp"></th>
			                <!--<th></th>-->
			                <th class="th-prosp">Fecha</th>
			                <th class="th-prosp">Hora</th>
			                <th class="th-prosp">Nombre y Empresa</th>
			                <th class="th-prosp">Datos de Contacto</th>
			                
			                <th class="th-prosp">Actividad</th>
			                <th class="th-prosp">Fase</th>
			                <th class="th-prosp">Acciones</th>                
              			</tr>   
					</thead>

					<tbody>

						<!----------------PROSPECTOS -->

						<?php
				 			$var = 0;
				 			$prosp= $this->model_agenda->mostrar_agenda($this->session->userdata('id_usuarios'));
				 			foreach ($prosp as $agenda):
				 			$this->model_agenda->fecha_vencida($agenda->fecha,$var);
				 		?>
				 			<!--Se imprime <tr> -->
				 			<td class="td-prosp"> <?php echo  $var = $var+1; ?>	</td>
				 			
				 			<td class="td-prosp"><?php $this->model_oportunidades->convertir_fecha($agenda->fecha); ?></td>
				 			<td class="td-prosp"><?= $agenda->hora ?></td>
				 			<td class="td-prosp nombre"><?= $agenda->titulo ?>
				 				<?= $agenda->nombre ?> <?= $agenda->apellidos ?><br>
				 				<strong><?= $agenda->empresa ?></strong><br>
				 				<small><?= $agenda->puesto ?></small>
				 			</td>

				 			<td class="td-contacto"><i class="fa fa-phone fa-fw"></i>
				 				<?= $agenda->telefono ?><br>
				 			
				 			<i class="fa fa-mobile fa-fw"></i>
				 				<?= $agenda->movil ?><br>
				 			
				 			<i class="fa fa-envelope-o fa-fw"></i>
				 				<?= $agenda->email ?><br>
				 				
				 			</td>
				 		
				 			<td class="td-prosp"><?= $agenda->actividad ?></td>
				 			<td class="td-prosp"><?= $agenda->tipo ?></td>
				 			
				 			<td class="td-prosp">
				 				
				 				<a href="#modalReagendar" data-toggle="modal" class="label label-warning modalSeguimientoP modalactividad modalReagendar"
					 			 data-id ="<?php echo $agenda->id_prospectos ?>" data-act="<?php echo $agenda->id_actividad ?>">Reagendar</a>

				 				<a href="#modalactividad" data-toggle="modal" class="label label-info modalactividad"
					 			 data-id ="<?php echo $agenda->id_prospectos ?>" data-act="<?php echo $agenda->id_actividad ?>">Realizada</a>
		
				 			</td>
				 			

				 		</tr>

				 		<?php endforeach; ?>  


					</tbody>

				</table>

			</div>
		</div>
	</div>


	<!-- MODAL REAGENDA-->
	<div id="modalReagendar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h1><i class=" fa fa-calendar fa-lg"></i>  Reagendar Actividad</h1>
		</div>

		<div class="modal-body">
			<?= form_open('agenda/validar_reagenda',array('class'=>'frmreagenda form-horizontal','id' => 'frmreagenda'));; ?>
			
				<input type="hidden" name="id_prospectos" id="s-id_prospectos">
				<input type="hidden" name="id_actividad" id="r-id_actividad" >
				<input type="hidden" name="id_tipo" id="r-id_tipo" >

				<div class="row-fluid fs1" align="center">
					<div class="span6"><p id="info1"></p></div>
					<div class="span6"><p id="info2"></p></div>
				
				</div><!--.row-fluid -->
		

				<div class="row-fluid" align="center">

					<div class="span12">
						<textarea name="seguimiento" id="seguimiento" rows="4" cols="50" placeholder="Escríba aquí porque se va a reagendar la actividad..." class="seguimiento" required></textarea>
					</div>
			
				</div> <!--.row-fluid -->

			<div class="row-fluid" align="center">
				<div class="span12">
					<span class="label label-info subtitulo">REAGENDAR ACTIVIDAD</span><br>

					<strong>Fecha:</strong> <input type="text" name="fecha" id="fecha" class="input-medium txt_input datepicker">
					<strong>Hora:</strong> <input type="text" name="hora" id="hora" class="input-medium txt_input timepicker"><br>

					<div class="input-prepend margin_top">
			          <span class="add-on"><i class="icon-calendar"></i></span>
			           <input type="text" class="txt_input_large input-xxlarge" placeholder="Describa aquí la actividad a agendar." name="actividad" id="actividad">
			        </div>

				</div>
			</div><!--.row-fluid -->

			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Aceptar</button>
			</div>
			<?= form_close();?>

		</div><!--.modal-body -->
	</div> <!-- .modalReagendar-->



	<!-- MODAL ACTIVIDADOK-->
	<div id="modalactividad" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h1><i class=" fa fa-check-circle fa-lg"></i>  Actividad Realizada</h1>
		</div>

		<div class="modal-body">
			<?= form_open('agenda/validar_actok',array('class'=>'frmsegp form-horizontal','id' => 'frmactok'));; ?>
				
				<input type="hidden" name="id_prospectos" id="act-id_prospectos">
				<input type="hidden" name="id_actividad" id="act-id_actividad">

				<div class="row-fluid fs1" align="center">

					<div class="span6"><p id="informacion1"></p></div>
					<div class="span6"><p id="informacion2"></p></div>
					
				</div><!--.row-fluid -->
			

				<div class="row-fluid" align="center">

					<div class="span12">
						<textarea name="seguimiento" id="seguimiento" rows="4" cols="50" placeholder="Escríba aquí lo que hablo con el cliente..." class="seguimiento" required></textarea>
					</div>
				
				</div> <!--.row-fluid -->

			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Aceptar</button>
			</div>

		</div><!--.modal-body -->


		
			<?= form_close();?>
	</div> <!-- .modalActividad -->




		<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>

			<script src="<?= base_url('js/validaciones.js')?>"></script>

			<script src="<?= base_url('js/seguimiento.js')?>"></script>
			<script src="<?= base_url('js/act_realizada.js')?>"></script>

			<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">
			<link href="<?= base_url('css/timepicker.css')?>" rel="stylesheet"  type= "text/css" media="screen">

