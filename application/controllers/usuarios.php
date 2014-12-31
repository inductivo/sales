<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('usuariosLib');
		$this->load->model('model_usuarios');
		$this->load->model('model_administracion');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->model('model_clientes');
		$this->load->model('model_agenda');
		$this->load->model('model_reportes');
		
	}

	public function mostrar_usuarios()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'usuarios/usuarios';
				$data['titulo'] = 'Usuarios';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'usuarios/usuarios';
					$data['titulo'] = 'Usuarios';
					$data['paises'] = $this->model_administracion->obtener_paises();
			    	$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} 

		}
	}

	


}//Fin de la Clase

