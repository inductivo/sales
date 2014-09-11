<DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta description ="Sales System Suma" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
		
		<link href="<?= base_url('css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/administracion.css')?>" rel="stylesheet"  type= "text/css">
		<link href="<?= base_url('css/panel-control.css')?>" rel="stylesheet"  type= "text/css">
		<link href="<?= base_url('css/normalize.css')?>" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

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

				      <a class="brand" href="<?php echo site_url('administracion/panelcontrol')?>">
				      	<?= $this->session->userdata('nombre'); ?>
				      	<?= $this->session->userdata('apellidos'); ?>
				      </a>

				      <div class="nav-collapse collapse">
				      	<ul class="nav">
				      		<li class="divider-vertical"></li>
				      		<li><a><?= $titulo ?></a></li>
				      		<li><a href="<?php echo site_url('administracion/agregar_empresa')?>">Nueva Empresa</a>
				      		</li>
				      		<li><a href="#">Consultas</a>
				      		</li>

				      	</ul>

				      	<ul class="nav pull-right">
				      		<li><a href="<?php echo site_url('administracion/cerrar_sesion')?>" >Cerrar sesiòn</a></li>
				      	</ul>

				      </div>

					</div>
				</div>
			</div>

		</header>

			<?= $this->load->view($contenido); ?>


		<footer>
			<div class="navbar navbar-default">
				<div class="container">

					<ul class="nav pull-left">
				      		<li class="divider-vertical"></li>
				      		<li><a class="text-center"><?= $this->session->userdata('email');?></a></li>
				      		<li><a class="text-center"><?= date('d-m-Y H:i'); ?></a></li>
				    </ul>

				    <ul class="nav pull-right">
				      		<li><a class="text-center">© Copyright 2014 Suma Ventas Consultores, SC. Todos los derechos reservados</a></li>
				      		<li class="divider-vertical"></li>
				    </ul>

				</div>
			
			</div>

			
			<script src="<?= base_url('js/bootstrap.min.js')?>"></script> 
			<script type="text/javascript">
		        $(function(){
		          $('a[title]').tooltip();
		          });
      		</script> 
			 

		</footer>
	</body>


</html>