<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Perfiles extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function find($id_perfiles) {
    	$this->db->where('id_perfiles', $id_perfiles);
		return $this->db->get('perfiles')->row();
    }
	
}