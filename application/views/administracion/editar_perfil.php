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
                 <li><a  data-toggle="tab" title="Agregar perfiles">
                     <span class="round-tabs three">
                          <i class="fa fa-sitemap"></i>
                     </span> </a>
                     </li>

                     <li><a  data-toggle="tab" title="Agregar usuarios">
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
                      <div class="tab-pane fade in active" id="home">

                          <h3 class="head text-center"> EDITAR PERFILES</h3>
                          <p class="narrow text-center">

                          <?= form_open('administracion/validar_editar_perfil',array('class'=>'myform-grupos')); ?>

                              <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

                                 <!-- SPAN 1-->
                                <div class="span3"></div>

                                <!-- SPAN 2-->
                                <div class="span3">

                                     <div class="input-append">
                                    
                                        <?=form_hidden ('id_perfiles', $registro->id_perfiles);?>

                                        <?= form_input(array('class'=>'input_txt', 'type' => 'text','name'=>'perfil','value' => $registro->perfil)); ?>

                                       
                                        <button type="submit" class="btn btn-success btn-number">
                                          <span><i class="fa fa-check-circle"></i></span>
                                        </button>

                                    </div>
                                </div>


                          <?= form_close(); ?>


                                <!-- SPAN 3-->

                                 <div class="span3"></div>

                

                
                            
                      
                          
                          
           
                      
                      
<div class="clearfix"></div>
</div>

</div>
</div>
</div>
</section>



