<DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta description ="Sales System Suma" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/> 
		
		<link href="<?= base_url('css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet" media="screen">
		<link href="<?= base_url('css/estilos.css')?>" rel="stylesheet"  type= "text/css" media="screen">
		<link href="<?= base_url('css/normalize.css')?>" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="<?= base_url('js/bootstrap.min.js')?>"></script>  

	</head>

	<body class="cuerpo">
		<header></header>
		
			<?= $this->load->view($contenido); ?>


		<footer>
			<div class="pie">
			
			<p>© Copyright 2014 Suma Ventas Consultores, SC. Todos los derechos reservados</p>
				
			</div>
		</footer>
	</body>


</html>