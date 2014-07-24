<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Administracion extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	/* Funciòn para validar el logeo*/
	function get_login($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('usuarios_admin');
    }

    function agregar_empresa($registro)
    {
    	$this->db->set($registro);
    	$this->db->insert('empresas');
		
		//$id_empresa = $this->db->query('SELECT max(id_empresas) AS id_empresas FROM empresas ');
    }

    function buscar_empresa(){
    	$this->db->select_max('id_empresas');
    	$this->db->from('empresas');
    	$this->db->join('usuarios_admin','usuarios_admin.id_usuarios_admin = empresas.id_usuarios_admin','inner');
    	$query = $this->db->get()->row();

    	return $query;


    	/*$this->db->select('SELECT max(id_empresas) FROM empresas 
			INNER JOIN usuarios_admin on usuarios_admin.id_usuarios_admin = empresas.id_usuarios_admin',FALSE);*/
    	

    }

    function agregar_grupo($registro)
    {
    	$this->db->set($registro);
    	$this->db->insert('grupos');
    }

    //Despliega el listado de los grupos
    function mostrar_grupos($id_empresa)
    {
    	$this->db->where('id_empresas',$id_empresa);
    	$query = $this->db->get('grupos');
    	return $query->result();

    }

    //Busca el grupo para editarlo
    function buscar_grupo($id_grupo)
    {
    	$this->db->where('id_grupos',$id_grupo);
    	return $this->db->get('grupos')->row();
    }

    //Busca el grupo para obtener el ID y agregar el perfil Default
    function buscar_grupo_default($id_empresa){
        $this->db->select_max('id_grupos');
        $this->db->where('id_empresas',$id_empresa);
        $this->db->from('grupos');
      
        $query = $this->db->get()->row();

        return $query;
        

    }

    function actualizar_grupo($registro)
    {
    	$this->db->set($registro);
    	$this->db->where('id_grupos',$registro['id_grupos']);
    	$this->db->update('grupos');
    }

    function eliminar_grupo($id_grupo) {
        $this->db->where('id_grupos', $id_grupo);
		$this->db->delete('grupos');
       
    }

    function mostrar_grupos_dropdown($empresa)
    {
        $id_empresa = $empresa->id_empresas;
        $this->db->where('id_empresas',$id_empresa);
        $query = $this->db->get('grupos');
        
        if($query->num_rows > 0)
        {
            foreach ($query->result() as $row) {
                $registro[$row->id_grupos] = $row->grupo;
            }
            return $registro;
        }
    }

    function agregar_perfil($registro)
    {
        $this->db->set($registro);
        $this->db->insert('perfiles');
    }



     function mostrar_perfiles($id_empresa)
    {
        $this->db->select('perfiles.* , grupos.grupo');
        $this->db->where('perfiles.id_empresas',$id_empresa);
        $this->db->from('perfiles');
        $this->db->join('grupos','perfiles.id_grupos = grupos.id_grupos','left');
    
        $query = $this->db->get();
        return $query->result();

    }

    //Esta función nos muestra los perfiles para cargarlos dependiendo del grupo que seleccionamos
    function devolver_perfiles($id_grupo)
    {
        $query = $this->db->where('id_grupos',$id_grupo)->get('perfiles');
        
        $cadena = "";

        foreach($query->result_array() as $registro)
        {
            $cadena.="<option value = '{$registro['id_perfiles']}'>{$registro['perfil']}</option>";
        }
            echo $cadena;
    }

     //Busca el perfil para editarlo
    function buscar_perfil($id_perfil)
    {
        $this->db->where('id_perfiles',$id_perfil);
        return $this->db->get('perfiles')->row();
    }

     function actualizar_perfil($registro)
    {
        $this->db->set($registro);
        $this->db->where('id_perfiles',$registro['id_perfiles']);
        $this->db->update('perfiles');
    }

     function eliminar_perfil($id_perfil) {
        $this->db->where('id_perfiles', $id_perfil);
        $this->db->delete('perfiles');
       
    }

//OBTENER PAISES Y ESTADOS PARA MOSTRARLOS EN UN DROPDOWN LIST
    function obtener_paises(){  
                $query = $this->db->query('SELECT id, pais FROM paises');  
                if($query->num_rows > 0){

                    foreach($query->result() as $row){
                            $data[$row->id] = $row->pais;
                    }
                    return $data;
                } 
    }

    function obtener_estados(){  
                $query = $this->db->query('SELECT id, estado FROM estados');  
                if($query->num_rows > 0){

                    foreach($query->result() as $row){
                            $data[$row->id] = $row->estado;
                    }
                    return $data;
                } 
    }  

}