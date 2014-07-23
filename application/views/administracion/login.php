<div class="container">

		<?= form_open ('administracion/validar_login', array('class'=>'myform')); ?>
			<h2 class="titulo">Sales System Suma <small><font color="red"><b>Administración</b></font></small></h2>

			<?= validation_errors('<div class="alert alert-danger">','</div>'); ?>

			<div class="input-prepend">
				<span class="add-on"><i class="fa fa-user fa-lg"></i></span>
				<?= form_input(array('class'=>'form-control', 'type' => 'text', 'placeholder' => 'Email', 'name'=>'email','value' => set_value('email'))); ?>
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="fa fa-asterisk fa-lg"></i></span>
				<?= form_input(array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Contraseña', 'name' => 'password')); ?>
			</div>

			<?= form_button(array('type' => 'submit', 'class' => 'btn btn-success btn-large', 'content' => 'Iniciar sesiòn')); ?>

			
		<?= form_close ();?>

</div>