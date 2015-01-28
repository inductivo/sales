<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prospectos extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('model_administracion');
		$this->load->model('model_usuarios');
		$this->load->model('model_prospectos');
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
				$data['contenido'] = 'prospectos/index';
				$data['titulo'] = 'Prospectos';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'prospectos/index';
				$data['titulo'] = 'Prospectos';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{
				$data['contenido'] = 'prospectos/index';
				$data['titulo'] = 'Prospectos';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_ev',$data);	
			}
		}	

		
	}

	public function validar_prospecto()
	{
		$this->form_validation->set_rules('empresa', 'Empresa', 'trim|xss_clean');
		$this->form_validation->set_rules('titulo', 'Titulo', 'trim|xss_clean');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|xss_clean');
		$this->form_validation->set_rules('puesto', 'Puesto', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|xss_clean');
		$this->form_validation->set_rules('movil', 'Móvil', 'numeric|trim|xss_clean');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|xss_clean');
		$this->form_validation->set_rules('cp', 'Código postal', 'trim|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|xss_clean');
		$this->form_validation->set_rules('pais', 'País', 'trim|xss_clean');
		$this->form_validation->set_rules('origen', 'Origen', 'trim|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|xss_clean');
		$this->form_validation->set_rules('web', 'Página web', 'prep_url|trim|xss_clean');
		$this->form_validation->set_rules('comentarios', 'Comentarios', 'trim|xss_clean');

		if($this->form_validation->run())
		{
			$registro = $this->input->post();
			$registro['creacion'] = date('Y/m/d H:i');
			$registro['ultima_actualizacion'] = date('Y/m/d H:i');
			$id_empresa = $this->session->userdata('id_empresas');
			$id_usuario = $this->session->userdata('id_usuarios');

			$this->model_prospectos->insertar_prospecto($registro,$id_empresa,$id_usuario);
			
			$this->index();
			echo '<div class="alert alert-success caja-error alerta" align="center">Prospecto agregado correctamente <i class="fa fa-check-circle fa-fw fa-lg"></i></div>';

		}else
		 {
		 	$this->index();
		 }
	}

	public function validar_editar_prospecto()
	{
		$this->form_validation->set_rules('empresa', 'Empresa', 'trim|xss_clean');
		$this->form_validation->set_rules('titulo', 'Titulo', 'trim|xss_clean');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|xss_clean');
		$this->form_validation->set_rules('puesto', 'Puesto', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|xss_clean');
		$this->form_validation->set_rules('movil', 'Móvil', 'numeric|trim|xss_clean');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|xss_clean');
		$this->form_validation->set_rules('cp', 'Código postal', 'trim|xss_clean');
		$this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|xss_clean');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|xss_clean');
		$this->form_validation->set_rules('pais', 'País', 'trim|xss_clean');
		$this->form_validation->set_rules('origen', 'Origen', 'trim|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|xss_clean');
		$this->form_validation->set_rules('web', 'Página web', 'prep_url|trim|xss_clean');
		$this->form_validation->set_rules('comentarios', 'Comentarios', 'trim|xss_clean');

		if($this->form_validation->run())
		{
			$registro = $this->input->post();
			$registro['ultima_actualizacion'] = date('Y/m/d H:i');

			$this->model_prospectos->actualizar_prospecto($registro);
			$this->index();
			echo '<div class="alert alert-warning caja-error alerta" align="center">Prospecto actualizado correctamente <i class="fa fa-check-circle fa-fw fa-lg"></i></div>';

		}else
		 {
		 	$this->index();
		 }
	}

	public function buscar_prospecto()
	{
		$id=$_GET['id_prospectos'];
		$this->model_prospectos->buscar_prospecto($id);
	}

	public function descartar($id)
	{
		//Se crea un arreglo donde cambia el status a 0 = Prospecto Descartado
		$registro['id_prospectos'] = $id;
		$registro['status'] = 0;

		$registro2['id_prospectos'] = $id;
		$registro2['ultima_actualizacion'] = date('Y/m/d H:i');

		$this->model_prospectos->descartar_prospecto($registro);
		$this->model_prospectos->actualizar_prospecto($registro2);
		$this->index();

	}

	public function ver_prospecto($id_prospecto)
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		} else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'prospectos/ver_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$data['prospecto'] = $this->model_prospectos->ver_prospecto($id_prospecto);
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'prospectos/ver_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['prospecto'] = $this->model_prospectos->ver_prospecto($id_prospecto);
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{
				$data['contenido'] = 'prospectos/ver_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['prospecto'] = $this->model_prospectos->ver_prospecto($id_prospecto);
				$this->load->view('templates/template_ev',$data);	
			}
		}	
	}

	public function convertir_prospecto($id_prospecto)
	{

		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		} else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				
				$data['contenido'] = 'prospectos/convertir_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['prospecto']= $this->model_prospectos->info_prospecto($id_prospecto);
				$data['fases']= $this->model_prospectos->obtener_fases();
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'prospectos/ver_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['prospecto']= $this->model_prospectos->info_prospecto($id_prospecto);
				$data['fases']= $this->model_prospectos->obtener_fases();
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{
				$data['contenido'] = 'prospectos/ver_prospecto';
				$data['titulo'] = 'Prospectos';
				$data['prospecto']= $this->model_prospectos->info_prospecto($id_prospecto);
				$data['fases']= $this->model_prospectos->obtener_fases();
				$this->load->view('templates/template_ev',$data);	
			}
		}	
	}

	public function validar_conversion()
	{

		$this->form_validation->set_rules('concepto', 'Concepto', 'trim|xss_clean');
		$this->form_validation->set_rules('monto', 'Monto', 'trim|xss_clean');
		$this->form_validation->set_rules('porcentaje', 'Porcentaje', 'trim|xss_clean');
		$this->form_validation->set_rules('comentarios', 'Comentarios', 'trim|xss_clean');

		if($this->form_validation->run())
		{
			$oportunidad = array(
				'id_prospectos' => $this->input->post('id_prospectos'),
				'concepto'	=> $this->input->post('concepto'),
				'monto'	=> $this->input->post('monto'),
				'comision'	=> $this->input->post('comision'),
				'porcentaje'	=> $this->input->post('porcentaje'),
				'cierre'	=> $this->input->post('cierre'),
				'certeza'	=> $this->input->post('certeza'),
				'fase'	=>	$this->input->post('fase'),
				'comentarios'	=> $this->input->post('comentarios'),
				'creacion'	=>	date('Y/m/d H:i')
				);

			$comentarios = array(
				'seguimiento' => $this->input->post('comentarios'),
				'fecha' => date('Y/m/d'),
				'hora' => date('H:i')
				);

			$id_empresa = $this->session->userdata('id_empresas');
			$id_usuario = $this->session->userdata('id_usuarios');
			$id_prospecto = $this->input->post('id_prospectos');

			$config['upload_path'] = 'uploads';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx';
			$config['max_size']	= '2048';

			$this->load->library('upload', $config);
			$archivo_cargado = $this->upload->do_upload();

			$data = $this->upload->data();

				if ( ! $this->upload->do_upload())
				{
					if($data['file_size'] > 0)
					{
					echo $this->upload->display_errors('<div class="alert alert-warning caja-error">','</div>');
					$this->index();
					}
					else
					{
						$this->model_prospectos->crear_oportunidad($oportunidad,$id_empresa,$id_usuario);
						$this->model_prospectos->agregar_seguimiento($comentarios,$id_prospecto);

						$this->index();
						echo '<div class="alert alert-warning caja-error alerta" align="center">Oportunidad de Negocio Generada!<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';
					}
				}	
				else
				{

					$datos_archivo = array(
						'nombre' => $data['file_name'],
						'ruta'	=> $data['full_path'],
						'peso'	=>	$data['file_size'],
						'extension'	=> $data['file_ext'],
						'fecha'	=>	date('Y/m/d'),
						'hora'	=> date('H:i')
					);

					$this->model_prospectos->crear_oportunidad($oportunidad,$id_empresa,$id_usuario);
					$this->model_prospectos->agregar_archivo($datos_archivo);
					$this->model_prospectos->agregar_seguimiento($comentarios,$id_prospecto);
					$this->index();
					echo '<div class="alert alert-warning caja-error alerta" align="center">Oportunidad de Negocio Generada!<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';

				}
			
		}else
		 {
		 	$this->index();
		 }


	}

	public function validar_seguimiento()
	{

		$this->form_validation->set_rules('seguimiento', 'Seguimiento', 'trim|xss_clean');
		$this->form_validation->set_rules('fecha', 'Fecha', 'trim|xss_clean');
		$this->form_validation->set_rules('hora', 'Hora', 'trim|xss_clean');
		$this->form_validation->set_rules('actividad', 'Actividad', 'trim|xss_clean'); 

		if($this->form_validation->run())
		{
			$prospecto = $this->input->post('id_prospectos');
			$usuario = $this->session->userdata('id_usuarios');

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
				'id_tipo' => 1
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

			 $actualizacion = array(
			 	'id_prospectos' => $prospecto,
			 	'ultima_actualizacion' => date('Y/m/d H:i')
			 	);

			$this->model_prospectos->agregar_seguimiento($seguimiento,$prospecto);
			$this->model_prospectos->agregar_actividad($actividad, $prospecto,$usuario);
			$this->model_prospectos->actualizar_prospecto($actualizacion);

			echo '<div class="alert alert-warning caja-error alerta" align="center">Agendado!<i class="fa fa-check-circle fa-fw fa-lg"></i></div>';
			$this->index();

		} else 
		{
			$this->index();
		}

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