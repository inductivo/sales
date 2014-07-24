<section style="background:#f5f5f5;">
        <div class="container">
            <div class="row">
                <div class="board">
                   
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li>
                     <a data-toggle="tab" title="Agregar empresa">
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
                 <li class="active"><a data-toggle="tab" title="Agregar perfiles">
                     <span class="round-tabs three">
                          <i class="fa fa-sitemap"></i>
                     </span> </a>
                     </li>

                     <li><a data-toggle="tab" title="Agregar usuarios">
                         <span class="round-tabs four">
                              <i class="fa fa-users"></i>
                         </span> 
                     </a></li>

                     <li><a data-toggle="tab" title="Fin de la configuración">
                         <span class="round-tabs five">
                              <i class="fa fa-check"></i>
                         </span> </a>
                     </li>
                     
                     </ul></div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">

                          <h3 class="head text-center">AGREGAR PERFILES</h3>
                          <p class="narrow text-center">

                          <?= form_open('administracion/validar_perfiles',array('class'=>'myform-grupos')); ?>

                              <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

                                 <!-- SPAN 1-->
                                  <div class="span3"></div>

                                <!-- SPAN 2-->
                                <div class="span3">

                                    <?=form_hidden ('id_empresas', $empresa->id_empresas);?>

                                    <div class="lista">
                                      <?= form_dropdown('id_grupos',$grupos); ?>
                                    </div>
                                     



                                     <div class="input-append">
                                      
                                        <?= form_input(array('class'=>'input_txt', 'type' => 'text', 'placeholder' => 'Agregar perfil', 'name'=>'perfil')); ?>
                                       
                                        <button type="submit" class="btn btn-success btn-number">
                                          <span><i class="fa fa-plus"></i></span>
                                        </button>

                                    </div>

                                <!-- SPAN 3-->

                                 <div class="span3 btnform"></div>

                                    <?= form_close(); ?>

                               </div>     
                          
                            </div>
                      
                      
<div class="clearfix"></div>
</div>

</div>
</div>



<div class="row">
  <div class="span1"></div>
  <div class="span10 text-center span-center"> 
    <table class= "table table-condensed">
                    <thead class="mithead">
                      <tr>
                        <th class="th-tabla">Grupo</th>
                        <th class="th-tabla">Perfil</th>
                        <th class="th-tabla">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>


                      <?php
                        $query = $this->model_administracion->mostrar_perfiles($empresa->id_empresas);
                        $cont=0;
                        foreach ($query as $registro): ?>
                          <?php
                                $cont = $cont + 1;
                                if($cont <= 1)
                                { ?>
                                  <td class="td-tabla1"> <?= $registro->grupo ?></td>
                                  <td class="td-tabla1"><b><font color="#3498db"> <?= $registro->perfil ?></font></b></td>
                                  <td class="td-tabla2">
                                  <?= anchor('administracion/editar_perfil/'.$registro->id_perfiles,'Editar', array('class' => 'label label-success','Editar'));?>
                                </td>

                          <?php } else { ?>
                            
                      <td class="td-tabla1"> <?= $registro->grupo ?></td>
                      <td class="td-tabla1"> <?= $registro->perfil ?></td>
                     

                      <td class="td-tabla2">
                        <?= anchor('administracion/editar_perfil/'.$registro->id_perfiles,'Editar', array('class' => 'label label-success','Editar'));?>

                        <?= anchor('administracion/eliminar_perfil/'.$registro->id_perfiles,'Eliminar', array('class' => 'label label-important','Eliminar', 'Onclick' => "return confirm ('¿Estas seguro de eliminar este perfil?')"));?>
                      </td>

                      <!-- Cierre del If que prueba el contador-->
                      <?php } ?>

                    </tr>
                    <?php endforeach;?>

                    </tbody>
                  </table>
    </div>
    <div class="span1">
      <p class="text-right pbtn">
        <?= anchor('administracion/agregar_usuarios', '<i class="fa fa-arrow-right fa-4x fa-fw"></i>Continuar'); ?>
       </p>
    </div>
  </div>


              
</div>                        
</section>
