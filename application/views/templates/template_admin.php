<DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta description ="Sales System Suma" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
		
		
		<link href="//code.jquery.com/ui/1.11.1/themes/flick/jquery-ui.css" rel="stylesheet" media="screen">
		<script src="//code.jquery.com/jquery-1.11.1.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script type="text/javascript" src="<?= base_url('js/tablesorter.min.js')?>"></script>
		<script src="<?= base_url('js/tipo_email.js')?>"></script>

		<script type="text/javascript" src="<?= base_url('js/tinymce/tinymce.min.js')?>"></script>
		<script type="text/javascript">
			tinymce.init({
    			selector: "textarea.editorEmail"
 			});
		</script>
		
		
		<link href="<?= base_url('css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/estilos_dashboard.css')?>" rel="stylesheet"  type= "text/css" media="screen">
		<link href="<?= base_url('css/prospectos.css')?>" rel="stylesheet"  type= "text/css" media="screen">
		<link href="<?= base_url('css/dashboard.css')?>" rel="stylesheet"  type= "text/css" media="screen">	

		<link href="<?= base_url('css/normalize.css')?>" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	</head>

	<body class="cuerpo"> 
		<header>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">			

					      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </a>

					      <a class="brand" href="<?php echo site_url('home/dashboard')?>">
					      <?= $this->session->userdata('empresa'); ?>
					      </a>

					  <div class="nav-collapse collapse">
					      	<ul class="nav">
					      		<li class="divider-vertical"></li>
					      		<li><a><?= $titulo ?></a></li>
					      		<li><a data-toggle="modal" href="#myModal" data-target="#myModal" class="mymodal"><i class="fa fa-plus-square fa-lg"></i> Nuevo Prospecto</a></li>
					      	</ul>

					      	<ul class="nav pull-right">
					      		<!-- <li><a href="#">Alertas <span class="badge badge-important">17</span></a></li> -->
					      		<li class="dropdown">
					      			<a href="#" class="dropdown-toggle nombre_usuario" data-toggle="dropdown">
					      				<i class="fa fa-user fa-lg"></i>
					      				 <?= $this->session->userdata('nombre'); ?> <?= $this->session->userdata('apellidos'); ?>
					      				<b class="caret"></b>
					      			</a>
					      			<ul class="dropdown-menu">
					      				<li class="nav-header">Mi cuenta</li>
					      				<li><a href="<?php echo site_url('home/cambiar_password')?>"><i class="fa fa-asterisk"></i> Cambiar contraseña</a></li>
					      				<li><a data-toggle="modal" href="#modalEmail" data-target="#modalEmail" class="modalEmail"><i class="fa fa-envelope-o"></i> Configurar email</a></li>
					      				<li><a href="<?php echo site_url('home/cerrar_sesion')?>" ><font color="red"><i class="fa fa-power-off"></i></font> Cerrar sesión</a></li>
					      			</ul>
					      		</li> 		
					      	</ul>

				      </div> <!-- .Nav-collapse -->

					</div> <!--Nav container -->
				</div> <!-- Navbar inner -->
			</div> <!-- Navbar-->

		</header>

			<div class="container">
				<div class="row-fluid">
					<div class="span12">

						<ul class="nav nav-tabs">

							 <li><?= anchor('home/dashboard','<i class=" fa fa-calendar fa-lg fa-fw "></i> Agenda'); ?></li>

							 <li><?= anchor('prospectos/index','<i class=" fa fa-user fa-lg fa-fw "></i> Prospectos'); ?></li>

							 <li><?= anchor('oportunidades/index','<i class=" fa fa-dot-circle-o fa-lg fa-fw "></i> Oportunidades'); ?></li>

							 <li><?= anchor('clientes/index','<i class=" fa fa-group fa-lg fa-fw "></i> Clientes'); ?></li>

							 <li class="dropdown">
							    <a lass="dropdown-toggle" data-toggle="dropdown"  href="#">
							    	<i class="fa fa-wrench fa-lg fa-fw"></i> Herramientas
							     	<b class="caret"></b>
							    </a>

							      	<ul class="dropdown-menu">
							      		<li><a data-toggle="modal" href="#modalImportar" data-target="#modalImportar" class="modalImportar"><i class="fa fa-download"></i> Importar Prospectos</a></li>
							      	</ul>
							 </li>

							 <li class="dropdown">
							    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							      	<i class="fa fa-bar-chart-o fa-lg fa-fw"></i> Reportes
							      	<b class="caret"></b>
							    </a>

							      	<ul class="dropdown-menu">
							      		
							      		<li><?= anchor('reportes/index','<i class="fa fa-bar-chart"></i> Reportes de Prospección'); ?></li>
							      		<li><?= anchor('reportes/opt_generadas','<i class="fa fa-area-chart"></i> Oportunidades Generadas'); ?></li>
							      		<li><?= anchor('reportes/ventas_generadas','<i class="fa fa-line-chart"></i> Ventas Generadas'); ?></li>
							      		<li><?= anchor('reportes/prospectos_descartados','<i class="fa fa-times-circle"></i> Prospectos Descartados'); ?></li>
							      		

							      	</ul>

							 </li>

							 <li class="dropdown">
							    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							      	<i class="fa fa-cog fa-lg fa-fw"></i> Administraciòn
							      	<b class="caret"></b>
							    </a>

							     	<ul class="dropdown-menu">
							      		<li><?= anchor('usuarios/mostrar_usuarios','<i class="fa fa-male"></i> Usuarios'); ?></li>
							      	</ul>

							 </li>

						</ul>

						<?= $this->load->view($contenido); ?>

				   </div><!--.span12 -->
				 </div><!-- .row-fluid-->
		     </div> <!--.container -->
						





		<!-- MODAL NUEVO PROSPECTO -->
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
					</button>
					<h1 class="modal-title"> <i class=" fa fa-user fa-lg"></i> Nuevo Prospecto</h1>
				</div>
			<div class="modal-body">
				<div>
					<?= form_open('prospectos/validar_prospecto',array('class'=>'frm-prosp form-horizontal','id' => 'frmnuevoprosp')); ?>

						
						<div class="control-group form-group">
							<label class="lab control-label" for="empresa"><font color="red"><strong>*</strong></font>Empresa: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'empresa','id'=>'empresa','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="lab control-label" for="titulo">Título: </label>
							<div class="controls">
								<select class="form-control" name="titulo">
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
								<?= form_input(array('class'=>'input_txt required','type'=>'text','name'=>'nombre','id'=>'nombre','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="apellidos">Apellidos: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'apellidos','id'=>'apellidos','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="puesto">Puesto: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'puesto','id'=>'puesto','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="email">Email: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'email','name'=>'email','id'=>'email','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="telefono">Teléfono: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'telefono','id'=>'telefono','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="movil">Móvil: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'movil','id'=>'movil','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="domicilio">Domicilio: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'domicilio','id'=>'domicilio','value'=>''));?>

								<?= form_input(array('class'=>'input_txt span1','type'=>'text','name'=>'cp','id'=>'cp','placeholder'=>'C.P.','value'=>''));?>
							</div>
 
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad">Ciudad: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'ciudad','id'=>'ciudad','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="estado">Estado: </label>
							<div class="controls">
								<?= form_dropdown('estado',$estados,24); ?>
							</div>
						</div>


						<div class="control-group">
							<label class="control-label lab" for="pais">País: </label>
							<div class="controls">
								<?= form_dropdown('pais',$paises,146); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="origen">Origen: </label>
							<div class="controls">
								<?= form_dropdown('origen',$origen); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="web">Página Web: </label>
							<div class="controls">
								<?= form_input(array('class'=>'input_txt','type'=>'text','name'=>'web','id'=>'web','value'=>''));?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label lab" for="ciudad"><font color="red"><strong>*</strong></font>Comentarios: </label>
							<div class="controls">

								<?php $datos = array(
						              'name'        => 'comentarios',
						              'id'          => 'comentarios',
						              'rows'        => '4',
						              'class'       => 'span3 required',
						              'value'		=>''

						            );

        						echo form_textarea($datos);?> 

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

