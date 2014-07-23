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
}