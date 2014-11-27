<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Oportunidades extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

  public function numoportunidades($id_usuario){

        $this->db->where('id_usuarios', $id_usuario);
        $this->db->where('status',1);
        $this->db->from('oportunidades_usuarios');
       return $this->db->count_all_results();

    }

  //Muestra la tabla con los Oportunidades de cada usuario
    public function mostrar_oportunidades($id_usuario)
    { 
      $this->db->select('oportunidades.*, prospectos.*, oportunidades_usuarios.*,fases_opt.*');
      $this->db->from('oportunidades');
      $this->db->join('prospectos','prospectos.id_prospectos = oportunidades.id_prospectos','inner');
      $this->db->join('oportunidades_usuarios','oportunidades.id_oportunidades = oportunidades_usuarios.id_oportunidades','inner');
      $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt','inner');
      
      $this->db->where('id_usuarios',$id_usuario);
      $this->db->where('oportunidades_usuarios.status',1);
      $this->db->order_by('oportunidades.cierre','asc');

      $query = $this->db->get();
      return $query->result();

    }

     public function convertir_fecha($fecha)
    {
        setlocale(LC_TIME, 'spanish');
        $fecha_m = explode("-", $fecha);
        $dia_m =$fecha_m[2];
        $mes_m =$fecha_m[1];
        $nombre_mes=strftime("%B",mktime(0, 0, 0, $mes_m, 1, 2000)); 
        $anio_m=$fecha_m[0];
        $fecha_final= $dia_m.'-'.$nombre_mes.'-'.$anio_m;
        
        echo $fecha_final;

    }

    public function obtener_certeza($certeza)
    {
        if($certeza <= 40)
        {
          echo '<span class="badge badge-important">'.$certeza.'% </span>';
            

        }else if($certeza > 40 && $certeza < 80){
            echo '<span class="badge badge-warning">'.$certeza.'% </span>';
        }else if($certeza >= 80)
        {
             echo '<span class="badge badge-success">'.$certeza.'% </span>';
        }
    }

    //Buscar OPORTUNIDAD para REALIZAR VENTA
    public function info_oportunidad($id_oportunidad)
    {
       $this->db->where('id_oportunidades', $id_oportunidad);
        return $this->db->get('oportunidades')->row();
    }

    //Insertar los datos de la Venta realizada
    public function insertar_venta($venta)
    {
      $this->db->set($venta);
      $this->db->insert('ventas');
    }

    //Insertar anticipo
    public function insertar_anticipo($anticipo)
    {
      $this->db->set($anticipo);
      $this->db->insert('anticipos');

      //Buscar el id_pagos que se acaba de ingresar
      $this->db->select_max('id_anticipos');
      $this->db->from('anticipos');
      $query_pagos = $this->db->get()->row();

      //Buscar el ultimo id_ventas que se agrego
      $this->db->select_max('id_ventas');
      $this->db->from('ventas');
      $query_ventas = $this->db->get()->row();

      //Se crea el arreglo con los valores de los id
      $registro = array(
        'id_anticipos' => $query_pagos->id_anticipos,
        'id_ventas' => $query_ventas->id_ventas
        );

      //Se agrega el anticipo a la bd
      $this->db->set($registro);
      $this->db->insert('anticipos_ventas');

      //Se cambia el status de la oportunidad a cliente
      $this->db->select('id_oportunidades');
      $this->db->where('id_ventas', $query_ventas->id_ventas);
      $this->db->from('ventas');
      $consulta = $this->db->get()->row();

      $stat = array('status' => 2);
      $this->db->set($stat);
      $this->db->where('id_oportunidades', $consulta->id_oportunidades);
      $this->db->update('oportunidades_usuarios');

    }

    public function insertar_saldo($saldo)
    {
      //Buscar el ultimo id_ventas que se agrego
      $this->db->select_max('id_ventas');
      $this->db->from('ventas');
      $query = $this->db->get()->row();

      $registro = array('saldo' => $saldo);
      $this->db->set($registro);
      $this->db->where('id_ventas', $query->id_ventas);
      $this->db->update('ventas');


    }

    public function insertar_pago($pagos)
    {
      $this->db->set($pagos);
      $this->db->insert('pagos');

      //Buscar el id_pagos que se acaba de ingresar
      $this->db->select_max('id_pagos');
      $this->db->from('pagos');
      $query_pagos = $this->db->get()->row();

      //Buscar el ultimo id_ventas que se agrego
      $this->db->select_max('id_ventas');
      $this->db->from('ventas');
      $query_ventas = $this->db->get()->row();

      //Se crea el arreglo con los valores de los id
      $registro = array(
        'id_pagos' => $query_pagos->id_pagos,
        'id_ventas' => $query_ventas->id_ventas
        );

      //Se agrega el pago a la bd
      $this->db->set($registro);
      $this->db->insert('pagos_ventas');


      //Se cambia el status de la oportunidad a cliente
      $this->db->select('id_oportunidades');
      $this->db->where('id_ventas', $query_ventas->id_ventas);
      $this->db->from('ventas');
      $consulta = $this->db->get()->row();

      $stat = array('status' => 2);
      $this->db->set($stat);
      $this->db->where('id_oportunidades', $consulta->id_oportunidades);
      $this->db->update('oportunidades_usuarios');

    }

     public function descartar($registro)
    {
      $this->db->set($registro);
      $this->db->where('id_oportunidades', $registro['id_oportunidades']);
      $this->db->update('oportunidades_usuarios', $registro);
    }
	 
    public function buscar_oportunidad($id_o)
    {
      $this->db->where('id_oportunidades',$id_o);
      $query = $this->db->get('oportunidades')->row();

      $json = json_encode($query);

      echo $json;

    }

    public function ver_opt($id)
    {
      $this->db->select('oportunidades.*,fases_opt.*');
      $this->db->from('oportunidades');
      $this->db->join('fases_opt','oportunidades.fase = fases_opt.id_fases_opt');
      $this->db->where('oportunidades.id_oportunidades', $id);
      return $this->db->get()->row();

    }

    public function ver_archivos($id)
    {

      $this->db->select('archivos.*, archivos_oportunidades.*');
      $this->db->from('archivos');
      $this->db->join('archivos_oportunidades','archivos.id_archivos = archivos_oportunidades.id_archivos','inner');

      $this->db->where('id_oportunidades',$id);
      $query = $this->db->get();
      return $query->result();

    }

    public function actualizar_opt($opt,$ido)
    {
      $this->db->set($opt);
      $this->db->where('id_oportunidades',$ido);
      $this->db->update('oportunidades');

    }

      public function agregar_archivo_seg($archivo,$ido)
    {
      //Se inserta la informacion del archivo en la BD
      $this->db->set($archivo);
      $this->db->insert('archivos');

      //SE BUSCA EL ARCHIVO QUE SE ACABA DE AGREGAR
      $this->db->select_max('id_archivos');
      $this->db->from('archivos');
      $query = $this->db->get()->row();


      $arc_opt  = array('id_archivos' =>$query->id_archivos,
                        'id_oportunidades' => $ido);

      $this->db->set($arc_opt);
      $this->db->insert('archivos_oportunidades');
    }

    public function mostrar_seguimiento($opt)
    {
      $this->db->select('seguimiento.*,oportunidades_seguimiento.*');
      $this->db->from('seguimiento');
      
      $this->db->join('oportunidades_seguimiento','seguimiento.id_seguimiento = oportunidades_seguimiento.id_seguimiento','inner'); 
      $this->db->where('id_oportunidades', $opt);

      $this->db->order_by('seguimiento.fecha','desc');
      $this->db->order_by('seguimiento.hora','desc');

      $query = $this->db->get();
      return $query->result();
    }

    public function agregar_seguimiento($id_opt,$comentario)
    {
      $this->db->set($comentario);
      $this->db->insert('seguimiento');

      $this->db->select_max('id_seguimiento');
      $this->db->from('seguimiento');
      $query = $this->db->get()->row();

      $opt_seg = array(
        'id_oportunidades' => $id_opt,
        'id_seguimiento' => $query->id_seguimiento
        );

      $this->db->set($opt_seg);
      $this->db->insert('oportunidades_seguimiento');

    }

    public function agregar_actividad($actividad, $ido)
    {
      $this->db->set($actividad);
      $this->db->insert('actividad');

      $this->db->select_max('id_actividad');
      $this->db->from('actividad');
      $query = $this->db->get()->row();

      $act_opt = array(
        'id_actividad' => $query->id_actividad,
        'id_oportunidades' => $ido
        );

      $this->db->set($act_opt);
      $this->db->insert('actividad_oportunidades');
    }

    public function mostrar_actividad($opt)
    {
      $this->db->select('actividad.*,actividad_oportunidades.*,estatus.*');
      $this->db->from('actividad');
      $this->db->join('actividad_oportunidades','actividad.id_actividad = actividad_oportunidades.id_actividad','inner');
      $this->db->join('estatus','estatus.id_estatus = actividad.estatus');
      $this->db->where('id_oportunidades',$opt);
      $this->db->order_by('actividad.fecha','desc');
      $this->db->order_by('actividad.hora','desc');

      $query = $this->db->get();
      return $query->result();
    }

    public function cambiar_fase($opt,$fase)
    {
      $this->db->set($fase);
      $this->db->where('id_oportunidades',$opt);
      $this->db->update('oportunidades');
    }


}