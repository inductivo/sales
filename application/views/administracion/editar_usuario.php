
<script type="text/javascript">
  var path = '<?php echo base_url()?>';

  jQuery(document).ready(function() {
    cargarPerfiles();
  

    $('#grupos').change(cargarPerfiles);

  });

  function cargarPerfiles(){
    var g = $('#grupos').val();

    $.get(path + 'administracion/cargar_perfiles', {'id' : g}, function(resp) {
      $('#perfiles').empty().html(resp);

    });
  }

 

</script>

<section style="background:#f5f5f5;">
        <div class="container">
            <div class="row">
                <div class="board">
                   
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li>
                     <a  data-toggle="tab" title="Agregar empresa">
                      <span class="round-tabs one">
                              <i class="fa fa-building-o"></i>
                      </span> 
                  </a></li>

                  <li class="active"><a  data-toggle="tab" title="Agregar grupos">
                     <span class="round-tabs two">
                         <i class="fa fa-tags"></i>
                     </span> 
                     </a>
                 </li>
                 <li class="active"><a  data-toggle="tab" title="Agregar perfiles">
                     <span class="round-tabs three">
                          <i class="fa fa-sitemap"></i>
                     </span> </a>
                     </li>

                     <li class="active"><a  data-toggle="tab" title="Agregar usuarios">
                         <span class="round-tabs four">
                              <i class="fa fa-users"></i>
                         </span> 
                     </a></li>

                     <li><a  data-toggle="tab" title="Fin de la configuración">
                         <span class="round-tabs five">
                              <i class="fa fa-check"></i>
                         </span> </a>
                     </li>
                     
                     </ul></div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active">

                          <h3 class="head text-center">Editar Usuario</h3>
                          <p class="narrow text-center"><p>

        <div class="margen-form">
          <?= form_open('administracion/validar_editar_usuario',array('class'=>'myform-grupos')); ?>

            <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

              <?=form_hidden ('id_usuarios', $datos_usuario->id_usuarios);?>
              
              <?=form_hidden ('id_empresas', $empresa->id_empresas);?>

                <div class="controls controls-row btntxt">
                 <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Nombre', 'name'=>'nombre','value' => $datos_usuario->nombre)); ?>

                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Apellidos', 'name'=>'apellidos','value' => $datos_usuario->apellidos)); ?>

                  <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Iniciales', 'name'=>'iniciales','value' => $datos_usuario->iniciales)); ?>
                </div>

                <div class="controls controls-row btntxt">
                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'email', 'placeholder' => 'Email', 'name'=>'email','value' => $datos_usuario->email)); ?>

                  <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Teléfono', 'name'=>'telefono','value' => $datos_usuario->telefono)); ?>

                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Ciudad', 'name'=>'ciudad','value' => $datos_usuario->ciudad)); ?>
                </div>

                <div class="controls controls-row btntxt">
                  

                  <?= form_dropdown('estado',$estados,$datos_usuario->estado,'class="span2"'); ?>

                  <?= form_dropdown('pais',$paises,$datos_usuario->pais,'class="span2"'); ?>

                  

                  <?php echo timezone_menu('UM7','span3'); ?>

                </div>

                 <div class="controls controls-row btntxt">
                
                  <select name="id_grupos" id="grupos" class="span3">
                    <?php foreach ($grupos as $gpo): ?>
                      <option value="<?php echo $gpo->id_grupos?>"><?php echo $gpo->grupo ?></option>
                    <?php endforeach; ?>
                  </select>

                   <select name="id_perfiles" id="perfiles" class="span4"></select>


                  <div class="text-center p-top">

                      <button type="submit" class="btn btn-primary">
                        Guardar                          
                      </button>

                      <?= anchor('administracion/agregar_usuarios', 'Cancelar',array('class' => 'btn btn-danger', 'type'=>'button')); ?>

                  </div>   

                    <?= form_close(); ?>

                </div>



         </div>

           







    </div>     
                          
  </div>  

</div>


</div>
 
<div class="clearfix"></div>

</div>                        
</section>






