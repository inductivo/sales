<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Clientes extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

  public function numclientes($id_usuario){

        $this->db->where('id_usuarios', $id_usuario);
        $this->db->where('status',2);
        $this->db->from('oportunidades_usuarios');
       return $this->db->count_all_results();

    }

  //Muestra la tabla con los Clientes de cada usuario
    public function mostrar_clientes($id_usuario)
    { 
      $this->db->select('oportunidades.*, prospectos.*, oportunidades_usuarios.*,fases_opt.*,ventas.*,anticipos_ventas.*,anticipos.*');
      $this->db->from('oportunidades');
      $this->db->join('prospectos','prospectos.id_prospectos = oportunidades.id_prospectos','inner');
      $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
      $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt','inner');
      $this->db->join('ventas','oportunidades.id_oportunidades = ventas.id_oportunidades');
      $this->db->join('anticipos_ventas','ventas.id_ventas = anticipos_ventas.id_ventas');
      $this->db->join('anticipos','anticipos_ventas.id_anticipos = anticipos.id_anticipos');

      $this->db->where('id_usuarios',$id_usuario);
      $this->db->where('oportunidades_usuarios.status',2);
      $this->db->order_by('oportunidades.cierre','asc');

      $query = $this->db->get();
      return $query->result();

    }

    public function obtener_comisiones($id_usuario)
    {
     $this->db->select('oportunidades.*, oportunidades_usuarios.*');
     $this->db->from('oportunidades');
     $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');

     $this->db->where('id_usuarios',$id_usuario);
     $this->db->where('oportunidades_usuarios.status',2);

     $query = $this->db->get();

     $suma=0;

      foreach ($query->result() as $registro) {
        $suma = $suma + $registro->comision;
      }

      return $suma;

    }
 

}