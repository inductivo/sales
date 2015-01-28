<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Usuarios extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	/* Funciòn para validar el logeo*/
	function get_login($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('usuarios');
    }

    function find($id_usuario)
    {
    	$this->db->where('id_usuarios', $id_usuario);
		return $this->db->get('usuarios')->row();
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id_usuarios', $registro['id_usuarios']);
		$this->db->update('usuarios');
    }

    function obtener_nivel($id_perfil)
    {
        $this->db->where('id_perfiles', $id_perfil);
        return $this->db->get('perfiles')->row();  
    }

    function mostrar_usuarios($id_empresa)
    {

      $this->db->select('usuarios.*,estados.*,paises.*,grupos.*,perfiles.*');
      $this->db->from('usuarios');
      $this->db->join('estados','usuarios.estado = estados.id','inner');
      $this->db->join('paises','usuarios.pais = paises.id','inner');
      $this->db->join('grupos','usuarios.id_grupos = grupos.id_grupos','inner');
      $this->db->join('perfiles','usuarios.id_perfiles = perfiles.id_perfiles','inner');
      $this->db->where('usuarios.id_empresas',$id_empresa);

      $query = $this->db->get();
      return $query->result();

    }

    function numusuarios($id_empresa)
    { 
        $this->db->select('usuarios.*');
        $this->db->from('usuarios');
        $this->db->where('id_empresas',$id_empresa);
        return $this->db->count_all_results();

    }

    /*Se obtiene el listado de los tipos de email que se puedes
    configurar (gmail, hotmail, corporativo)*/

    public function obtener_tipo_email()
      {
        $query = $this->db->query('SELECT * FROM tipo_email'); 
        $arreglo = array();

        if($query->num_rows() > 0)
        {
           foreach($query->result() as $registro)
           {

            $arreglo[] = array(
                'id_tipo_email'=> $registro->id_tipo_email,
                'tipo_email' => $registro->tipo_email
              );    
           }
        }
            $json = json_encode($arreglo);
            echo $json;              
      }



}