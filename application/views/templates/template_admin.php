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
					

				      <a class="brand" href="<?php echo site_url('home/dashboard')?>">
				      <?= $this->session->userdata('empresa'); ?>
				      </a>

				     
				      	<ul class="nav">
				      		<li class="divider-vertical"></li>
				      		<li><a><?= $titulo ?></a></li>
				      		<li><a data-toggle="modal" href="#myModal" data-target="#myModal" class="mymodal"> Nuevo Prospecto</a></li>
				      	</ul>

				      	<ul class="nav pull-right">
				      		<li><a href="#">Alertas <span class="badge badge-important">17</span></a></li>
				      		<li class="dropdown">
				      			<a href="#" class="dropdown-toggle nombre_usuario" data-toggle="dropdown">
				      				<i class="fa fa-user fa-lg"></i>
				      				 <?= $this->session->userdata('nombre'); ?> <?= $this->session->userdata('apellidos'); ?>
				      				<b class="caret"></b>
				      			</a>
				      			<ul class="dropdown-menu">
				      				<li class="nav-header">Mi cuenta</li>
				      				<li><a href="<?php echo site_url('home/cambiar_password')?>"><i class="fa fa-asterisk"></i> Cambiar contraseña</a></li>
				      				<li><a href="<?php echo site_url('home/cerrar_sesion')?>" ><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
				      			</ul>
				      		</li> 		
				      	</ul>

				      

					</div>
				</div>
			</div>

		</header>
			<div class="container">
		
							      	<ul class="nav nav-tabs">

							      		<li><?= anchor('home/dashboard','<i class=" fa fa-calendar fa-lg fa-fw "></i> Agenda'); ?></li>

							      		<li><?= anchor('prospectos/index','<i class=" fa fa-user fa-lg fa-fw "></i> Prospectos'); ?></li>

							      		<li><?= anchor('oportunidades/index','<i class=" fa fa-dot-circle-o fa-lg fa-fw "></i> Oportunidades'); ?></li>

							      		<li><a href="#"><i class="fa fa-group fa-lg fa-fw"></i> Clientes</a></li>

							      		<li class="dropdown">
							      			<a lass="dropdown-toggle" data-toggle="dropdown"  href="#">
							      				<i class="fa fa-wrench fa-lg fa-fw"></i> Herramientas
							      				<b class="caret"></b>
							      			</a>

							      			<ul class="dropdown-menu">
							      				<li> <a href="#"> Prospectos Inactivos</a> </li>
							      				<li> <a href="#"> Clientes Inactivos</a> </li>

							      			</ul>


							      		</li>

							      		<li class="dropdown">
							      			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							      				<i class="fa fa-bar-chart-o fa-lg fa-fw"></i> Reportes
							      				<b class="caret"></b>
							      			</a>

							      			<ul class="dropdown-menu">
							      				<li> <a href="#"> Reportes de Prospecciòn</a> </li>
							      				<li> <a href="#"> Reportes de Clientes</a> </li>
							      				<li> <a href="#"> Reportes de Ventas</a> </li>

							      			</ul>

							      		</li>

							      		<li class="dropdown">
							      			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							      				<i class="fa fa-cog fa-lg fa-fw"></i> Administraciòn
							      				<b class="caret"></b>
							      			</a>

							      			<ul class="dropdown-menu">
							      				<li> <a href="#"> Usuarios</a> </li>
							      			</ul>

							      		</li>

							      	</ul>
								
							     </div> <!--.container -->
						<?= $this->load->view($contenido); ?>
				
			

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