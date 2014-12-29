
<div class="row-fluid" align="center">
	<div class="span12">
		<div class="table-responsive">
			<div class="alert alert-success" align="center">
				<span><i class="fa fa-dot-circle-o fa-fw fa-lg"></i></span> Se han generado <strong><?= $this->model_reportes->numopt_generadas($this->session->userdata('id_empresas'));?></strong> oportunidades
			</div>
		<p align="right"><input type="text" id="search_string" class="input_txt" placeholder="Buscar"></p>

		<table class="table table-condensed table-hover table-bordered" id="myTable">
			<thead class="thead-prosp">
				<tr>
			    	<th class="th-prosp"></th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Nombre y Empresa</th>
			        <th class="th-prosp">Datos de Contacto</th>                          
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Concepto</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Monto</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Comision</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Certeza</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Cierre</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Última Actualización</th>
			        <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Eje</th>
			        <th class="th-prosp">Acciones</th> 
                </tr> 
			</thead>
			<tbody>
				<?php
				 	$var=0;
				 	$query = $this->model_reportes->mostrar_opt_generadas($this->session->userdata('id_empresas'));
				 	foreach ($query as $prospecto):
				?>
				<tr>
					<td class="td-prosp"> <?php echo  $var = $var+1; ?></td>
					<td class="td-prosp nombre"><?= $prospecto->titulo ?>
				 		<?= $prospecto->nombre ?> <?= $prospecto->apellidos ?><br>
				 		<strong><?= $prospecto->empresa ?></strong><br>
				 		<small><?= $prospecto->puesto ?></small>
				 	</td>
				 	<td class="td-contacto"><i class="fa fa-phone fa-fw"></i>
				 		<?= $prospecto->telefono ?><br>
				 		<i class="fa fa-mobile fa-fw"></i>
				 		<?= $prospecto->movil ?><br>
				 		<i class="fa fa-envelope-o fa-fw"></i>
				 		<?= $prospecto->email ?><br>
				 	</td>
				 	<td class="td-prosp">
				 		<?= $prospecto->concepto?><br> 
				 		<?= $prospecto->fase?>
				 	</td>
				 	<td class="td-prosp">$<?= $prospecto->monto?></td>
				 	<td class="td-prosp">$<?= $prospecto->comision?></td>
				 	<td class="td-prosp">
				 		<?php $this->model_oportunidades->obtener_certeza($prospecto->certeza); ?>
				 	</td>
				 	<td class="td-prosp"><?php $this->model_oportunidades->convertir_fecha($prospecto->cierre); ?></td>
				 	<td class="td-prosp"><?= $prospecto->ultima_actualizacion ?>
				 	<td class="td-prosp"><?= $prospecto->iniciales?></td>
				 	<td class="td-prosp">
				 		<?= anchor('oportunidades/ver_opt/'.$prospecto->id_prospectos.'/'.$prospecto->id_oportunidades,'Ver', array('class' => 'label label-inverse','Ver'))?>
				 	</td>

				</tr>
				<?php endforeach; ?>  

			</tbody>
		</table>
		</div> <!--.table-responsive -->
	</div> <!--.span12 -->

</div><!--.row-fluid -->

	<!-- Jquery Validation-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
	<script src="<?= base_url('js/Chart.js')?>"></script>
	<script src="<?= base_url('js/Chart.min.js')?>"></script>