
<!--OPORTUNIDADES -->
<div class="container">
	<ul class="nav nav-tabs">
	  	<li class="active"><?= anchor('oportunidades/index','<i class="fa fa-dot-circle-o fa-lg fa-fw"></i>  Oportunidades'); ?></li>
	</ul>

	<div class="row-fluid" align="center">
		
		<div class="span12">
			<div class="table-responsive">
				<div class="alert alert-info">
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


				 			<td class="td-opt"><?= $oportunidad->monto?></td>
				 			<td class="td-opt"><?= $oportunidad->comision?></td>
				 			<td class="td-opt">
				 			<?php $this->model_oportunidades->obtener_certeza($oportunidad->certeza); ?>
				 			</td>

				 			<td class="td-opt"><?php $this->model_oportunidades->convertir_fecha($oportunidad->cierre); ?></td>
				 			<td class="td-opt"><?= $this->session->userdata('iniciales');?></td>

				 			<!--Acciones -->

				 			<td class="td-acciones">
				 				<?= anchor('oportunidades/seguimiento/'.$oportunidad->id_prospectos,'Seguimiento', array('class' => 'label label-info',
				 									  'Seguimiento'));?>

					 			 <?= anchor('oportunidades/venta/'.$oportunidad->id_prospectos,'Realizar Venta', array('class' => 'label label-warning',
				 									  'Realizar Venta'));?>
					 			

					 			<?= anchor('oportunidades/descartar/'.$oportunidad->id_prospectos,
					 				'Descartar', array('class' => 'label label-important',
					 							'Descartar',
					 				 			'OnClick' => "return confirm
					 				 	('¿Estas seguro de descartar esta oportunidad?')"));?>
					 			
					 			<?= anchor('oportunidades/ver/'.$oportunidad->id_prospectos,'Ver', array('class' => 'label label-inverse','Ver'))?>
		
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
                        <td class="td-opt">$ <?= $monto_rojo ?></td>
                        <td class="td-opt">$ <?= $comision_rojo ?></td>
                        <td class="td-opt"><font color="#953b39";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>

                      <tr>
                        <td class="td-opt">Media </td> 
                        <td class="td-opt">$ <?= $monto_amarillo ?></td>
                        <td class="td-opt">$ <?= $comision_amarillo ?></td>
                        <td class="td-opt"><font color="#c67605";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>
                      
                      <tr>
                        <td class="td-opt">Alta</td> 
                        <td class="td-opt">$ <?= $monto_verde ?></td>
                        <td class="td-opt">$ <?= $comision_verde ?></td>
                        <td class="td-opt"><font color="#468847";><i class=" fa fa-circle fa-fw fa-2x"></i></font></td>
                      </tr>

                      <tr>
                        <td class="td-opt2"><strong>TOTALES</strong></td> 
                        <td class="td-opt2"><strong>$ <?= $monto_amarillo + $monto_rojo + $monto_verde ?> </strong></td>
                        <td class="td-opt2"><strong>$ <?= $comision_amarillo + $comision_rojo + $comision_verde ?></strong></td>
                        <td class="td-opt"></td>
                      </tr>

					</tbody>
				</table>
			</div>

		</div>
		
	</div>

</div>

			<!-- Jquery Validation-->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>	
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>

			<script src="<?= base_url('js/validaciones.js')?>"></script>
			<script src="<?= base_url('js/editar_prospecto.js')?>"></script>

			<link href="<?= base_url('css/oportunidades.css')?>" rel="stylesheet"  type= "text/css" media="screen">	











