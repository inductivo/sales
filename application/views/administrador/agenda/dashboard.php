
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
		              			//Salida: Viernes 24 de Febrero del 2012 
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
				 		?>
				 		
				 		<tr>
				 			<td class="td-prosp"> <?php echo  $var = $var+1; ?></td>
				 			
				 			<td class="td-prosp"><?= $agenda->fecha ?></td>
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
				 				<a href="#modalSeguimientoP" data-toggle="modal" class="label label-warning modalSeguimientoP"
					 			 data-id ="<?php echo $agenda->id_prospectos ?>"  >Reagendar</a>

					 			<?= anchor('agenda/act_realizada/'.$agenda->id_actividad,
					 				'Realizada', array('class' => 'label label-info',
					 							'Realizada',
					 				 			'OnClick' => "return confirm
					 				 	('¿Se realizo la actividad?')"));?>

				 			</td>
				 			

				 		</tr>

				 		<?php endforeach; ?>  


					</tbody>

				</table>

			</div>
		</div>
	</div>

