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
      $this->db->update('actividad', $registro);
    }
 

}