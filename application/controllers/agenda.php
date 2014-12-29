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
				$data['titulo'] = 'Agenda';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/agenda/dashboard';
					$data['titulo'] = 'Agenda';
					$data['paises'] = $this->model_administracion->obtener_paises();
			   		$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} else if ($perfil->nivel == 2)
			{
				$data['contenido'] = 'ejecutivo/agenda/dashboard';
				$data['titulo'] = 'Agenda';
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

	public function validar_reagenda()
	{

		$this->form_validation->set_rules('seguimiento', 'Seguimiento', 'trim|xss_clean');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|xss_clean');
		$this->form_validation->set_rules('hora', 'Hora', 'trim|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|xss_clean'); 

		if($this->form_validation->run())
		{
			$prospecto = $this->input->post('id_prospectos');
			$usuario = $this->session->userdata('id_usuarios');
			$id_act = $this->input->post('id_actividad');
			$tipo = $this->input->post('id_tipo');

			$seguimiento = array(
				'seguimiento' => $this->input->post('seguimiento'),
				'hora'	=> date('H:i'),
				'fecha'	=>	date('Y/m/d')
				);

			$actividad = array(
				'hora' => $this->input->post('hora'),
				'fecha' => $this->input->post('fecha'),
				'actividad' => $this->input->post('actividad'),
				'estatus' => 1,
				'id_tipo' => $tipo
				);


			/* Estatus
			 1 -> No realizada
			 2 -> Realizada
			 3-> Reagendada */

			 /*TIPO
			 1 -> Prospecto
			 2->Opt
			 3->Cliente
			 */

			$this->model_prospectos->agregar_seguimiento($seguimiento,$prospecto);
			$this->model_agenda->agregar_actividad($actividad, $prospecto,$usuario,$id_act);

			$this->index();
			echo '<div class="alert alert-warning caja-error alerta" align="center">Agendado!<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';

		} else 
		{
			$this->index();
		}

	}

	public function validar_actok()
	{

		$this->form_validation->set_rules('seguimiento', 'Seguimiento', 'trim|xss_clean');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|xss_clean');
		$this->form_validation->set_rules('hora', 'Hora', 'trim|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|xss_clean'); 

		if($this->form_validation->run())
		{
			$prospecto = $this->input->post('id_prospectos');
			$usuario = $this->session->userdata('id_usuarios');
			$id_act = $this->input->post('id_actividad');

			$seguimiento = array(
				'seguimiento' => $this->input->post('seguimiento'),
				'hora'	=> date('H:i'),
				'fecha'	=>	date('Y/m/d')
				);


			/* Estatus
			 1 -> No realizada
			 2 -> Realizada
			 3-> Reagendada */

			 /*TIPO
			 1 -> Prospecto
			 2->Opt
			 3->Cliente
			 */

			$this->model_prospectos->agregar_seguimiento($seguimiento,$prospecto);
			$this->act_realizada($id_act);

		} else 
		{
			$this->index();
		}

	}

	public function buscar_prospecto()
	{
		$id=$_GET['id_prospectos'];
		$this->model_prospectos->buscar_prospecto($id);
	}

	public function buscar_actividad()
	{
		$id=$_GET['id_actividad'];
		$this->model_agenda->buscar_actividad($id);
	}



	


}//Fin de la Clase

