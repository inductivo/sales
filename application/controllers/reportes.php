<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

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

	public function index()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'administrador/reportes/prosp_generados';
				$data['titulo'] = 'Reportes de Prospección';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/reportes/prosp_generados';
					$data['titulo'] = 'Reportes de Prospección';
					$data['paises'] = $this->model_administracion->obtener_paises();
			    	$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} 

		}
	}

	public function opt_generadas()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'administrador/reportes/opt_generadas';
				$data['titulo'] = 'Oportunidades Generadas';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/reportes/opt_generadas';
					$data['titulo'] = 'Oportunidades Generadas';
					$data['paises'] = $this->model_administracion->obtener_paises();
			   		$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} 

		}
	}

	public function ventas_generadas()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'administrador/reportes/ventas_generadas';
				$data['titulo'] = 'Ventas Generadas';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/reportes/ventas_generadas';
					$data['titulo'] = 'Ventas Generadas';
					$data['paises'] = $this->model_administracion->obtener_paises();
			   		$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					$this->load->view('templates/template_mm',$data);
				
			} 

		}
	}



	public function prospectos_descartados()
	{
		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		}else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				$data['contenido'] = 'administrador/reportes/prospectos_descartados';
				$data['titulo'] = 'Prospectos Descartados';
				$data['paises'] = $this->model_administracion->obtener_paises();
			    $data['estados'] = $this->model_administracion->obtener_estados();
				$data['origen'] = $this->model_prospectos->obtener_origen();
				//$data['meses'] = $this->model_reportes->obtener_meses();
				$this->load->view('templates/template_admin',$data);
			}
			else if ($perfil->nivel == 1)
			{
				
					$data['contenido'] = 'mandosmedios/reportes/prospectos_descartados';
					$data['titulo'] = 'Prospectos Descartados';
					$data['paises'] = $this->model_administracion->obtener_paises();
			    	$data['estados'] = $this->model_administracion->obtener_estados();
					$data['origen'] = $this->model_prospectos->obtener_origen();
					//$data['meses'] = $this->model_reportes->obtener_meses();
					$this->load->view('templates/template_mm',$data);
				
			} 

		}
	}

	public function cargarUsuarios()
	{
		$this->model_reportes->cargarUsuarios();
	}

	public function buscar_prospecto()
	{
		$id=$_GET['id_prospectos'];
		$this->model_prospectos->buscar_prospecto($id);
	}

	public function reasignar()
	{
		$this->form_validation->set_rules('usuarios', 'Usuarios', 'trim|xss_clean');
		if($this->form_validation->run())
		{
			$reasignar = array(
				'id_prospectos' => $this->input->post('id_prospectos'),
				'id_usuarios' => $this->input->post('usuarios'),
				'status' => 1
			);

			$this->model_reportes->reasignar_prospectos($reasignar);
			echo '<div class="alert alert-warning caja-error alerta" align="center">Prospecto Reasignado!<i class="fa fa-share-square fa-fw fa-lg"></i></div>';
			$this->prospectos_descartados();
		} else
		{
			$this->index;
		}

	}


}//Fin de la Clase

