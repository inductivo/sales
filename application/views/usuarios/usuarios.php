
	<div class="row-fluid">
		
		<div class="span12">
			<div class="table-responsive">
				<div class="alert alert-info" align="center">
					<i class="fa fa-user fa-fw fa-lg"></i> Existen <strong><?= $this->model_usuarios->numusuarios($this->session->userdata('id_empresas'));?></strong> usuarios en el sistema
				</div>
				 
				 <p align="right"><input type="text" id="search_string" class="input_txt" placeholder="Buscar"></p>

				 <table class="table table-condensed table-hover table-bordered" id="myTable">
				 	<thead class="thead-prosp">
				 		<tr>
			                <th class="th-prosp"></th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Nombre</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Iniciales</th>
			                <th class="th-prosp">Datos de Contacto</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i>Ubicación</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i>Grupo</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i>Perfil</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Creación</th>
			                <th class="th-prosp"><i class="fa fa-caret-down fa-fw"></i> Último Acceso</th>                          
                      	</tr> 
				 	</thead>

				 	<tbody>

				 		<?php
				 			$var = 0;
				 			$query = $this->model_usuarios->mostrar_usuarios($this->session->userdata('id_empresas'));

				 			foreach ($query as $usuario):
				 		?>

				 		<tr>
				 			<td class="td-prosp"> <?php echo  $var = $var+1; ?></td>
				 			<td class="td-prosp nombre"><?= $usuario->nombre ?> <?= $usuario->apellidos ?></td>
				 			<td class="td-prosp"><?= $usuario->iniciales ?> </td>

				 			<td class="td-contacto"><i class="fa fa-mobile fa-fw"></i>
				 				<?= $usuario->telefono ?><br>
				 			
				 			<i class="fa fa-envelope-o fa-fw"></i>
				 				<?= $usuario->email ?><br>
				 				
				 			</td>

				 			<td class="td-prosp"><?= $usuario->ciudad ?> <?= $usuario->estado ?><br>
				 				<?= $usuario->pais ?>
				 			</td>

				 			<td class="td-prosp"><?= $usuario->grupo?> </td>
				 			<td class="td-prosp"><?= $usuario->perfil ?> </td>

				 			<td class="td-prosp"><?= $usuario->creacion ?> </td>
				 			<td class="td-prosp"><?= $usuario->ultimo_login?> </td>

				 			<!--Acciones -->
				 		</tr>
				 		<?php endforeach; ?>   		
				 	</tbody>
				 </table>
			</div> <!-- .table-responsive-->
		</div> <!--.span12-->
	</div> <!--.row-fluid -->


			<!-- Jquery Validation-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
	<script src="<?= base_url('js/Chart.js')?>"></script>
	<script src="<?= base_url('js/Chart.min.js')?>"></script>










