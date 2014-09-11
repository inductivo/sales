<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Prospectos extends CI_Model{

	function __construct(){
		parent:: __construct();
	}


	 public function obtener_origen(){  
        $query = $this->db->query('SELECT * FROM origen');  
        if($query->num_rows > 0){

          foreach($query->result() as $row){
                 $data[$row->id_origen] = $row->origen;
          }
        return $data;
        } 
    }

    public function insertar_prospecto ($registro,$id_empresa,$id_usuario)
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

    }

    public function actualizar_prospecto($registro)
    {
      //SE ACTUALIZA LA INFORMACIÒN DEL PROSPECTO
      $this->db->set($registro);
      $this->db->where('id_prospectos',$registro['id_prospectos']);
      $this->db->update('prospectos');
    }

    public function descartar_prospecto($registro)
    {

      $this->db->set($registro);
      $this->db->where('id_prospectos', $registro['id_prospectos']);
      $this->db->update('prospectos_usuarios', $registro);
    }


    //Muestra la tabla con los prospectos de cada usuario
    public function mostrar_prospectos($id_usuario)
    { 
      $this->db->select('prospectos.*,prospectos_usuarios.*');
      $this->db->from('prospectos');
      $this->db->join('prospectos_usuarios','prospectos.id_prospectos = prospectos_usuarios.id_prospectos','inner');
      $this->db->where('id_usuarios',$id_usuario);
      $this->db->where('prospectos_usuarios.status',1);

      $query = $this->db->get();
      return $query->result();

    }

      //Buscar para EDITAR el Prospecto
      public function buscar_prospecto($id) {

        $this->db->where('id_prospectos', $id);
        $query = $this->db->get('prospectos')->row();

        // lo convierto a JSON
        $json = json_encode($query);

        // devuelvo el JSON
        echo $json;   
      }

      public function numprospectos($id_usuario){

        $this->db->where('id_usuarios', $id_usuario);
        $this->db->where('status',1);
        $this->db->from('prospectos_usuarios');
       return $this->db->count_all_results();

    }

    public function ver_prospecto($id_prospecto)
    {
      $this->db->select('prospectos.*,estados.estado,origen.origen,paises.pais');
      $this->db->from('prospectos');
      $this->db->join('estados','prospectos.estado = estados.id','inner');
      $this->db->join('origen', 'prospectos.origen = origen.id_origen','inner');
      $this->db->join('paises', 'prospectos.pais = paises.id','inner');
      $this->db->where('prospectos.id_prospectos', $id_prospecto);
      return $this->db->get()->row();
    }

    //Regresa la informaciòn del prospecto (Convertir a oportunidad)
    public function info_prospecto($id_prospecto)
    {
       $this->db->where('id_prospectos', $id_prospecto);
        return $this->db->get('prospectos')->row();
    }

    //Obtiene las fases de la oportunidad para desplegarlas en el dropdown
    public function obtener_fases()
    {
      $query = $this->db->query('SELECT * FROM fases_opt');  
                if($query->num_rows > 0){

                    foreach($query->result() as $row){
                            $data[$row->id_fases_opt] = $row->fase;
                    }
                    return $data;
                } 
    }

    public function crear_oportunidad($oportunidad, $id_empresa,$id_usuario)
    {
      //SE AGREGA EL REGISTRO A LA TABLA Oportunidades
      $this->db->set($oportunidad);
      $this->db->insert('oportunidades');

      //SE BUSCA LA OPORTUNIDAD QUE SE ACABA DE AGREGAR
      $this->db->select_max('id_oportunidades');
      $this->db->from('oportunidades');
      $query = $this->db->get()->row();

      //SE CREA EL ARREGLO PARA INSERTAR EN LA TABLA  empresas_oportunidades
      $emp_opt = array(
                          'id_empresas' => $id_empresa,
                          'id_oportunidades' => $query->id_oportunidades
                          
        );

      //SE INSERTA EN LA TABLA empresas_prospectos
      $this->db->set($emp_opt);
      $this->db->insert('empresas_oportunidades');

      //SE CREA EL ARREGLO PARA INSERTAR EN LA TABLA  oportunidades_usuarios
      $opt_usu = array(
                          'id_oportunidades' => $query->id_oportunidades,
                          'id_usuarios' => $id_usuario,
                          'status'  => 1 // 1 = Activo, 0 = Descartado
        );

      //SE INSERTA EN LA TABLA oportunidades_usuarios
      $this->db->set($opt_usu);
      $this->db->insert('oportunidades_usuarios');

      
      //Se obtiene el Id del prospecto de la oportunidad que se acaba de insertar
      $this->db->select('id_prospectos');
      $this->db->where('id_oportunidades', $query->id_oportunidades);
      $this->db->from('oportunidades');
      $query3 = $this->db->get()->row();

      //Se cambia el status del prospecto, donde se indica que ya es una oportunidad
      $info = array('status'=>2);
      $this->db->set($info);
      $this->db->where('id_prospectos',$query3->id_prospectos);
      $this->db->update('prospectos_usuarios');


    }

    public function agregar_archivo($archivo)
    {
      //Se inserta la informacion del archivo en la BD
      $this->db->set($archivo);
      $this->db->insert('archivos');

      //SE BUSCA EL ARCHIVO QUE SE ACABA DE AGREGAR
      $this->db->select_max('id_archivos');
      $this->db->from('archivos');
      $query = $this->db->get()->row();

        //SE BUSCA LA OPORTUNIDAD QUE SE ACABA DE AGREGAR
      $this->db->select_max('id_oportunidades');
      $this->db->from('oportunidades');
      $query2 = $this->db->get()->row();

      $arc_opt  = array('id_archivos' =>$query->id_archivos,
                        'id_oportunidades' => $query2->id_oportunidades );

      $this->db->set($arc_opt);
      $this->db->insert('archivos_oportunidades');
    }


}