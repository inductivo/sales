<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('usuariosLib');
		$this->load->model('model_usuarios');
		$this->load->model('model_administracion');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->model('model_clientes');
		$this->load->model('model_agenda');
		
		/* Mensajes de Validaciòn */
		$this->form_validation->set_message('validar_credenciales', '<strong>Email</strong> ó <strong>Password</strong> Incorrecto');
		$this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
		$this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe ser un email correcto');
		$this->form_validation->set_message('matches', 'Las <b>contraseñas</b> no coinciden');
		$this->form_validation->set_message('validar_credenciales_password', '<b>Contraseña</b> incorrecta');

	}

	public function index()
	{
		$data['contenido'] = 'home/login';
		$this->load->view('templates/template_login',$data);
	}

	/*Funcion para validar el acceso, se valida el callback validar_credenciales de aprobarse se accede al dashboard*/

	public function validar_login()
	{
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|callback_validar_credenciales');
		
		$this->form_validation->set_rules('password','Password','required|trim');

			if ($this->form_validation->run()){

				/*Se accede al dashboard*/
				redirect('home/dashboard');	
						
			} else{

				/*Regresa al login*/
				$this->index();
			}	
	}

	public function validar_credenciales()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		return $this->usuarioslib->login($email,md5($password));
	}

	/* Si la sesion de inicia nos manda al Dashboard de la pàgina principal del sistema */

	public function dashboard()
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
			else
			{
				echo 'NO entra';
			}


			
		}
	}

	/* Pàgina de Acceso Denegado */
	public function acceso_denegado()
	{
		$this->load->view('templates/acceso_denegado');
	}

	/* Funciòn para cerrar la sesiòn del usuario*/
	public function cerrar_sesion()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}

	public function cambiar_password()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$data['contenido'] = 'home/cambiar_password';
			$data['titulo'] = 'Cambiar Password';
			$this->load->view('templates/template_pass',$data);
		}
	}

	public function validar_cambiar_password()
	{
		$this->form_validation->set_rules('pass_actual','Contraseña Actual','required|callback_validar_credenciales_password');

		$this->form_validation->set_rules('pass_nuevo','Nueva Contraseña','required|matches[cpass_nuevo]');

		$this->form_validation->set_rules('cpass_nuevo','Confirmar Nueva Contraseña:','required');

		if($this->form_validation->run() == FALSE)
		{
			$this->cambiar_password();
		}
		else
		{

			echo '<div class="alert alert-success caja-error alerta" align="center"><strong>La CONTRASEÑA</strong>, se cambio correctamente<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';


			$this->dashboard();
		}
	}

	public function validar_credenciales_password()
	{
		$pass_actual = $this->input->post('pass_actual');
		$pass_nuevo = $this->input->post('pass_nuevo');
		return $this->usuarioslib->cambiar_password(md5($pass_actual),md5($pass_nuevo));
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

