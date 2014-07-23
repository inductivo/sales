<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarioslib{

	function __construct(){
		$this->CI = & get_instance();
    	$this->CI->load->model('Model_Usuarios');
    	$this->CI->load->model('Model_Perfiles');
    	$this->CI->load->model('Model_Empresas');
	}

	function login($email,$password)
	{
		$query = $this->CI->Model_Usuarios->get_login($email,$password);

		if($query->num_rows() > 0){
			$usuario = $query->row();
			$perfil = $this->CI->Model_Perfiles->find($usuario->id_perfiles);
			$empresa = $this->CI->Model_Empresas->find($usuario->id_empresas);

			$datosSession = array('nombre' => $usuario->nombre,
								  'apellidos' => $usuario->apellidos,
								  'id_empresas' => $usuario->id_empresas,
								  'id_usuarios'=> $usuario->id_usuarios,
								  'email'=> $usuario->email,
								  'id_perfiles' => $usuario->id_perfiles,
								  'perfil' => $perfil->perfil,
								  'ingresado'	=> 1,
								  'iniciales'=>$usuario->iniciales,
								  'empresa' => $empresa->empresa
								 );

			$this->CI->session->set_userdata($datosSession);
			return TRUE;
		}
		else{
			$this->CI->session->sess_destroy();
			return FALSE;
		}
	}

	function cambiar_password($pass_actual,$pass_nuevo)
	{
		if($this->CI->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}
		else
		{
			$id_usuario = $this->CI->session->userdata('id_usuarios');
			$usuario_info = $this->CI->Model_Usuarios->find($id_usuario);

			if($usuario_info->password == $pass_actual)
			{
				$registro = array('id_usuarios' => $id_usuario,
							  'password' => $pass_nuevo);

				$this->CI->Model_Usuarios->update($registro);
			}
			else
			{
				return FALSE;
			}
		}
	}


}