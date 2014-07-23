<section style="background:#f5f5f5;">
        <div class="container">
            <div class="row">
                <div class="board">
                   
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li class="active">
                     <a href="#" data-toggle="tab" title="Agregar empresa">
                      <span class="round-tabs one">
                              <i class="fa fa-building-o"></i>
                      </span> 
                  </a></li>

                  <li><a href="#" data-toggle="tab" title="Agregar grupos">
                     <span class="round-tabs two">
                         <i class="fa fa-tags"></i>
                     </span> 
                     </a>
                 </li>
                 <li><a href="#" data-toggle="tab" title="Agregar perfiles">
                     <span class="round-tabs three">
                          <i class="fa fa-sitemap"></i>
                     </span> </a>
                     </li>

                     <li><a href="#" data-toggle="tab" title="Agregar usuarios">
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

                          <h3 class="head text-center">INICIAR CONFIGURACIÓN</h3>
                          <p class="narrow text-center">

                          <?= form_open('administracion/validar_empresa',array('class'=>'myform')); ?>

                      
                        <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

                      <div class="span3">

                        <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-building-o"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Empresa', 'name'=>'empresa','value' => set_value('empresa'))); ?>
                        </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-home"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Domicilio', 'name'=>'domicilio','value' => set_value('domicilio'))); ?>
                         </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-phone-square"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Teléfono', 'name'=>'telefono','value' => set_value('telefono'))); ?>
                         </div>

                      </div>

                    <div class="span3">

                        <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-globe"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Ciudad', 'name'=>'ciudad','value' => set_value('ciudad'))); ?>
                        </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-globe"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Estado', 'name'=>'estado','value' => set_value('estado'))); ?>
                         </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-flag-o"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'País', 'name'=>'pais','value' => set_value('pais'))); ?>
                         </div>

                    </div>

                     <div class="span3 btnform">

                        <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-user"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Contacto', 'name'=>'contacto','value' => set_value('contacto'))); ?>
                        </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-mobile"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Móvil', 'name'=>'movil','value' => set_value('movil'))); ?>
                         </div>

                         <div class="input-prepend">
                          <span class="add-on"><i class="fa fa-envelope-o"></i></span>
                          <?= form_input(array('class'=>'input_txt', 'type' => 'email', 'placeholder' => 'Email', 'name'=>'email','value' => set_value('email'))); ?>
                         </div>

                           <?=form_hidden ('id_usuarios_admin', $this->session->userdata('id_usuarios_admin'));?>
                          
                          </div>
            
                        
                        <p class="text-right pbtn">
                          <button class="btn btn-success" type="submit">Continuar </button>
                        </p>

                       <?= form_close(); ?>
                           
                          
                            
                          </p>
                          
                          
                      </div>
                      
                      
<div class="clearfix"></div>
</div>

</div>
</div>
</div>
</section>

