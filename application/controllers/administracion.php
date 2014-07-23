<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administracion extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('administracionLib');
		$this->load->model('model_administracion');
		
		/* Mensajes de Validaciòn */
		$this->form_validation->set_message('validar_credenciales', '<strong>Email</strong> ó <strong>Password</strong> Incorrecto');
		$this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
		$this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe ser un email correcto');

		$this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe ser un número');

		$this->form_validation->set_message('exact_length', 'El campo <b>%s</b> debe de contener <b>%s</b> números.');

	}

	public function index()
	{
		$data['contenido'] = 'administracion/login';
		$this->load->view('templates/template_login_admin',$data);
	}

	/*Funcion para validar el acceso, se valida el callback validar_credenciales de aprobarse se accede al Panel de Control*/

	public function validar_login()
	{
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|callback_validar_credenciales');
		
		$this->form_validation->set_rules('password','Password','required|trim');

			if ($this->form_validation->run()){

				/*Se accede al Panel de Control*/
				redirect('administracion/panelcontrol');	
						
			} else{

				/*Regresa al login*/
				$this->index();
			}	
	}

	public function validar_credenciales()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		return $this->administracionlib->login($email,md5($password));
	}

	/* Si la sesion de inicia nos manda al Panel de Control*/

	public function panelcontrol()
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$data['contenido'] = 'administracion/panelcontrol';
			$data['titulo'] = 'Panel de Control';
			$this->load->view('templates/template_administracion',$data);
		}
	}

	/* INICIO DE LA CONFIGURACIÓN */

	/* Paso 1. Agregar Empresa */

	public function agregar_empresa()
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$data['contenido'] = 'administracion/agregar_empresa';
			$data['titulo'] = 'Panel de Control';
			$this->load->view('templates/template_administracion',$data);
		}

	}

	public function validar_empresa()
	{
		$this->form_validation->set_rules('empresa', 'Empresa', 'required|trim');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'required|trim');
		$this->form_validation->set_rules('telefono','Teléfono','required|trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|trim');
		$this->form_validation->set_rules('estado', 'Estado', 'required|trim');
		$this->form_validation->set_rules('pais', 'País', 'required|trim');
		$this->form_validation->set_rules('contacto', 'Contacto', 'required|trim');
		$this->form_validation->set_rules('movil', 'Móvil', 'required|trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

		if($this->form_validation->run())
			{
				$registro = $this->input->post();
				$registro['creacion'] = date('Y/m/d H:i');

				//Se crea la empresa
				$this->model_administracion->agregar_empresa($registro);

				//Se busca el id de la empresa que se acaba de agregar
				$empresa = $this->model_administracion->buscar_empresa();
				
				//Se prepara el arreglo con la informaciòn del grupo General
				$data = array('id_empresas' => $empresa->id_empresas,
					  'grupo' => 'General');

				//Se agrega el grupo General
				$this->model_administracion->agregar_grupo($data);

				
				//Obtener el Id del Grupo que se acaba de agregar
				$grupo_default = $this->model_administracion->buscar_grupo_default($empresa->id_empresas);

				//Se prepara el arreglo con la informaciòn del perfil General
				$datos_perfil = array('id_empresas' => $empresa->id_empresas,
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Director General');

				//Se agrega el Perfil por default
				$this->model_administracion->agregar_perfil($datos_perfil);
				
				$this->agregar_grupos();
				
			}
			else
			{
				$this->agregar_empresa();
			}
	}

	/* Paso 2. Agregar Grupos */

	public function agregar_grupos()
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$data['contenido'] = 'administracion/agregar_grupos';
			$data['titulo'] = 'Panel de Control';
			$data['empresa'] = $this->model_administracion->buscar_empresa();
			$this->load->view('templates/template_administracion',$data);

		}

	}

	public function validar_grupos()
	{
		$this->form_validation->set_rules('grupo','Grupo','required|trim');
		
		if($this->form_validation->run())
		{
			$registro = $this->input->post();
			$this->model_administracion->agregar_grupo($registro);
			
			//Obtener el Id del Grupo que se acaba de agregar
			$grupo_default = $this->model_administracion->buscar_grupo_default($registro['id_empresas']);

			//Se prepara el arreglo con la informaciòn del perfil Ejecutivo de Ventas
			$datos_perfil = array('id_empresas' => $registro['id_empresas'],
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Ejecutivo de Ventas');

			//Se agrega el Perfil
			$this->model_administracion->agregar_perfil($datos_perfil);




			$this->agregar_grupos();

		} else{
			$this->agregar_grupos();
		}	


	}

	public function editar_grupo($id_grupo)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$data['contenido'] = 'administracion/editar_grupo';
			$data['titulo'] = 'Panel de Control';
			$data['registro'] = $this->model_administracion->buscar_grupo($id_grupo);
			$this->load->view('templates/template_administracion',$data);
		}

	}

	public function validar_editar_grupo()
	{
		$this->form_validation->set_rules('grupo','Grupo','required|trim');

		$registro = $this->input->post();
		if($this->form_validation->run())
		{
			$this->model_administracion->actualizar_grupo($registro);
			$this->agregar_grupos();
		}
		else
		{
			$this->editar_grupo($registro['id_grupos']);
		}
	}

	public function eliminar_grupo($id_grupo)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$this->model_administracion->eliminar_grupo($id_grupo);
			$this->agregar_grupos();
		}
	}

	public function agregar_perfiles()
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$id_empresa = $this->model_administracion->buscar_empresa();
			$data['contenido'] = 'administracion/agregar_perfiles';
			$data['titulo'] = 'Panel de Control';
			$data['empresa'] = $this->model_administracion->buscar_empresa();
			$data['grupos'] = $this->model_administracion->mostrar_grupos_dropdown($id_empresa);
			$this->load->view('templates/template_administracion',$data);

		}

	}

	public function validar_perfiles()
	{
		
		$this->form_validation->set_rules('perfil','Perfil','required|trim');

		

		if($this->form_validation->run())
		{
			$registro = $this->input->post();
			$this->model_administracion->agregar_perfil($registro);
			$this->agregar_perfiles();
		}
		else
		{
			$this->agregar_perfiles();
		}
	}

	public function editar_perfil($id_perfil)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$data['contenido'] = 'administracion/editar_perfil';
			$data['titulo'] = 'Panel de Control';
			$data['registro'] = $this->model_administracion->buscar_perfil($id_perfil);
			$this->load->view('templates/template_administracion',$data);
		}

	}

	public function validar_editar_perfil()
	{
		$this->form_validation->set_rules('perfil','Perfil','required|trim');

		$registro = $this->input->post();
		if($this->form_validation->run())
		{
			$this->model_administracion->actualizar_perfil($registro);
			$this->agregar_perfiles();
		}
		else
		{
			$this->editar_perfil($registro['id_perfiles']);
		}
	}


	public function eliminar_perfil($id_perfil)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$this->model_administracion->eliminar_perfil($id_perfil);
			$this->agregar_perfiles();
		}
	}

	public function agregar_usuarios()
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$id_empresa = $this->model_administracion->buscar_empresa();
			$data['contenido'] = 'administracion/agregar_usuarios';
			$data['titulo'] = 'Panel de Control';
			$data['empresa'] = $this->model_administracion->buscar_empresa();
			$data['paises'] = $this->model_administracion->obtener_paises();
			$data['estados'] = $this->model_administracion->obtener_estados();
			$data['grupos'] = $this->model_administracion->mostrar_grupos_dropdown($id_empresa);
			$this->load->view('templates/template_administracion',$data);

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


}//Fin de la Clase

