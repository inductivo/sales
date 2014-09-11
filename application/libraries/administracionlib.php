<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administracionlib{

	function __construct(){
		$this->CI = & get_instance();
    	$this->CI->load->model('Model_Administracion');
    	
	}

	function login($email,$password)
	{
		$query = $this->CI->Model_Administracion->get_login($email,$password);

		if($query->num_rows() > 0){

			$usuario = $query->row();
		
			$datosSession = array('id_usuarios_admin'=> $usuario->id_usuarios_admin,
								  'nombre' => $usuario->nombre,
								  'apellidos' => $usuario->apellidos,
								  'email'=> $usuario->email,
								  'ingresado'	=> 1
								  );

			$this->CI->session->set_userdata($datosSession);
			return TRUE;
		}
		else{
			$this->CI->session->sess_destroy();
			return FALSE;
		}
	}


	function existe_email($registro)
	{
		$this->CI->db->where('email', $registro['email']);
		$query = $this->CI->db->get('usuarios');

		if($query->num_rows > 0 AND (!isset($registro['id_usuarios']) OR ($registro['id_usuarios'] != $query->row('id_usuarios'))))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}

	}

}