<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Oportunidades extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

  public function numoportunidades($id_usuario){

        $this->db->where('id_usuarios', $id_usuario);
        $this->db->where('status',1);
        $this->db->from('oportunidades_usuarios');
       return $this->db->count_all_results();

    }

  //Muestra la tabla con los Oportunidades de cada usuario
    public function mostrar_oportunidades($id_usuario)
    { 
      $this->db->select('oportunidades.*, prospectos.*, oportunidades_usuarios.*,fases_opt.*');
      $this->db->from('oportunidades');
      $this->db->join('prospectos','prospectos.id_prospectos = oportunidades.id_prospectos','inner');
      $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
      $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt','inner');
      
      $this->db->where('id_usuarios',$id_usuario);
      $this->db->where('oportunidades_usuarios.status',1);
      $this->db->order_by('oportunidades.cierre','asc');

      $query = $this->db->get();
      return $query->result();

    }

     public function convertir_fecha($fecha)
    {
        setlocale(LC_TIME, 'spanish');
        $fecha_m = explode("-", $fecha);
        $dia_m =$fecha_m[2];
        $mes_m =$fecha_m[1];
        $nombre_mes=strftime("%B",mktime(0, 0, 0, $mes_m, 1, 2000)); 
        $anio_m=$fecha_m[0];
        $fecha_final= $dia_m.'-'.$nombre_mes.'-'.$anio_m;
        
        echo $fecha_final;

    }

    public function obtener_certeza($certeza)
    {
        if($certeza <= 40)
        {
          echo '<span class="badge badge-important">'.$certeza.'% </span>';
            

        }else if($certeza > 40 && $certeza < 80){
            echo '<span class="badge badge-warning">'.$certeza.'% </span>';
        }else if($certeza >= 80)
        {
             echo '<span class="badge badge-success">'.$certeza.'% </span>';
        }
    }
	 

}