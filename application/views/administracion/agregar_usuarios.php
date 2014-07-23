<section style="background:#f5f5f5;">
        <div class="container">
            <div class="row">
                <div class="board">
                   
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li>
                     <a href="#" data-toggle="tab" title="Agregar empresa">
                      <span class="round-tabs one">
                              <i class="fa fa-building-o"></i>
                      </span> 
                  </a></li>

                  <li class="active"><a href="#" data-toggle="tab" title="Agregar grupos">
                     <span class="round-tabs two">
                         <i class="fa fa-tags"></i>
                     </span> 
                     </a>
                 </li>
                 <li class="active"><a href="#" data-toggle="tab" title="Agregar perfiles">
                     <span class="round-tabs three">
                          <i class="fa fa-sitemap"></i>
                     </span> </a>
                     </li>

                     <li class="active"><a href="#" data-toggle="tab" title="Agregar usuarios">
                         <span class="round-tabs four">
                              <i class="fa fa-users"></i>
                         </span> 
                     </a></li>

                     <li><a href="#" data-toggle="tab" title="Fin de la configuración">
                         <span class="round-tabs five">
                              <i class="fa fa-check"></i>
                         </span> </a>
                     </li>
                     
                     </ul></div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">

                          <h3 class="head text-center">AGREGAR USUARIOS</h3>
                          <p class="narrow text-center">

                      </div>     
                          
                      </div>             
</div>

</div>


  <div class="row">
    <div class="span2"></div>
    <div class="span8">

       <?= form_open('administracion/validar_perfiles',array('class'=>'myform-grupos')); ?>

          <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

          <div class="controls controls-row btntxt">
           <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Nombre', 'name'=>'nombre','value' => set_value('nombre'))); ?>

            <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Apellidos', 'name'=>'apellidos','value' => set_value('apellidos'))); ?>

            <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Iniciales', 'name'=>'iniciales','value' => set_value('iniciales'))); ?>
          </div>

        <div class="controls controls-row btntxt">
          <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Email', 'name'=>'email','value' => set_value('email'))); ?>

          <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Teléfono', 'name'=>'telefono','value' => set_value('telefono'))); ?>

          <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Ciudad', 'name'=>'ciudad','value' => set_value('ciudad'))); ?>
        </div>

        <div class="controls controls-row btntxt">
          

          <?= form_dropdown('estado',$estados,24,'class="span2"'); ?>

          <?= form_dropdown('pais',$paises,146,'class="span2"'); ?>

          <?php echo timezone_menu('UM8','class="zonahoraria"');  ?>

        </div>

         <div class="controls controls-row btntxt">


          <?=
           
            form_dropdown('id_grupos',$grupos,'class="span4"');
          ?>

          <?= form_input(array('class'=>'span4 input_txt', 'type' => 'text', 'placeholder' => 'Seleccionar perfil', 'name'=>'perfil','value' => set_value('perfil'))); ?>
        </div>



       <?= form_close(); ?>


    </div>
    <div class="span2"></div>
  </div>



<div class="clearfix"></div>



</div>
</div>                        
</section>
