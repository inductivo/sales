
<div class="row-fluid" align="center">
	<div class="span12">
		<div class="table-responsive">
			<div class="alert alert-error" align="center">
				<span class="fa-stack fa-lg"><i class="fa fa-user fa-fw fa-lg fa-stack-1x"></i> <i class="fa fa-ban fa-stack-2x text-danger"></i></span> Existen <strong><?= $this->model_prospectos->numprospectos_descartados($this->session->userdata('id_empresas'));?></strong> prospectos descartados
			</div>

			<p align="right"><input type="text" id="search_string" class="input_txt" placeholder="Buscar"></p>

			<table class="table table-condensed table-hover table-bordered" id="myTable">
				 	<thead class="thead-prosp">
				 		<tr>
			                <th class="th-prosp"></th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Nombre y Empresa</th>
			                <th class="th-prosp">Datos de Contacto</th>                          
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Creación</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Última Actualización</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Eje</th>
			                <th class="th-prosp">Acciones</th> 
                      	</tr> 
				 	</thead>
				 	<tbody>
				 		<?php
				 			$var=0;
				 			$query = $this->model_reportes->mostrar_prosp_descartados($this->session->userdata('id_empresas'));

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
				 			<td class="td-prosp"><?= $prospecto->creacion ?>
				 			<td class="td-prosp"><?= $prospecto->ultima_actualizacion ?>
				 			<td class="td-prosp"><?= $prospecto->iniciales ?>
				 			<td class="td-acciones">

				 				<a href="#modalReasignar" data-toggle="modal" class="label label-important modalReasignar"
					 			 data-id ="<?php echo $prospecto->id_prospectos ?>"  >Reasignar</a>

				 				<?= anchor('prospectos/ver_prospecto/'.$prospecto->id_prospectos,'Ver', array('class' => 'label label-inverse','Ver'))?>
				 			</td>
				 		</tr>
				 		<?php endforeach; ?>  

				 	</tbody>
			</table>

		</div> <!--.table-responsive -->

	</div> <!--.span12 -->

</div><!--.row-fluid -->


<!-- MODAL REASIGNAR-->
<div id="modalReasignar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    <h1><i class=" fa fa-share-square fa-lg"></i>  Reasignar Prospecto</h1>
	</div>

	<div class="modal-body">
		<?= form_open('reportes/reasignar',array('class'=>'frmreasignar form-horizontal','id' => 'frmreasignar'));; ?>
			
			<input type="hidden" name="id_prospectos" id="id_prospectos">

			<div class="row-fluid fs1" align="center">
				<div class="span6"><p id="info1"></p></div>
				<div class="span6"><p id="info2"></p></div>
				
			</div><!--.row-fluid -->

			<div class="row-fluid" align="center">
				<div class="span12">
					<label class="lab" for="usuarios"><strong>Elegir el usuario al que se asignara:</strong> </label>
					<select name="usuarios" id="usuarios"></select>
				</div><!--.span12 -->
			</div> <!--.row-fluid -->

	</div><!--.modal-body -->

	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-success">Aceptar</button>
	</div>
		<?= form_close();?>
</div> <!-- .modalReasignar -->
		


	<!-- Jquery Validation-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
	<script src="<?= base_url('js/Chart.js')?>"></script>
	<script src="<?= base_url('js/Chart.min.js')?>"></script>
	<script src="<?= base_url('js/reasignar_prospecto.js')?>"></script>

	<link href="<?= base_url('css/seguimientop.css')?>" rel="stylesheet"  type= "text/css" media="screen">

