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

		$this->form_validation->set_message('existe_email', 'Ya existe un usuario con este correo, pruebe con otro');

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
					  'grupo' => 'Administración',
					  'nivel' => '0');
				//Nivel 0 = Admin  Nivel 1 = Otros grupos

				//Se agrega el grupo General
				$this->model_administracion->agregar_grupo($data);

				
				//Obtener el Id del Grupo que se acaba de agregar
				$grupo_default = $this->model_administracion->buscar_grupo_default($empresa->id_empresas);

				//Se prepara el arreglo con la informaciòn del Director General
				$datos_perfil_dg = array('id_empresas' => $empresa->id_empresas,
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Director General',
									   'nivel' => '0');

				//Se prepara el arreglo con la informaciòn del Gerente General
				$datos_perfil_gg = array('id_empresas' => $empresa->id_empresas,
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Gerente General',
									   'nivel' => '0');

				// Niveles en Perfiles
				// Director General  y Gerente General = 0
				// Gerente de Ventas = 1
				// Ejecutivo = 2

				//Se agregan los perfiles
				$this->model_administracion->agregar_perfil($datos_perfil_dg);
				$this->model_administracion->agregar_perfil($datos_perfil_gg);
				
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

			//Se prepara el arreglo con la informaciòn del perfil Gerente de Ventas
			$datos_perfil_gv = array('id_empresas' => $registro['id_empresas'],
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Gerente de Ventas',
									   'nivel' => '1');

			//Se prepara el arreglo con la informaciòn del perfil Ejecutivo de Ventas
			$datos_perfil_ev = array('id_empresas' => $registro['id_empresas'],
									   'id_grupos' => $grupo_default->id_grupos,
									   'perfil' => 'Ejecutivo de Ventas',
									   'nivel' => '2');

			//Se agrega el Perfil
			$this->model_administracion->agregar_perfil($datos_perfil_gv);
			$this->model_administracion->agregar_perfil($datos_perfil_ev);




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
			$data['niveles'] = $this->model_administracion->mostrar_niveles_perfiles();
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

			$empresa = $this->model_administracion->buscar_empresa();
			$data['contenido'] = 'administracion/agregar_usuarios';
			$data['titulo'] = 'Panel de Control';
			$data['empresa'] = $this->model_administracion->buscar_empresa();
			$data['paises'] = $this->model_administracion->obtener_paises();
			$data['estados'] = $this->model_administracion->obtener_estados();
			$data['grupos'] = $this->model_administracion->mostrar_grupos($empresa->id_empresas);
			$this->load->view('templates/template_administracion',$data);

		}

	}

	public function cargar_perfiles()
	{
		$id_grupo = $this->input->get('id');

		$this->model_administracion->devolver_perfiles($id_grupo);
	}




	//USUARIOS
	public function validar_usuario()
	{
		

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim');
		$this->form_validation->set_rules('iniciales', 'Iniciales', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_existe_email');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required|trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|trim');
		$this->form_validation->set_rules('estado', 'Estado', 'required|trim');
		$this->form_validation->set_rules('pais', 'País', 'required|trim');
		
		$this->form_validation->set_rules('id_grupos', 'Grupo', 'required|trim');	
		$this->form_validation->set_rules('id_perfiles', 'Perfil', 'required|trim');

		if($this->form_validation->run())
		{
			$usuario = $this->input->post();

			$usuario['password'] = md5($usuario['email']);
			$usuario['activo'] = '1';
			$usuario['ultimo_login'] = date('Y/m/d H:i');
			$usuario['creacion'] = date('Y/m/d H:i');

			$this->model_administracion->agregar_usuario($usuario);

			$this->enviar_email($usuario);
			$this->agregar_usuarios();



		}else
		{

			$this->agregar_usuarios();
			
		}

	}

	public function existe_email()
	{
		return $this->administracionlib->existe_email($this->input->post());
	}

	public function enviar_email($usuario){

			$this->load->library('email', array('mailtype' =>'html'));
			

			$this->email->from('soporte@sumaventas.com.mx', "Soporte SSS");
			$this->email->to($usuario['email']);
			$this->email->subject("Usuario Agregado Sales System Suma");

			$message= "<p>Ya puedes empezar a utilizar la plataforma de ventas<p> <br>";
			
			$message.= "<b>Usuario:</b> ".$usuario['email']."<br>";
			$message.= "<b>Contraseña</b>: ".$usuario['email'];

			$message.= "<p> <a href='".base_url()."home' >Click aquí </a>
			para iniciar sesión con tu nueva cuenta </p>";


			$this->email->message($message);

			$this->email->send();


	}

	public function editar_usuario($usuario)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$empresa = $this->model_administracion->buscar_empresa();
			$data['contenido'] = 'administracion/editar_usuario';
			$data['titulo'] = 'Panel de Control';
			$data['empresa'] = $this->model_administracion->buscar_empresa();
			$data['paises'] = $this->model_administracion->obtener_paises();
			$data['estados'] = $this->model_administracion->obtener_estados();
			$data['grupos'] = $this->model_administracion->mostrar_grupos($empresa->id_empresas);
			$data['datos_usuario'] = $this->model_administracion->buscar_usuario($usuario);
			$this->load->view('templates/template_administracion',$data);

		}

	}

	public function validar_editar_usuario()
	{
		$usuario = $this->input->post();

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim');
		$this->form_validation->set_rules('iniciales', 'Iniciales', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_existe_email');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required|trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'required|trim');
		$this->form_validation->set_rules('estado', 'Estado', 'required|trim');
		$this->form_validation->set_rules('pais', 'País', 'required|trim');
		
		$this->form_validation->set_rules('id_grupos', 'Grupo', 'required|trim');	
		$this->form_validation->set_rules('id_perfiles', 'Perfil', 'required|trim');

		if($this->form_validation->run())
		{
			

			$this->model_administracion->actualizar_usuario($usuario);
			
			$this->agregar_usuarios();



		}else
		{

			$this->editar_usuario($usuario['id_usuarios']);
			
		}
	}

	public function eliminar_usuario($usuario)
	{
		if($this->session->userdata('id_usuarios_admin') == null)
		{
			redirect('administracion/acceso_denegado');
		}else{

			$this->model_administracion->eliminar_usuario($usuario);
			$this->agregar_usuarios();
		}

	}

	public function fin_configuracion()
	{
		$data['contenido'] = 'administracion/fin_configuracion';
		$data['titulo'] = 'Panel de Control';
		$this->load->view('templates/template_administracion',$data);
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

