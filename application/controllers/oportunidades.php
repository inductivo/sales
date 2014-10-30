<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oportunidades extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('model_administracion');
		$this->load->model('model_usuarios');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->library('calendar');
		$this->form_validation->set_message('validar_comisiones', 'La suma de <strong>Comisiones</strong> no coincide.');
		$this->form_validation->set_message('validar_pagos', 'La suma de los <strong>Pagos</strong> no coincide con el monto.');

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

	public function venta($id_oportunidad,$id_prospecto)
	{

		if($this->session->userdata('id_usuarios') == null)
		{
			redirect('home/acceso_denegado');
		} else{

			$perfil = $this->model_usuarios->obtener_nivel($this->session->userdata('id_perfiles'));

			if($perfil->nivel == 0)
			{
				
				$data['contenido'] = 'oportunidades/venta';
				$data['titulo'] = 'Oportunidades Admin';
				$data['prospecto'] = $this->model_prospectos->info_prospecto($id_prospecto);
				$data['oportunidad'] = $this->model_oportunidades->info_oportunidad($id_oportunidad);
				$this->load->view('templates/template_admin',$data);
			}

			else if($perfil->nivel == 1)
			{
				$data['contenido'] = 'oportunidades/venta';
				$data['titulo'] = 'Oportunidades MM';
				$data['prospecto'] = $this->model_prospectos->info_prospecto($id_prospecto);
				$data['oportunidad'] = $this->model_oportunidades->info_oportunidad($id_oportunidad);
				$this->load->view('templates/template_mm',$data);
			}

			else if($perfil->nivel == 2)
			{
				$data['contenido'] = 'oportunidades/venta';
				$data['titulo'] = 'Oportunidades EV';
				$data['prospecto'] = $this->model_prospectos->info_prospecto($id_prospecto);
				$data['oportunidad'] = $this->model_oportunidades->info_oportunidad($id_oportunidad);
				$this->load->view('templates/template_ev',$data);	
			}
		}

	}

	public function validar_venta()
	{
		
		$this->form_validation->set_rules('monto', 'Monto', 'trim|xss_clean');
		$this->form_validation->set_rules('observaciones', 'Observaciones', 'trim|xss_clean');
		$this->form_validation->set_rules('anticipo', 'Anticipo', 'trim|xss_clean|callback_validar_pagos');
		$this->form_validation->set_rules('comisionanticipo', 'Comision', 'trim|xss_clean|callback_validar_comisiones');
		$this->form_validation->set_rules('fechaanticipo', 'Fecha', 'trim|xss_clean');
		$this->form_validation->set_rules('referencia', 'Referencia', 'trim|xss_clean');

		if($this->form_validation->run())
		{
			$pagos = $this->input->post('pagos');

			//Insertar Venta
			$venta = array(
				'id_prospectos' => $this->input->post('prospecto'),
				'id_oportunidades' => $this->input->post('oportunidad'),
				'observaciones' => $this->input->post('observaciones'),
				'pagos' => $this->input->post('pagos'),
				'periodicidad' => $this->input->post('periodicidad'),
				'tipocomision' => $this->input->post('tipocomision')
			);

			$this->model_oportunidades->insertar_venta($venta);

			//Insertar el anticipo
			$num_pagos = array(
				'pago' => $this->input->post('anticipo'),
				'comision' => $this->input->post('comisionanticipo'),
				'fecha' => $this->input->post('fechaanticipo'),
				'referencia' => $this->input->post('referencia')
				);
			$p = $this->input->post('pagorealizado');
			
			//0 = No pagado 1 = Pagado
			if(isset($p) && $p == "pagado")
			{	
				$num_pagos['pagorealizado'] = 1;
			} else {
				$num_pagos['pagorealizado'] = 0;
			}

			$this->model_oportunidades->insertar_pago($num_pagos);


			for($i=0; $i<=$pagos-2; $i++)
			{
				$p2= 0;

				$registro = array(
					'pago' => $this->input->post('pago'.($i+2)),
					'comision' => $this->input->post('comisionanticipo'.($i+2)),
					'fecha' => $this->input->post('fechaanticipo'.($i+2)),
					'referencia' => $this->input->post('referencia'.($i+2))
					);
				
				//0 = No pagado 1 = Pagado		
				$p2 = $this->input->post('pagorealizado'.($i+2)); 

				if(isset($p2) && $p2 == "pagado")
				{	
					$registro['pagorealizado'] = 1;
				} else {
					$registro['pagorealizado'] = 0;
				}

				$this->model_oportunidades->insertar_pago($registro);
			}

			$this->index();
			echo '<div class="alert alert-success caja-error alerta" align="center"><strong>FELICIDADES</strong>, ha cerrado una VENTA <i class="fa fa-check-circle fa-fw fa-lg"></i></div>';
		}
		else
		{
			$opt = $this->input->post('oportunidad');
			$pros = $this->input->post('prospecto');
			$this->venta($opt,$pros);
		}

	}

	public function validar_comisiones()
	{
		$suma=0;
		$pagos= $this->input->post('pagos');
		$comision = $this->input->post('comision');
		$comisionanticipo = $this->input->post('comisionanticipo');


		for($i=0; $i<=$pagos-2; $i++)
		{
			$cant=$this->input->post('comisionanticipo'.($i+2));
			$suma=$suma+$cant;

		}

		$com = $suma + $comisionanticipo;

		if($com == $comision)
		{
			return TRUE;
		}
		else
		{

			return FALSE;
		}
	}

	public function validar_pagos()
	{
		$suma=0;
		$pagos=$this->input->post('pagos');
		$monto = $this->input->post('monto');
		$anticipo = $this->input->post('anticipo');

		for($i=0; $i<=$pagos-2; $i++)
		{
			$cant=$this->input->post('pago'.($i+2));
			$suma=$suma+$cant;
		}

		$total = $suma + $anticipo;

		if($total == $monto)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function descartar($id)
	{
		//Se crea un arreglo donde cambia el status a 0 = Prospecto Descartado
		$registro['id_oportunidades'] = $id;
		$registro['status'] = 0;

		$this->model_oportunidades->descartar($registro);
		$this->index();
		echo '<div class="alert alert-error caja-error alerta" align="center"><strong>Oportunidad Descartada</strong><i class="fa fa-ban fa-fw fa-lg"></i></div>';

	}
	
}