<!-- MODAL CONFIGURAR EMAIL -->
	<div id="modalEmail" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
					</button>
					<h1 class="modal-title"> <i class=" fa fa-envelope fa-lg"></i> Configurar email</h1>
				</div>
			<div class="modal-body">
				
					<?= form_open('usuarios/configurar_email',array('class'=>'frm-prosp frmconfemail form-horizontal','id' => 'frmconfemail')); ?>	

					<div class="row-fluid">
						<div class="span12">	
							<label class="lab" for="tipo_email"><font color="red"><strong>*</strong></font>Tipo: </label>
							<select name="tipo_email" id="tipo_email" autofocus="autofocus"></select>
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="usuario"><font color="red"><strong>*</strong></font>Usuario: </label>
							<input class="required input_txt" type="text" name="usuario" id="usuario" autofocus="autofocus">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="password"><font color="red"><strong>*</strong></font>Contraseña: </label>
							<input class="required input_txt" type="password" name="password" id="password" autofocus="autofocus">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop" id="servidorEntrada"></div> 
					<div class="row-fluid margentop" id="servidorSalida"></div>
					<div class="row-fluid margentop" id="conexionSegura"></div>


				
			
			</div> <!-- .modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar
				</button>

				<button type="submit" class="btn btn-success">Guardar</button>
			</div>


			</div>
		</div>
		<?= form_close(); ?>
	</div>
	

	<!-- MODAL ENVIAR EMAIL -->
	<div id="modalEnviar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
					</button>
					<h1 class="modal-title"> <i class=" fa fa-envelope fa-lg"></i> Enviar email</h1>
				</div>
			<div class="modal-body">
				
					<?= form_open_multipart('usuarios/enviar_email',array('class'=>'frm-prosp form-horizontal','id' => 'frmenviaremail')); ?>	

					<div class="row-fluid">
						<div class="span12">	
							<label class="lab" for="destinatario"><font color="red"><strong>*</strong></font>Para: </label>
							<input class="required input_txt" type="text" name="destinatario" id="destinatario" autofocus="autofocus">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="copia">CC: </label>
							<input class="input_txt" type="text" name="copia" id="copia">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="copiaoculta">CCO: </label>
							<input class="input_txt" type="text" name="copiaoculta" id="copiaoculta">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="asunto">Asunto: </label>
							<input class="input_txt" type="text" name="asunto" id="asunto">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">	
							<label class="lab" for="asunto">Adjuntar archivo: </label>
							<input class="input_txt" type="file" name="userfile" id="userfile">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">
							<textarea class="editorEmail"></textarea>
						</div>
					</div>
				
			
			</div> <!-- .modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar
				</button>

				<button type="submit" class="btn btn-success">Enviar</button>
			</div>


			</div>
		</div>
		<?= form_close(); ?>
	</div>	

	<!-- MODAL IMPORTAR -->
	<div id="modalImportar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
					</button>
					<h1 class="modal-title"> <i class=" fa fa-download fa-lg"></i> Importar prospectos</h1>
				</div>
			<div class="modal-body">
				
				<?= form_open_multipart('herramientas/importar_prospectos',array('class'=>'frmconfemail form-horizontal','id' => 'frmconfemail')); ?>	

					<div class="row-fluid">
						<div class="span12">		
							<p class="lead">El archivo a exportar tiene que estar en <strong>formato CSV</strong></p>
							<input class="input_txt" type="file" name="userfile" id="userfile">
						</div>
					</div> <!--.row-fluid -->

					<div class="row-fluid margentop">
						<div class="span12">
						<span class="label label-info"><strong>Cualquier duda contacta a tu coordinador.</strong></span>
						</div>
					</div>	
			
			</div> <!-- .modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Importar</button>
			</div>


			</div>
		</div>
			<?= form_close(); ?>
	</div>		
			

		<footer>
			<div class="navbar navbar-default navbar-fixed-bottom">
				<div class="container">
					<p class="navbar-text pull-left">
						<?= $this->session->userdata('email');?>
						<?= date('d-m-Y H:i'); ?>
					</p>

					<p class="navbar-text pull-right">
						© Copyright 2014 Suma Ventas Consultores, SC. Todos los derechos reservados
					</p>

				</div>
			
			</div>
			
			<script src="<?= base_url('js/bootstrap.min.js')?>"></script> 
			<script src="<?= base_url('js/timepicker.min.js')?>"></script>
			<script src="<?= base_url('js/myjs.js')?>"></script>
			

	
		</footer>
	</body>

</html>