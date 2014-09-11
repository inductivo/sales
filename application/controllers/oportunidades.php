<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oportunidades extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('model_administracion');
		$this->load->model('model_usuarios');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->library('calendar');

	}



	public function index()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		} else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'oportunidades/index';
				$data['titulo'] = 'Oportunidades Admin';
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'oportunidades/index';
				$data['titulo'] = 'Oportunidades MM';
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{	
				$data['contenido'] = 'oportunidades/index';
				$data['titulo'] = 'Oportunidades EV';
				$this->load->view('templates/template_ev',$data);	
			}
		}	

		
	}

	
}