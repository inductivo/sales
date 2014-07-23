<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Empresas extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function find($id_empresas) {
    	$this->db->where('id_empresas', $id_empresas);
		return $this->db->get('empresas')->row();
    }
	
}