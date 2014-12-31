<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Agenda extends CI_Model{

	function __construct(){
		parent:: __construct();
	}


     public function mostrar_agenda($id_usuario)
    { 
      $this->db->select('prospectos.*,prospectos_usuarios.*,actividad_prospectos.*,actividad.*,tipo.*');
      $this->db->from('prospectos');
      $this->db->join('prospectos_usuarios','prospectos.id_prospectos = prospectos_usuarios.id_prospectos','inner');
      $this->db->join('actividad_prospectos','prospectos_usuarios.id_prospectos = actividad_prospectos.id_prospectos','inner');
      $this->db->join('actividad','actividad_prospectos.id_actividad = actividad.id_actividad','inner');
      $this->db->join('tipo','actividad.id_tipo = tipo.id_tipo');

      $this->db->where('id_usuarios',$id_usuario);
      $this->db->where('actividad.estatus',1);
      $this->db->order_by('actividad.fecha','asc');
      $this->db->order_by('actividad.hora','asc');
      $query = $this->db->get();
      return $query->result();

    }

    public function actualizar_actividad($registro)
    {

      $this->db->set($registro);
      $this->db->where('id_actividad', $registro['id_actividad']);
      $this->db->update('actividad');
    }
    
     public function agregar_actividad($actividad,$prospecto,$usuario,$id_act)
    {
      $this->db->set($actividad);
      $this->db->insert('actividad');

      $this->db->select_max('id_actividad');
      $this->db->from('actividad');
      $query = $this->db->get()->row();

      $act_prosp = array(
        'id_actividad' => $query->id_actividad,
        'id_prospectos' => $prospecto
        );

      $this->db->set($act_prosp);
      $this->db->insert('actividad_prospectos');

       /*Se agrega a la tabla Actividad - Usuarios*/ 
      $act_user = array(
        'id_actividad' => $query->id_actividad,
        'id_usuarios' => $usuario
        );

      $this->db->set($act_user);
      $this->db->insert('actividad_usuarios');

     

      //SE ACTUALIZA LA ACTIVIDAD A REAGENDADA
       $cambiar_stat= array(
          'estatus' => 3
        );

      $this->db->set($cambiar_stat);
      $this->db->where('id_actividad',$id_act);
      $this->db->update('actividad');



    }
    
      public function buscar_actividad($id) {

        $this->db->where('id_actividad', $id);
        $query = $this->db->get('actividad')->row();

        // lo convierto a JSON
        $json = json_encode($query);

        // devuelvo el JSON
        echo $json;   
      }

      public function fecha_vencida($fecha,$var)
    {
        
      $fecha_actual = strtotime(date("d-m-Y"));
      $fecha_entrada = strtotime($fecha);
        
      if($fecha_actual > $fecha_entrada){
          if($var == 0)
          {
           echo '<span class="badge badge-important">Existen Fechas Vencidas</span> <br> <br>'; 
          }
          
        echo '<tr class="error" >';
        }else
        {echo '<tr>'; }    
    }

}