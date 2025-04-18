<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contratista_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Este metodo conecta a nuestra segunda conexión
        // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
        $this->db_b = $this->load->database('SNCenlinea', true);
    }

    public function consulta_estados()
    {
        $this->db_b->select('*');
        $this->db_b->order_by("id", "ASC");
        $query = $this->db_b->get('public.estados');
        return $response = $query->result_array();
    }

    public function consulta_objcon()
    {
        $this->db_b->select('*');
        $this->db_b->order_by("id", "ASC");
        $query = $this->db_b->get('public.objcontratistas');
        return $response = $query->result_array();
    }
    // se cambio la consulta xq pn  persona natural no tiene acta contisturiva  revisar siled
    public function llenar_contratistas($data)
    {
        $this->db_b->select('*');
        $this->db_b->where('rifced', $data['rif_b']);
        $query = $this->db_b->get('public.planillapirmera2');
        $result = $query->row_array();
        if ($result == '') {
            $this->db_b->select('*');
            $this->db_b->where('rifced', $data['rif_b']);;
            $query = $this->db_b->get('public.pn');
            return $result = $query->row_array();
        } else {
            return $result;
        }
    }
    // public function llenar_contratistas($data){
    //     $this->db_b->select('*');
    //     $this->db_b->where('rifced', $data['rif_b']);
    //   //  $this->db_b->order_by("id", "Desc");
    //      $this->db_b->order_by("proceso_id", "Desc");

    //   //  $query = $this->db_b->get('public.infcontratista');
    //      $query = $this->db_b->get('public.planillapirmera2');

    //     return $response = $query->row_array(); // sin el foreach
    // }

    //BUSQUEDA DE CONTRATISTAS POR NOMBRE
    public function llenar_contratista_nombre($data)
    {
        $this->db_b->select(' rifced, nombre,fecactsusc_at ,descobjcont');
        $this->db_b->where("fecactsusc_at >", "01-01-2017");
        $this->db_b->like('nombre', $data['nombre']);
        $this->db_b->group_by("rifced, nombre,fecactsusc_at,descobjcont");
        $this->db_b->order_by("rifced", "Asc");
        //  $query = $this->db_b->get('public.infcontratista');
        $query = $this->db_b->get('public.planillapirmera2');
        return $response = $query->result_array(); // sin el foreach
    }

    //BUSQUEDA DE CONTRATISTAS POR OBJETO DE CONTRATACION
    public function llenar_contratista_objCont($data)
    {
        $this->db_b->select('c.rifced,
							 c.nombre,
							 c.objcontratista_id,
							 o.descobjcont');
        $this->db_b->join('objcontratistas o', 'o.id = c.objcontratista_id ');
        $this->db_b->like('c.nombre', $data['nombre']);
        $this->db_b->where('c.objcontratista_id', $data['obj_cont']);
        $this->db_b->where('c.estado_id', $data['estado_id']);
        $this->db_b->order_by("rifced", "Desc");
        $query = $this->db_b->get('public.contratistas c');
        return $response = $query->result_array(); // sin el foreach
    }
    public function consulta_planillaresumen($rifced)
    {
        $this->db_b->select('*');
        $this->db_b->where('rifced', $rifced);
        $query = $this->db_b->get('public.planillapirmera2');
        $result = $query->row_array();
        if ($result == '') {
            $this->db_b->select('*');
            $this->db_b->where('rifced', $rifced);
            $query = $this->db_b->get('public.pn');
            return $result = $query->row_array();
        } else {
            return $result;
        }
    }
    //   public function consulta_planillaresumen_todo1($data){
    //     $this->db_b->select('c.id, c.contratista_id,p.edocontratista_id, e.descripcion');
    //     $this->db_b->join('public.contratistas p', 'p.id = c.contratista_id');
    //     $this->db_b->join('public.edocontratistas e', 'e.id = p.edocontratista_id');


    //     $this->db_b->where('c.id', $data);
    //     $query = $this->db_b->get('public.procesos c');
    //     $result = $query->row_array();
    //     if ($result == '') {
    //         $this->db_b->select('*');
    //         $this->db_b->where('proceso_id', $data);
    //         $query = $this->db_b->get('public.pn');
    //         return $result = $query->row_array();
    //     }else {
    //         return $result;
    //     }
    // }

    function consulta_planillaresumen_todo1($data1)
    {  // con esto estoy armando los plailla resumen de investigacion

        $query = $this->db_b->query("SELECT c.id, c.contratista_id,p.edocontratista_id, e.descripcion, p.rifced, p.nombre   , p.numcertrnc ,p.fecinscrnc_at,
            p.fecvencrnc_at, p.tipopersona , p.dencomerciale_id, d.descdencom, g.nomprom, g.empseguro, g.vigilancia,g.prendamilitar, g.objcontratista_id,
            o.descobjcont, g.provf, g.provd, g.prova,g.obras, g.servn, g.serva, g.dir1, g.dir2, g.dir3, g.dir4, g.ptoref,
            g.estado_id, g.ciudade_id, g.municipio_id, g.parroquia_id , a.descedo, i.descciu, m.descmun, q.descparro, g.percontacto, g.telf1, g.telf2, g.email, g.website
                FROM public.procesos c
                join  public.contratistas p on p.id = c.contratista_id	
                join  public.edocontratistas e on e.id = p.edocontratista_id	
                join  public.dencomerciales d on d.id = p.dencomerciale_id	
                join  public.datosgenerales g on g.proceso_id = c.id	
                join  public.objcontratistas o on g.objcontratista_id = o.id	
                left join  public.estados a on g.estado_id = a.id
                left join  public.ciudades i on g.ciudade_id = i.id	
                left join  public.municipios m on g.municipio_id = m.id	
                left join  public.parroquias q on g.parroquia_id = q.id	                       
                 where c.id = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo2($data1)
    {  // con esto estoy armando los plailla resumen de investigacion

        $query = $this->db_b->query("SELECT c.id, r.domfiscal, r.objsocial, r.fecduremp_at, r.fecdurjd_at,
        r.diaciefcal, r.mesciefcal, r.capsusc, r.cappagado
                FROM public.procesos c
                join  public.regmercantiles r on r.proceso_id = c.id	
                                     
                 where c.id = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_planillaresumen_todo3($data1)
    {

        $query = $this->db_b->query("SELECT c.id, m.proceso_id, m.cirjudiciale_id,  m.tipmodificacione_id, m.tipregmercantile_id, 
                               m.numreg, m.fecreg_at, m.tomo, m.folio, j.desccirjudicial, t.descmodif, tp.descrm

         FROM public.procesos c
         join public.modificaciones m on  m.proceso_id = c.id	
         join public.cirjudiciales j on  j.id = m.cirjudiciale_id	  
         join public.tipmodificaciones t on  t.id = m.tipmodificacione_id
         join public.tipregmercantiles tp on  tp.id = m.tipregmercantile_id

            
          where c.id = '$data1' 
       ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo4($data1)
    {

        $query = $this->db_b->query("
        SELECT c.id,
               r.proceso_id,  
               r.apeacc, 
               r.nomacc, 
               r.tipo, 
               r.cedrif, 
               r.edocivil,
               CASE 
                   WHEN r.acc = 1 THEN 'sí' 
                   ELSE 'no' 
               END AS acc_status,
                CASE 
                   WHEN r.jd = 1 THEN 'sí' 
                   ELSE 'no' 
               END AS jd_status,
                CASE 
                   WHEN r.rl = 1 THEN 'sí' 
                   ELSE 'no' 
               END AS rl_status,
               r.porcacc, 
               r.cargo, 
               r.tipobl
        FROM public.procesos c
        JOIN public.accionistas r ON r.proceso_id = c.id          
        WHERE c.id = '$data1' 
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo5($data1)
    {

        $query = $this->db_b->query("
        SELECT c.id,
               r.cedcom, r.nomcom, r.apecom, r.tipocom, r.cpc, r.fecdurcom_at
        FROM public.procesos c
        JOIN public.comisarios r ON r.proceso_id = c.id          
        WHERE c.id = '$data1' 
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo6($data1)
    {

        $query = $this->db_b->query("
        SELECT proceso_id, segmento_id,  desc_seg_mostrar, anoexp,  
        CASE 
                   WHEN tipexp = 'A' THEN 'AÑOS' 
                   ELSE 'Meses' 
               END AS tipexp_status, 
         CASE 
                   WHEN principal = 'f' THEN 'NO' 
                   ELSE 'SI' 
               END AS principal_status, 
                  CASE 
                   WHEN tipo = 'S' THEN 'Obras y/o Servicios' 
                   ELSE 'Bienes' 
               END AS tipo_status, 
          articulo_id,  desc_arti_mostrar, infoprod, desctiprel
        FROM public.actvyprodcdeclasifcompredo
        WHERE proceso_id = '$data1' 
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo7($data1)
    {

        $query = $this->db_b->query("
        SELECT proceso_id,cliente,  numcontrato, obraserv, fecini_at, fecfin_at, porcejec       
        FROM public.relobras
        WHERE proceso_id = '$data1'
        
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo8($data1)
    {

        $query = $this->db_b->query("
        SELECT proceso_id,cliente,  numcontrato,objcontrato, replegal,telf1,prodrel       
        FROM public.relclientes
        WHERE proceso_id = '$data1'
        
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo9($data1)
    {

        $query = $this->db_b->query("
        SELECT r.proceso_id, r.articulo_id, p.id, p.desc_arti_mostrar ,
        r.marca, r.capalm, (r.merlocal + r.merreg + r.mernac + r.merexp) total     
        FROM public.informes r
        JOIN public.articulos p ON p.id = r.articulo_id         
        WHERE r.proceso_id = '$data1'
        
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo10($data1)
    {

        $query = $this->db_b->query("
        SELECT proceso_id,  nomcont, apecont, cedcont, cpc, firmaaudit, revlimitada,
        fecha_at, opilimpia, abstopinion, opinion     ,  
        CASE 
                   WHEN abstopinion = 1 THEN 'SI' 
                   ELSE 'NO' 
               END AS abstopinion_status,
                    CASE 
                   WHEN opilimpia = 1 THEN 'SI' 
                   ELSE 'NO' 
               END AS opilimpia_status
        FROM public.dictamenes                 
        WHERE proceso_id = '$data1'
        
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_planillaresumen_todo11($data1)
    {

        $query = $this->db_b->query("
        SELECT *, CASE 
                   WHEN apertura = 1 THEN 'SI' 
                   ELSE 'NO' 
               END AS apertura_status,
               CASE 
                   WHEN actecon = 1 THEN 'SI' 
                   ELSE 'NO' 
               END AS actecon_status,
               CASE 
                   WHEN costohist = 1 THEN 'SI' 
                   ELSE 'NO' 
               END AS costohist_status
        FROM public.balances                
        WHERE proceso_id = '$data1'
        
    ");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    // public function consulta_planillaresumen($rifced){
    //     $this->db_b->select('*');
    //     $this->db_b->where('rifced', $rifced);
    //     $query = $this->db_b->get('public.planillapirmera2');
    //     return $response = $query->row_array();
    // }
    public function llenar_contratista_rp($proceso_id)
    {
        $this->db_b->select('proceso_id, descmodif, descrm, desccirjudicial,
                            numreg, fecreg_at, tomo, folio');
        $this->db_b->where('proceso_id', $proceso_id);
        $query = $this->db_b->get('public.planillapirmera2');
        return $query->result_array();
    }

    public function consulta_planillaresumen2($rif, $proceso_id)
    {
        $this->db_b->select('p.rifced, p.proceso_id, r.proceso_id, r.domfiscal, r.objsocial, r.fecduremp_at, r.fecdurjd_at,
        r.diaciefcal, r.mesciefcal, r.capsusc, r.cappagado');
        $this->db_b->join('public.planillapirmera2 p', 'p.proceso_id = r.proceso_id');
        $this->db_b->where('p.rifced', $rif);
        $this->db_b->where('p.proceso_id', $proceso_id);
        $this->db_b->order_by("p.proceso_id", "desc");
        $query = $this->db_b->get('public.regmercantiles r');
        return $response = $query->row_array();
    }
    public function consulta_accionistas($rif, $proceso_id)
    {
        $this->db_b->select('p.rifced, p.proceso_id, r.proceso_id,  r.apeacc, r.nomacc, r.tipo, r.cedrif, r.edocivil,
        r.acc, r.jd, r.rl, r.porcacc, r.cargo, r.tipobl');
        $this->db_b->join('public.planillapirmera2 p', 'p.proceso_id = r.proceso_id');
        $this->db_b->where('p.proceso_id', $proceso_id);
        $this->db_b->group_by('p.rifced, p.proceso_id, r.proceso_id,  r.apeacc, r.nomacc, r.tipo, r.cedrif, r.edocivil,
        r.acc, r.jd, r.rl, r.porcacc, r.cargo, r.tipobl');
        $this->db_b->order_by("p.proceso_id", "desc");
        $query = $this->db_b->get('public.accionistas r');
        return $query->result_array();
    }

    public function consulta_comisarios($rif, $proceso_id)
    {
        $this->db_b->select('p.rifced, p.proceso_id, r.proceso_id, 
        r.cedcom, r.nomcom, r.apecom, r.tipocom, r.cpc, r.fecdurcom_at');
        $this->db_b->join('public.planillapirmera2 p', 'p.proceso_id = r.proceso_id');
        $this->db_b->where('p.proceso_id', $proceso_id);
        $this->db_b->group_by('p.rifced, p.proceso_id, r.proceso_id, r.cedcom, r.nomcom, r.apecom, r.tipocom, r.cpc, r.fecdurcom_at');
        $this->db_b->order_by("p.proceso_id", "desc");
        $query = $this->db_b->get('public.comisarios r');
        return $query->result_array();
    }
    public function consulta_activ_prod_clasif_compr_edo($rif, $proceso_id)
    {
        $this->db_b->select('proceso_id, segmento_id,  desc_seg_mostrar, anoexp, tipexp, principal, 
        tipo,  articulo_id,  desc_arti_mostrar, infoprod, desctiprel');
        $this->db_b->where('proceso_id', $proceso_id);
        $this->db_b->order_by("segmento_id", "Asc");
        $query = $this->db_b->get('public.actvyprodcdeclasifcompredo');
        return $query->result_array();
    }
    public function consulta_rel_obr_serv($rif, $proceso_id)
    {
        $this->db_b->select(' proceso_id, cliente,  numcontrato, obraserv, fecini_at, fecfin_at, porcejec');
        $this->db_b->where('proceso_id', $proceso_id);
        $this->db_b->order_by("numcontrato", "Desc");
        $query = $this->db_b->get('public.relobras');
        return $query->result_array();
    }
    public function consulta_rel_cliente($rif, $proceso_id)
    {
        $this->db_b->select(' proceso_id, cliente,  numcontrato,objcontrato, replegal,telf1,prodrel');
        $this->db_b->where('proceso_id', $proceso_id);
        $this->db_b->order_by("proceso_id", "Desc");
        $query = $this->db_b->get('public.relclientes');
        return $query->result_array();
    }
    public function Informe_producto($rif, $proceso_id)
    {
        $this->db_b->select('r.proceso_id, r.articulo_id, p.id, p.desc_arti_mostrar ,
        r.marca, r.capalm, (r.merlocal + r.merreg + r.mernac + r.merexp) total');
        $this->db_b->join('public.articulos p', 'p.id = r.articulo_id');
        $this->db_b->where('r.proceso_id', $proceso_id);

        $query = $this->db_b->get('public.informes r');
        return $query->result_array(); //cuando uso foreach
    }
    public function consulta_dictamen($rif, $proceso_id)
    {
        $this->db_b->select(' proceso_id,  nomcont, apecont, cedcont, cpc, firmaaudit, revlimitada,
        fecha_at, opilimpia, abstopinion, opinion');
        $this->db_b->where('proceso_id', $proceso_id);
        $this->db_b->order_by("proceso_id", "Desc");
        $query = $this->db_b->get('public.dictamenes');
        return $response = $query->row_array(); // sin el foreach
    }
    public function consulta_Balance($rif, $proceso_id)
    {
        $this->db_b->select('*');
        $this->db_b->where('proceso_id', $proceso_id);
        $this->db_b->order_by("proceso_id", "Desc");
        $query = $this->db_b->get('public.balances');
        return $response = $query->row_array(); // sin el foreach
    }
    public function consulta_edoresultados($rif, $proceso_id)
    {
        $this->db_b->select('*');
        $this->db_b->where('proceso_id', $proceso_id);
        $query = $this->db_b->get('public.edoresultados');
        return $query->result_array();
    }
    public function consulta_anafinancieros($rif, $proceso_id)
    {
        $this->db_b->select('*');
        $this->db_b->where('proceso_id', $proceso_id);
        $query = $this->db_b->get('public.anafinancieros');
        return $query->result_array();
    }

    //   public function comprobante($rifced){
    //       $this->db_b->select('*');
    //       $this->db_b->where('rifced', $rifced);
    //       $this->db_b->order_by("proceso_id", "Desc");
    //       $query = $this->db_b->get('public.planillapirmera2');
    //       return $response = $query->row_array(); // sin el foreach

    //    }
    public function comprobante($rifced)
    {
        $this->db_b->select('*');
        $this->db_b->where('rifced', $rifced);
        $query = $this->db_b->get('public.planillapirmera2');
        $result = $query->row_array();
        if ($result == '') {
            $this->db_b->select('*');
            $this->db_b->where('rifced', $rifced);;
            $query = $this->db_b->get('public.pn');
            return $result = $query->row_array();
        } else {
            return $result;
        }
    }
    public function llenar_contratista_comi_conta($nombre)
    {
        $query = $this->db_b->query("SELECT c.rifced, c.nombre 
                from contratistas c 
                where c.edocontratista_id not in (1, 4)
                and (c.rifced in (select a.rifced from datosgenerales a, comisarios b where a.proceso_id=b.proceso_id and b.cpc like '%$nombre%') )
                OR c.rifced in (select a.rifced from datosgenerales a, dictamenes b where a.proceso_id=b.proceso_id and b.cpc like '%$nombre%')");

        // $query = $this->db_b->query($sql, array("%$nombre%", "%$nombre%"));

        if ($query) {
            return $query->result_array();
        } else {
            // Handle error
            log_message('error', 'Error executing query: ' . $this->db_b->_error_message());
            return array();
        }
    }
    //  public function llenar_contratista_comi_conta2($nombre) {
    //     $query = $this->db_b->query("select d.rifced, d.nombre, a.cedcom, a.nomcom, a.apecom, a.proceso_id
    //                                 from comisarios a, datosgenerales d where a.proceso_id = d.proceso_id 
    //                                 and cedcom = '$nombre'");
    //     if ($query) {
    //         return $query->result_array();
    //     } else {
    //         // Handle error
    //         log_message('error', 'Error executing query: '. $this->db_b->_error_message());
    //         return array();
    //     }
    // }
    public function llenar_contratista_comi_conta22($cedula)
    {
        $cedula_dictamenes = 'V0' . str_pad($cedula, 8, '0', STR_PAD_LEFT);

        $query = $this->db_b->query("
        select d.rifced, d.nombre, a.cedcom, a.nomcom as nomacc, a.apecom as apecom, a.proceso_id,  'comisario' AS tipo
        from comisarios a, datosgenerales d 
        where a.proceso_id = d.proceso_id 
        and a.cedcom = '$cedula'        
        union        
        select d.rifced, d.nombre, a.cedrif, a.nomacc as nomacc , a.apeacc as apecom, a.proceso_id ,   
        CASE 
        WHEN a.acc = 1 THEN 'Accionista'
        WHEN a.jd = 1 THEN 'Junta directiva'
        WHEN a.rl = 1 THEN 'Representante legal'
        ELSE 'accionista' 
        END AS tipo
        from accionistas a, datosgenerales d 
        where a.proceso_id = d.proceso_id 
        and a.cedrif = '$cedula'
        union
        select d.rifced, d.nombre, a.cedcont, a.nomcont as nomacc, a.apecont as apecom, a.proceso_id, 'comisario' AS tipo
        from dictamenes a, datosgenerales d 
        where a.proceso_id = d.proceso_id 
        and a.cedcont = '$cedula_dictamenes'
        union
        select d.rifced, d.nombre, a.cedcont, a.nomcont as nomacc, a.apecont as apecom, a.proceso_id, 'comisario' AS tipo
        from dictamenes a, datosgenerales d 
        where a.proceso_id = d.proceso_id 
        and a.cedcont ilike '%$cedula_dictamenes%'
    ");

        if ($query) {

            $this->db->select('max(e.id_contadorbusqueda_) as id1');
            $this->db->where('cedula_c', $cedula);
            $query1 = $this->db->get('rnc.contadorbusqueda_ e');
            $response4 = $query1->row_array();

            if (!empty($response4)) {
                $id1 = $response4['id1'] + 1;
            } else {
                $id1 = 1;
            }
            if ($id1 == 1) {
                date_default_timezone_set('America/Caracas'); // set the time zone to Venezuela

                $data4 = array(
                    'id_contadorbusqueda_'            => $id1,
                    'cedula_c'        => $cedula,
                    'login_time' => date('Y-m-d H:i:s'),
                );
                $this->db->insert("rnc.contadorbusqueda_", $data4);
            } else {

                date_default_timezone_set('America/Caracas'); // set the time zone to Venezuela
                $data4 = array(
                    'id_contadorbusqueda_' => $id1,
                    'login_time' => date('Y-m-d H:i:s'),
                );
                $this->db->where('cedula_c', $cedula);
                $update = $this->db->update('rnc.contadorbusqueda_', $data4);
            }
            return $query->result_array();
        } else {
            // Handle error
            log_message('error', 'Error executing query: ' . $this->db_b->_error_message());
            return array();
        }
    }
    function save_contratista_comi_cont2($data)
    {
        $this->db->select('max(e.id) as id1');
        $query1 = $this->db->get('contratistas.consultas_investigacion e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;
        $data1 = array(
            'id'            => $id1,
            'observacion' => $data['observacion'],
            'numero_oficio' => $data['numero_oficio'],
            'snc' => 1,
            'id_usuariov' => $data['id_usuario'],
            'fecha_consulta' => $data['fecha_consulta'],


            //'id_unidad_medida'           => $id_unidad_medida,

        );

        $query = $this->db->insert('contratistas.consultas_investigacion ', $data1);
        return true;
    }
    function registrar_b($data)
    {
        $this->db->insert('rnc.busqueda_', $data);
        return true;
    }
    function consultar_lis()
    {
        $this->db->select('b.cedula_c, b.n_oficio, b.observacion, b.id_usuario, b.existe, b.causa,
                          b.tipo_invs,t.desc_tipo_invs, b.datecreat, c2.id_contadorbusqueda_, f.nombrefun, f.apellido');
        $this->db->join('rnc.contadorbusqueda_ c2', 'c2.cedula_c = b.cedula_c', 'left');
        $this->db->join('seguridad.funcionarios f', 'f.id_usuario = b.id_usuario');
        $this->db->join('rnc.tipo_invs t', 't.id_tipo_invs = b.tipo_invs');

        $this->db->from('rnc.busqueda_ b');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function llenar_contratista_comi_conta23($cedula)
    {

        $query = $this->db_b->query("
        select rifced, nombre,percontacto,telf1, proceso_id
        from  datosgenerales 
        where rifced = '$cedula' 
        GROUP BY rifced, nombre,percontacto,telf1  , proceso_id  
    ");

        if ($query) {

            $this->db->select('max(e.id_contadorbusqueda_) as id1');
            $this->db->where('cedula_c', $cedula);
            $query1 = $this->db->get('rnc.contadorbusqueda_ e');
            $response4 = $query1->row_array();

            if (!empty($response4)) {
                $id1 = $response4['id1'] + 1;
            } else {
                $id1 = 1;
            }
            if ($id1 == 1) {
                date_default_timezone_set('America/Caracas'); // set the time zone to Venezuela

                $data4 = array(
                    'id_contadorbusqueda_'            => $id1,
                    'cedula_c'        => $cedula,
                    'login_time' => date('Y-m-d H:i:s'),
                );
                $this->db->insert("rnc.contadorbusqueda_", $data4);
            } else {

                date_default_timezone_set('America/Caracas'); // set the time zone to Venezuela
                $data4 = array(
                    'id_contadorbusqueda_' => $id1,
                    'login_time' => date('Y-m-d H:i:s'),
                );
                $this->db->where('cedula_c', $cedula);
                $update = $this->db->update('rnc.contadorbusqueda_', $data4);
            }
            return $query->result_array();
        } else {
            // Handle error
            log_message('error', 'Error executing query: ' . $this->db_b->_error_message());
            return array();
        }
    }

    public function llenar_contratista_comi_conta24($cedula)
    {

        $query = $this->db->query("
        select pac.*, p.descripcion, ti.desc_tipo_doc_contrata, o.descripcion as ente
        from  programacion.rendidicion pac
        left JOIN public.organoente o ON o.rif = pac.rif_organoente 
        JOIN evaluacion_desempenio.modalidad p ON p.id = pac.id_modalida_rendi  
        JOIN programacion.tipo_doc_contrata ti ON ti.id_tipo_doc_contrata  = pac.selc_tipo_doc_contrata   
        where pac.sel_rif_nombre = '$cedula' 
    ");

        if ($query) {

            return $query->result_array();
        } else {
            // Handle error
            log_message('error', 'Error executing query: ' . $this->db_b->_error_message());
            return array();
        }
    }
}
