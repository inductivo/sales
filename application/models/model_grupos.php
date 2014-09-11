<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Grupos extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function find($id_grupos) {
    	$this->db->where('id_grupos', $id_grupos);
		return $this->db->get('grupos')->row();
    }
	
}