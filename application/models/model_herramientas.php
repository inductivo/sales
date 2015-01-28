<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Herramientas extends CI_Model{

	function __construct(){
		parent:: __construct();
	}



     public function insertar_csv($registro,$id_empresa,$id_usuario)
    {
      //SE AGREGA EL REGISTRO A LA TABLA prospectos
      $this->db->set($registro);
      $this->db->insert('prospectos');

      //SE BUSCA EL PROSPECTO QUE SE ACABA DE AGREGAR
      $this->db->select_max('id_prospectos');
      $this->db->from('prospectos');
      $query = $this->db->get()->row();

      //SE CREA EL ARREGLO PARA INSERTAR EN LA TABLA  empresas_prospectos
      $emp_prosp = array(
                          'id_empresas' => $id_empresa,
                          'id_prospectos' => $query->id_prospectos
                          
        );

      //SE INSERTA EN LA TABLA empresas_prospectos
      $this->db->set($emp_prosp);
      $this->db->insert('empresas_prospectos');

      //SE CREA EL ARREGLO PARA INSERTAR EN LA TABLA  prospectos_usuarios
      $prosp_usu = array(
                          'id_prospectos' => $query->id_prospectos,
                          'id_usuarios' => $id_usuario,
                          'status'  => 1 // 0=Descartado, 1=Prospecto Activo 2=Convertido a Oportunidad
        );

      //SE INSERTA EN LA TABLA prospectos_usuarios
      $this->db->set($prosp_usu);
      $this->db->insert('prospectos_usuarios');

      $comentario = array(
        'seguimiento' => 'Prospecto agregado por importación',
        'fecha' => date('Y/m/d'),
        'hora' => date('H:i')
        );
      
     $this->model_prospectos->agregar_seguimiento($comentario, $query->id_prospectos);

    }

}