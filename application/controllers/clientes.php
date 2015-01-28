<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('model_administracion');
		$this->load->model('model_oportunidades');
		$this->load->model('model_usuarios');
		$this->load->model('model_prospectos');
		$this->load->model('model_clientes');
		$this->load->library('calendar');

		//MENSAJES DE VALIDACIÓN
		$this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
		$this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe ser un email correcto');
		$this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe ser númerico');
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
				$data['contenido'] = 'clientes/index';
				$data['titulo'] = 'Clientes';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'clientes/index';
				$data['titulo'] = 'Clientes';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{
				$data['contenido'] = 'clientes/index';
				$data['titulo'] = 'Clientes';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_ev',$data);	
			}
		}	

		
	}

	public function buscar_prospecto()
	{
		$id=$_GET['id_prospectos'];
		$this->model_prospectos->buscar_prospecto($id);
	}

	public function cargarFases()
	{
		$this->model_prospectos->cargarFases();
	}

	public function obtener_tipo_email()
	{
		$this->model_usuarios->obtener_tipo_email();
	}
	

}