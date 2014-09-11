
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

                  <li class="active"><a data-toggle="tab" title="Agregar grupos">
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

                     <li class="active"><a data-toggle="tab" title="Agregar usuarios">
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

                          <h3 class="head text-center">AGREGAR USUARIOS</h3>
                          <p class="narrow text-center"><p>

        <div class="margen-form">
          <?= form_open('administracion/validar_usuario',array('class'=>'myform-grupos')); ?>

            <?= validation_errors('<div class="alert alert-danger caja-error">','</div>'); ?>

              <?=form_hidden ('id_empresas', $empresa->id_empresas);?>

                <div class="controls controls-row btntxt">
                 <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Nombre', 'name'=>'nombre','value' => set_value('nombre'))); ?>

                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Apellidos', 'name'=>'apellidos','value' => set_value('apellidos'))); ?>

                  <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Iniciales', 'name'=>'iniciales','value' => set_value('iniciales'))); ?>
                </div>

                <div class="controls controls-row btntxt">
                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'email', 'placeholder' => 'Email', 'name'=>'email','value' => set_value('email'))); ?>

                  <?= form_input(array('class'=>'span2 input_txt', 'type' => 'text', 'placeholder' => 'Teléfono', 'name'=>'telefono','value' => set_value('telefono'))); ?>

                  <?= form_input(array('class'=>'span3 input_txt', 'type' => 'text', 'placeholder' => 'Ciudad', 'name'=>'ciudad','value' => set_value('ciudad'))); ?>
                </div>

                <div class="controls controls-row btntxt">
                  

                  <?= form_dropdown('estado',$estados,24,'class="span2"'); ?>

                  <?= form_dropdown('pais',$paises,146,'class="span2"'); ?>

                  

                  <?php echo timezone_menu('UM7','span3'); ?>

                </div>

                 <div class="controls controls-row btntxt">
                
                  <select name="id_grupos" id="grupos" class="span3">
                    <?php foreach ($grupos as $gpo): ?>
                      <option value="<?php echo $gpo->id_grupos?>"><?php echo $gpo->grupo ?></option>
                    <?php endforeach; ?>
                  </select>

                   <select name="id_perfiles" id="perfiles" class="span4"></select>

                </div>



         </div>

           







    </div>     
                          
  </div>  

</div>

<div class="container-fluid">
<div class="row-fluid">
              <div class="span1"></div>
              <div class="span10 table-responsive text-center">
                <table class="table table-condensed table-hover table-striped table-bordered">
                  <thead class="mithead">
                    <tr>
                      <th class="th-tabla">Nombre</th>
                      
                      <th class="th-tabla">Iniciales</th>
                      <th class="th-tabla">Email</th>
                      <th class="th-tabla">Teléfono</th>
                      <th class="th-tabla">Grupo</th>
                      <th class="th-tabla">Perfil</th>
                      <th class="th-tabla">Acciones</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php 

                      $query= $this->model_administracion->mostrar_usuarios($this->input->post('id_empresas'));

                        foreach ($query as $registro): ?>

                        <tr>
                          <td class="td-tabla1"><?= $registro->nombre ?> <?= $registro->apellidos ?></td>
                         
                          <td class="td-tabla1"> <?= $registro->iniciales ?></td>
                          <td class="td-tabla1"><?= $registro->email ?></td>
                          <td class="td-tabla1"><?= $registro->telefono ?></td>
                          <td class="td-tabla1"><?= $this->model_administracion->mostrar_grupo($registro->id_grupos); ?></td>
                          <td class="td-tabla1"><?= $this->model_administracion->mostrar_perfil($registro->id_perfiles); ?></td>

                          <td class="td-tabla2">
                            <?= anchor('administracion/editar_usuario/'.$registro->id_usuarios,'Editar', array('class' => 'label label-success', 'Editar') );?> |

                            <?= anchor('administracion/eliminar_usuario/'.$registro->id_usuarios,'Eliminar', array('class' => 'label label-important', 'Eliminar','OnClick' => "return confirm('¿Estas seguro de eliminar este usuario?')") );?>

                          </td>

                        </tr>

                      <?php endforeach; ?>

                  </tbody>
                </table>

                  <div class="text-center p-top">

                      <button type="submit" class="btn btn-primary ">
                        Agregar usuario                          
                      </button>

                      <?= anchor('administracion/fin_configuracion', 'Continuar',array('class' => 'btn btn-success', 'type'=>'button')); ?>

                  </div>   

                  <?= form_close(); ?>
              
              
              </div>
              <div class="span1"></div>

        </div>

        </div>

</div>
 


</div>                        
</section>




<div class="clearfix"></div>

