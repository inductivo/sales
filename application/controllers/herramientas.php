<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Herramientas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('usuariosLib');
		$this->load->library('csvimport');
		$this->load->model('model_usuarios');
		$this->load->model('model_administracion');
		$this->load->model('model_prospectos');
		$this->load->model('model_oportunidades');
		$this->load->model('model_clientes');
		$this->load->model('model_agenda');
		$this->load->model('model_reportes');
		$this->load->model('model_herramientas');
		
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

	function importar_prospectos() {
    
    	$id_empresa = $this->session->userdata('id_empresas');
		$id_usuario = $this->session->userdata('id_usuarios');
 
       	$config['upload_path'] = 'uploads';
      	$config['allowed_types'] = 'csv';
		$config['max_size']	= '2048';
 
        $this->load->library('upload', $config);
 
 
        // If upload failed, display error
        if (! $this->upload->do_upload()) {

          echo $this->upload->display_errors('<div class="alert alert-error caja-error alerta" align="center"><i class="fa fa-times-circle fa-fw fa-lg"></i>','</div>');
		  $this->index();

        } else {
            $file_data = $this->upload->data();
            $file_path =  'uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'empresa'=>$row['empresa'],
                        'titulo'=>$row['titulo'],
                        'nombre'=>$row['nombre'],
                        'apellidos'=>$row['apellidos'],
                        'puesto'=>$row['puesto'],
                        'email'=>$row['email'],
                        'telefono'=>$row['telefono'],
                        'movil'=>$row['movil'],
                        'domicilio'=>$row['domicilio'],
                        'cp'=>$row['cp'],
                        'ciudad'=>$row['ciudad'],
                        'estado'=>$row['estado'],
                        'pais'=>$row['pais'],
                        'origen'=>$row['origen'],
                        'web'=>$row['web'],
                        'comentarios'=>$row['comentarios'],
                        'creacion'=>$row['creacion'],
                        'ultima_actualizacion'=>$row['ultima_actualizacion']
                        
                    );
                    
                    $this->model_herramientas->insertar_csv($insert_data,$id_empresa,$id_usuario);
                }
                //$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                echo '<div class="alert alert-success caja-error alerta" align="center"><i class="fa fa-thumbs-up fa-fw fa-lg"></i>La importación de prospectos fue realizada correctamente</div>';
                $this->index();
                //echo "<pre>"; print_r($insert_data);
            } else{
            	echo $this->upload->display_errors('<div class="alert alert-error caja-error alerta" align="center"><i class="fa fa-times-circle fa-fw fa-lg"></i>','</div>');
            	echo "DOs DOS DOs";
		  		$this->index();


            }
                
                
            }
 
        } 


	


}//Fin de la Clase

