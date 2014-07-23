<div class="container">

		<?= form_open ('home/validar_cambiar_password', array('class'=>'myform')); ?>
			<h3>Cambiar Contraseña</h3>

			<?= validation_errors('<div class="alert alert-danger">','</div>'); ?>

			<div class="input-prepend">
				<span class="add-on"><font color="black"><i class="fa fa-asterisk fa-lg"></i></font></span>
				<?= form_input(array('class'=>'form-control', 'type' => 'password', 'placeholder' => 'Contraseña Actual', 'name'=>'pass_actual')); ?>
			</div>

			<div class="input-prepend">
				<span class="add-on"><font color="#5bb75b"><i class="fa fa-asterisk fa-lg"></font></i></span>
				<?= form_input(array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Nueva Contraseña', 'name' => 'pass_nuevo')); ?>
			</div>

			<div class="input-prepend">
				<span class="add-on"><font color="#5bb75b"><i class="fa fa-asterisk fa-lg"></i></font></span>
				<?= form_input(array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Confirma Nueva Contraseña', 'name' => 'cpass_nuevo')); ?>
			</div>

			<?= form_button(array('type' => 'submit', 'class' => 'btn btn-success btn-large', 'content' => 'Aceptar')); ?>

			
		<?= form_close ();?>

</div>