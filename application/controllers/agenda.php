<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('usuariosLib');
		$this->load->model('model_usuarios');
		$this->load->model('model_administracion');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->model('model_clientes');
		$this->load->model('model_agenda');
		
	}

	public function index()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'administrador/agenda/dashboard';
				$data['titulo'] = 'Dashboard ADMIN';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/agenda/dashboard';
					$data['titulo'] = 'Dashboard MM';
					$data['paises'] = $this->model_administracion->obtener_paises();
			   		$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} else if ($perfil->nivel == 2)
			{
				$data['contenido'] = 'ejecutivo/agenda/dashboard';
				$data['titulo'] = 'Dashboard EV';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_ev',$data);
			}

		}
	}

	public function act_realizada($id_act)
	{

		//Se crea un arreglo donde cambia el estatus a 2 = Actividad Realizada
		$registro['id_actividad'] = $id_act;
		$registro['estatus'] = 2;

		$this->model_agenda->actualizar_actividad($registro);

		$this->index();
		echo '<div class="alert alert-warning caja-error alerta" align="center">Actividad Realizada!<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';


	}

	


}//Fin de la Clase

