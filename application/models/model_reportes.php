<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Reportes extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

  //Muestra la tabla con los prospectos descartados de la empresa
	public function mostrar_prosp_descartados($id_empresa)
  {
     
      $this->db->select('empresas.id_empresas,empresas_prospectos.*,prospectos.*,prospectos_usuarios.*,usuarios.id_usuarios,usuarios.iniciales');
      $this->db->from('empresas');
      $this->db->join('empresas_prospectos','empresas.id_empresas = empresas_prospectos.id_empresas','inner');
      $this->db->join('prospectos','empresas_prospectos.id_prospectos = prospectos.id_prospectos ','inner');
      $this->db->join('prospectos_usuarios','prospectos.id_prospectos = prospectos_usuarios.id_prospectos','inner');
      $this->db->join('usuarios','prospectos_usuarios.id_usuarios = usuarios.id_usuarios','inner');
      
      $this->db->where('empresas.id_empresas',$id_empresa);
      $this->db->where('prospectos_usuarios.status',0);

      $query = $this->db->get();
      return $query->result();
  }

  public function cargarUsuarios()
  {
        $empresa= $this->session->userdata('id_empresas');
        $query = $this->db->query('SELECT * FROM usuarios');

        $arreglo = array();

        if($query->num_rows() > 0)
        {
           foreach($query->result() as $registro)
           {

            $arreglo[] = array(
                'id_usuarios'=> $registro->id_usuarios,
                'nombre' => $registro->nombre,
                'apellidos' => $registro->apellidos
              );    
           }
        }
            $json = json_encode($arreglo);
            echo $json;              
  }

  public function reasignar_prospectos($registro)
  {
    $this->db->set($registro);
    $this->db->where('id_prospectos',$registro['id_prospectos']);
    $this->db->update('prospectos_usuarios');
  }

  public function mostrar_opt_generadas($id_empresa)
  {
    $this->db->select('empresas.id_empresas,empresas_oportunidades.*,oportunidades.*,prospectos.*,oportunidades_usuarios.*,fases_opt.*,usuarios.id_usuarios,usuarios.iniciales');
    $this->db->from('empresas');
    $this->db->join('empresas_oportunidades','empresas.id_empresas = empresas_oportunidades.id_empresas','inner');
    $this->db->join('oportunidades','empresas_oportunidades.id_oportunidades = oportunidades.id_oportunidades','inner');
    $this->db->join('prospectos','oportunidades.id_prospectos = prospectos.id_prospectos','inner');
    $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
    $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt','inner');
    $this->db->join('usuarios','oportunidades_usuarios.id_usuarios = usuarios.id_usuarios','inner');

    $this->db->where('empresas.id_empresas',$id_empresa);
    $this->db->where('oportunidades_usuarios.status',1);
    $this->db->order_by('oportunidades.cierre','asc');

    $query = $this->db->get();
    return $query->result();

  }

   public function mostrar_prosp_generados($id_empresa)
  {
   
      $this->db->select('empresas.id_empresas,empresas_prospectos.*,prospectos.*,prospectos_usuarios.*,usuarios.id_usuarios,usuarios.iniciales');
      $this->db->from('empresas');
      $this->db->join('empresas_prospectos','empresas.id_empresas = empresas_prospectos.id_empresas','inner');
      $this->db->join('prospectos','empresas_prospectos.id_prospectos = prospectos.id_prospectos ','inner');
      $this->db->join('prospectos_usuarios','prospectos.id_prospectos = prospectos_usuarios.id_prospectos','inner');
      $this->db->join('usuarios','prospectos_usuarios.id_usuarios = usuarios.id_usuarios','inner');
      
      $this->db->where('empresas.id_empresas',$id_empresa);
      $this->db->where('prospectos_usuarios.status',1);

      $query = $this->db->get();
      return $query->result();

  }

  public function mostrar_ventas_generadas($id_empresa)
  {
    $this->db->select('empresas.id_empresas,empresas_oportunidades.*,oportunidades.*,prospectos.*,oportunidades_usuarios.*,fases_opt.*,ventas.*,anticipos_ventas.*,anticipos.*,usuarios.id_usuarios,usuarios.iniciales');
    $this->db->from('empresas');
    $this->db->join('empresas_oportunidades','empresas.id_empresas = empresas_oportunidades.id_empresas','inner');
    $this->db->join('oportunidades','empresas_oportunidades.id_oportunidades = oportunidades.id_oportunidades','inner');
    $this->db->join('prospectos','oportunidades.id_prospectos = prospectos.id_prospectos','inner');
    $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
    $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt','inner');
    $this->db->join('ventas','oportunidades.id_oportunidades = ventas.id_oportunidades');
    $this->db->join('anticipos_ventas','ventas.id_ventas = anticipos_ventas.id_ventas');
    $this->db->join('anticipos','anticipos_ventas.id_anticipos = anticipos.id_anticipos');
    $this->db->join('usuarios','oportunidades_usuarios.id_usuarios = usuarios.id_usuarios','inner');

    $this->db->where('empresas.id_empresas',$id_empresa);
    $this->db->where('oportunidades_usuarios.status',2);
    $this->db->order_by('oportunidades.cierre','asc');

    $query = $this->db->get();
    return $query->result();

  }

  public function numprospectos_generados($id_empresa)
    {

       $this->db->select('empresas_prospectos.*,prospectos_usuarios.*');
       $this->db->from('empresas_prospectos');
       $this->db->join('prospectos_usuarios','empresas_prospectos.id_prospectos = prospectos_usuarios.id_prospectos','inner');
       $this->db->where('empresas_prospectos.id_empresas', $id_empresa);
       $this->db->where('prospectos_usuarios.status',1);
        
       return $this->db->count_all_results();
    }

   public function numopt_generadas($id_empresa)
   {

      $this->db->select('empresas_oportunidades.*,oportunidades_usuarios.*');
       $this->db->from('empresas_oportunidades');
       $this->db->join('oportunidades_usuarios','empresas_oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
       
       $this->db->where('empresas_oportunidades.id_empresas', $id_empresa);
       $this->db->where('oportunidades_usuarios.status',1);
        
       return $this->db->count_all_results();

    }

    public function numventas_generadas($id_empresa){

       $this->db->select('empresas_oportunidades.*,oportunidades_usuarios.*');
       $this->db->from('empresas_oportunidades');
       $this->db->join('oportunidades_usuarios','empresas_oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
       
       $this->db->where('empresas_oportunidades.id_empresas', $id_empresa);
       $this->db->where('oportunidades_usuarios.status',2);
        
       return $this->db->count_all_results();

    }


}