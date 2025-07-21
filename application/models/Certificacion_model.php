<?php
class Certificacion_model extends CI_model
{
    private $table = "certificacion.certificaciones";
    public function __construct()
    {
        parent::__construct();
        // Este metodo conecta a nuestra segunda conexión
        // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
        $this->db_c = $this->load->database('SNCenlinea', true);
        $this->load->library('ciqrcode');
    }
    public function inf_1()
    {

        $this->db->select('*');
        $this->db->where('id_tarifa', 3);
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }
    public function inf_2()
    {

        $this->db->select('*');
        $this->db->where('id_alicuota_iva', 5);
        $query = $this->db->get('public.alicuota_iva');
        return $result = $query->result_array();
    }
    public function inf_3()
    {

        $this->db->select('*');
        $this->db->where('id_tarifa', 1);
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }
    public function inf_35()
    {

        $this->db->select('*');
        $this->db->where('id_tarifa', 3);
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }

    public function cons_nro_comprobante()
    {
        $this->db->select('id,id_comprobante,nro_comprobante,tipo_pers');
        $this->db->where('tipo_pers ', 1);
        $this->db->order_by('id_comprobante desc');
        $query = $this->db->get('certificacion.certificaciones ');
        $response = $query->row_array();
        return $response;
    }
    public function consulta_certi50($usuario)
    {
        $this->db->select('*');
        $this->db->where('user_soli', $usuario);
        //$this->db->where('status', '1');
        $query = $this->db->get('certificacion.certificaciones');
        return $response = $query->row_array(); // sin el foreach
    }
    public function consulta_certi_exter50($usuario)
    {
        $this->db->select('*');

        $this->db->where('user_soli', $usuario);
        $query = $this->db->get('certificacion.certificaciones');
        return $response = $query->row_array(); //f sin el foreach
    }
    public function consulta_certi()
    {
        $this->db->select('*');
        $this->db->from('certificacion.certificaciones ');
        //$this->db->where('status', '1');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function consulta_certi_pendiente()
    {
        $this->db->select('*');
        $this->db->from('certificacion.certificaciones ');
        $this->db->where('status', '1');

        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function consulta_certi_exter($usuario)
    {
        $this->db->select('*');
        $this->db->from('certificacion.certificaciones ');
        //$this->db-> where ("ed.id_usuario = '$usuario'");
        $this->db->where('user_soli', $usuario);
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function consulta_certi_exter2()
    {
        $this->db->select('*');
        $this->db->from('certificacion.certificaciones ');
        $this->db->where('status', '2');

        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function save_certificacion(
        $certifi,
        $experi_empre_capa,
        $experi_empre_cap_comisi,
        $infor_per_natu,
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3
    ) {

        $qrcode_data = $this->_generate_data_qrcode();
        $this->db->select('max(e.id_comprobante) as id_comprobante,e.tipo_pers');
        $this->db->where('e.tipo_pers', 1);
        $this->db->group_by('e.tipo_pers');
        $query = $this->db->get('certificacion.certificaciones e');
        $respon = $query->row_array();
        $id_comprobante = $respon['id_comprobante'] + 1;

        $this->db->select('max(e.id) as id');
        $query = $this->db->get('certificacion.certificaciones e');
        $response3 = $query->row_array();
        $id = $response3['id'] + 1;
        $certifi1 = array(

            'id' => $id,
            'id_comprobante' => $id_comprobante,
            'nro_comprobante' => $certifi['nro_comprobante'],
            'n_certif' => $certifi['n_certif'],
            'rif_cont' => $certifi['rif_cont'],
            'nombre' => $certifi['nombre'],
            'tipo_pers' => $certifi['tipo_pers'],
            'objetivo' => $certifi['objetivo'],
            'cont_prog' => $certifi['cont_prog'],
            'total_bss' => $certifi['total_bss'],
            'n_ref' => $certifi['n_ref'],
            'banco_e' => $certifi['banco_e'],
            'banco_rec' => $certifi['banco_rec'],
            'fecha_trans' => $certifi['fecha_trans'],
            'monto_trans' => $certifi['monto_trans'],
            'declara' => $certifi['declara'],
            'acepto' => $certifi['acepto'],
            'fecha_solic' => $certifi['fecha_solic'],
            'user_soli' => $certifi['user_soli'],
            'status' => $certifi['status'],
            'qrcode_path'   => $this->_generate_qrcode($this->input->post('rif_cont'), $qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
            'qrcode_data'   => $qrcode_data
        );
        $quers = $this->db->insert('certificacion.certificaciones', $certifi1);

        if ($quers) {
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.experi_empre_capa e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;

            $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data1 = array(
                    'id'              => $id,
                    'organo_experi_empre_capa'               => $experi_empre_capa['organo_experi_empre_capa'][$i],
                    'actividad_experi_empre_capa'              => $experi_empre_capa['actividad_experi_empre_capa'][$i],
                    'desde_experi_empre_capa'               => $experi_empre_capa['desde_experi_empre_capa'][$i],
                    'hasta_experi_empre_capa'                 => $experi_empre_capa['hasta_experi_empre_capa'][$i],
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont'             => $experi_empre_capa['rif_cont'],
                    'nro_comprobante' => $experi_empre_capa['nro_comprobante']
                );
                $this->db->insert('certificacion.experi_empre_capa', $data1);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.experi_empre_cap_comisi e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_pff = $experi_empre_cap_comisi['organo_expe'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {
                $data2 = array(
                    'id'              => $id,
                    'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $experi_empre_cap_comisi['rif_cont'],
                    'organo_expe'                   => $experi_empre_cap_comisi['organo_expe'][$i],
                    'actividad_exp'              => $experi_empre_cap_comisi['actividad_exp'][$i],
                    'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
                    'hasta_exp'                 => $experi_empre_cap_comisi['hasta_exp'][$i],

                );
                $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.infor_per_natu e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_pfft = $infor_per_natu['nombre_ape'];
            $count_pffr = count($cant_pfft);

            for ($i = 0; $i < $count_pffr; $i++) {
                $data3 = array(
                    'id'              => $id,
                    'nro_comprobante' => $certifi['nro_comprobante'],
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'nombre_ape'                   => $infor_per_natu['nombre_ape'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],
                    'rif'             => $infor_per_natu['rif'][$i],
                    'bolivar_estimado'                 => $infor_per_natu['bolivar_estimado'][$i],
                    'pj'                 => $infor_per_natu['pj'],
                    'sub_total'                 => $infor_per_natu['sub_total'],
                    'total_final'                 => $infor_per_natu['total_bss'],
                    'status'                 => 1,

                );
                $this->db->insert('certificacion.infor_per_natu', $data3);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.infor_per_prof e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $certifi['nro_comprobante'],
                    'cedula'              => $infor_per_natu['cedula'][$i],


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.for_mat_contr_publ e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $certifi['nro_comprobante'],
                    'cedula'              => $infor_per_natu['cedula'][$i],


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.exp_par_comi_10 e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],



                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.exp_dic_cap_3 e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
            return true;
        }
    }

    public function certificaciones($rif_cont)
    {

        $this->db->select('pp.*');

        $this->db->where('pp.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.certificaciones pp');
        return $query->result_array();
    }
    public function certificaciones_ver($rif_cont)
    {

        $this->db->select('pp.*,p.nombrefun, p.apellido');
        $this->db->join('seguridad.funcionarios p', 'p.id_usuario = pp.user_snc_aprob');
        $this->db->where('pp.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.certificaciones pp');
        return $query->result_array();
    }
    public function edit_pn_infor_per_nat($rif_cont)
    {

        $this->db->select('pp.*');

        $this->db->where('pp.rif_cont', $rif_cont);

        $query = $this->db->get('certificacion.infor_per_natu pp');
        return $query->result_array();
    }

    public function certificaciones2($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.experi_empre_capa pf');
        return $query->result_array();
    }
    public function certificaciones3($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.experi_empre_cap_comisi pf');
        return $query->result_array();
    }
    public function certificaciones4($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.infor_per_natu pf');
        return $query->result_array();
    }
    public function certificaciones5($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.infor_per_prof pf');
        return $query->result_array();
    }
    public function certificaciones6($rif_cont)
    {
        $this->db->select('pf.*');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.for_mat_contr_publ pf');
        return $query->result_array();
    }
    public function certificaciones7($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.exp_par_comi_10 pf');
        return $query->result_array();
    }
    public function certificaciones8($rif_cont)
    {
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont);
        $query = $this->db->get('certificacion.exp_dic_cap_3 pf');
        return $query->result_array();
    }

    public function inf_2_edit($data)
    {
        $this->db->select('pf.*
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.experi_empre_capa pf');
        return $query->result_array();
    }

    public function inf_3_o($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.experi_empre_cap_comisi pf');
        return $query->result_array();
    }
    public function inf_3_1($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.infor_per_natu pf');
        return $query->result_array();
    }
    public function inf_3_2($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.infor_per_prof pf');
        return $query->result_array();
    }
    public function inf_3_3($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.for_mat_contr_publ pf');
        return $query->result_array();
    }
    public function inf_3_4($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.exp_par_comi_10 pf');
        return $query->result_array();
    }
    public function inf_3_5($data)
    {
        $this->db->select('pf.*,
                            ');
        $this->db->join('certificacion.certificaciones pp', 'pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.exp_dic_cap_3 pf');
        return $query->result_array();
    }


    public function editarcertificacion_pj(
        $rif_cont,
        $certifi,   //editar certificacion  pj
        $experi_empre_capa,
        $experi_empre_cap_comisi,
        $infor_per_natu,
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3
    ) {
        $this->db->where('rif_cont', $rif_cont);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('certificacion.certificaciones', $certifi);

        if ($update) {
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.experi_empre_capa');
            $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data_inf = array(
                    'id'              => $experi_empre_capa['id'],
                    'organo_experi_empre_capa'               => $experi_empre_capa['organo_experi_empre_capa'][$i],
                    'actividad_experi_empre_capa'              => $experi_empre_capa['actividad_experi_empre_capa'][$i],
                    'desde_experi_empre_capa'               => $experi_empre_capa['desde_experi_empre_capa'][$i],
                    'hasta_experi_empre_capa'                 => $experi_empre_capa['hasta_experi_empre_capa'][$i],
                    'n_certif' => $experi_empre_capa['n_certif'],
                    'rif_cont'             => $experi_empre_capa['rif_cont'],
                    'nro_comprobante' => $experi_empre_capa['nro_comprobante']

                );
                $this->db->insert('certificacion.experi_empre_capa', $data_inf);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.experi_empre_cap_comisi');

            $cant_pff = $experi_empre_cap_comisi['organo_expe'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
                    'n_certif' => $experi_empre_cap_comisi['n_certif'],
                    'rif_cont' => $experi_empre_cap_comisi['rif_cont'],
                    'organo_expe'                   => $experi_empre_cap_comisi['organo_expe'][$i],
                    'actividad_exp'              => $experi_empre_cap_comisi['actividad_exp'][$i],
                    'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
                    'hasta_exp'                 => $experi_empre_cap_comisi['hasta_exp'][$i],
                );
                $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
            }
            ////persona natural
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_natu');
            $cant_pfft = $infor_per_natu['nombre_ape'];
            $count_pffr = count($cant_pfft);

            for ($i = 0; $i < $count_pffr; $i++) {
                $data3 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'nro_comprobante' => $experi_empre_capa['nro_comprobante'],
                    'n_certif' => $experi_empre_cap_comisi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'nombre_ape'                   => $infor_per_natu['nombre_ape'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],
                    'rif'             => $infor_per_natu['rif'][$i],
                    'bolivar_estimado'                 => $infor_per_natu['bolivar_estimado'][$i],
                    'pj'                 => $infor_per_natu['pj'],
                    'sub_total'                 => $infor_per_natu['sub_total'],
                    'total_final'                 => $infor_per_natu['total_bss'],
                    'status'                 => 1,

                );
                $this->db->insert('certificacion.infor_per_natu', $data3);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_prof');

            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.infor_per_prof e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'n_certif' => $infor_per_prof['n_certif'],
                    'rif_cont' => $infor_per_prof['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $infor_per_prof['nro_comprobante'],
                    'cedula'              => $infor_per_natu['cedula'][$i],


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.for_mat_contr_publ');


            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'n_certif' => $for_mat_contr_publ['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $certifi['nro_comprobante'],
                    'cedula'              => $infor_per_natu['cedula'][$i],


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_par_comi_10');


            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'n_certif' => $exp_par_comi_10['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],
                    //'cedula'          	=> $infor_per_natu['cedula'][$i],
                    'cedula'           => $exp_par_comi_10['cedul10'][$i],



                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_dic_cap_3');


            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $experi_empre_cap_comisi['id'],

                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
        }
        return true;
    }
    public function sav_editar__certificacion_pn(
        $rif_cont,
        $certifi,
        $infor_per_natu,
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3
    ) { // guardar datos de certi PN
        $this->db->where('rif_cont', $rif_cont);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('certificacion.certificaciones', $certifi);

        if ($update) {
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_natu');
            $id = $id;
            $data2 = array(
                'id'              => $infor_per_natu['id'],
                'nombre_ape'             => $infor_per_natu['nombre_ape'],
                'cedula' => $infor_per_natu['cedula'],
                'rif' => $infor_per_natu['rif'],
                'sub_total'                   => $infor_per_natu['sub_total'],
                'total_final'              => $infor_per_natu['total_final'],
                'n_certif'             => $infor_per_natu['n_certif'],
                'rif_cont'                 => $infor_per_natu['rif_cont'],
                'nro_comprobante'                 => $infor_per_natu['nro_comprobante'],
            );
            $this->db->insert('certificacion.infor_per_natu ', $data2);


            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_prof');

            $id = $id;
            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $infor_per_prof['id'],
                    'n_certif' => $infor_per_prof['n_certif'],
                    'rif_cont' => $infor_per_prof['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $infor_per_prof['nro_comprobante']


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.for_mat_contr_publ');

            $id = $id;
            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $for_mat_contr_publ['id'],
                    'n_certif' => $for_mat_contr_publ['nro_comprobante'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $for_mat_contr_publ['nro_comprobante']


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_par_comi_10');

            $id = $id;
            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $exp_par_comi_10['id'],
                    'n_certif' => $exp_par_comi_10['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],

                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_dic_cap_3');

            $id = $id;
            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $exp_dic_cap_3['id'],

                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
        }
        return true;
    }
    public function renovacion__certificacion(
        $rif_cont,
        $certifi,   //Renovar certificacion  pj
        $experi_empre_capa,
        $experi_empre_cap_comisi,
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3,
        $infor_per_natu
    ) {
        $this->db->where('rif_cont', $rif_cont);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('certificacion.certificaciones', $certifi);

        if ($update) {
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.experi_empre_capa');

            $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data_inf = array(
                    'id'              => $experi_empre_capa['id'],
                    'organo_experi_empre_capa'               => $experi_empre_capa['organo_experi_empre_capa'][$i],
                    'actividad_experi_empre_capa'              => $experi_empre_capa['actividad_experi_empre_capa'][$i],
                    'desde_experi_empre_capa'               => $experi_empre_capa['desde_experi_empre_capa'][$i],
                    'hasta_experi_empre_capa'                 => $experi_empre_capa['hasta_experi_empre_capa'][$i],
                    'n_certif' => $experi_empre_capa['n_certif'],
                    'rif_cont'             => $experi_empre_capa['rif_cont'],
                    'nro_comprobante' => $experi_empre_capa['nro_comprobante']

                );
                $this->db->insert('certificacion.experi_empre_capa', $data_inf);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.experi_empre_cap_comisi');

            $cant_pff = $experi_empre_cap_comisi['organo_expe'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id'              => $experi_empre_cap_comisi['id'],
                    'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
                    'n_certif' => $experi_empre_cap_comisi['n_certif'],
                    'rif_cont' => $experi_empre_cap_comisi['rif_cont'],
                    'organo_expe'                   => $experi_empre_cap_comisi['organo_expe'][$i],
                    'actividad_exp'              => $experi_empre_cap_comisi['actividad_exp'][$i],
                    'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
                    'hasta_exp'                 => $experi_empre_cap_comisi['hasta_exp'][$i],
                );
                $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
            }
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_natu');
            $cant_pfft = $infor_per_natu['nombre_ape'];
            $count_pffr = count($cant_pfft);

            for ($i = 0; $i < $count_pffr; $i++) {
                $data3 = array(
                    'id'              => $infor_per_natu['id'],
                    'nro_comprobante' => $infor_per_natu['nro_comprobante'],
                    'n_certif' => $infor_per_natu['n_certif'],
                    'rif_cont' => $infor_per_natu['rif_cont'],
                    'nombre_ape'                   => $infor_per_natu['nombre_ape'][$i],
                    'cedula'              => $infor_per_natu['cedula'][$i],
                    'rif'             => $infor_per_natu['rif'][$i],
                    'bolivar_estimado'                 => $infor_per_natu['bolivar_estimado'][$i],
                    'pj'                 => $infor_per_natu['pj'],
                    'sub_total'                 => $infor_per_natu['sub_total'],
                    'total_final'                 => $infor_per_natu['total_bss'],

                );
                $this->db->insert('certificacion.infor_per_natu', $data3);
            }


            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_prof');
            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $infor_per_prof['id'],
                    'n_certif' => $infor_per_prof['n_certif'],
                    'rif_cont' => $infor_per_prof['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $infor_per_prof['nro_comprobante']


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.for_mat_contr_publ');


            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $for_mat_contr_publ['id'],
                    'n_certif' => $for_mat_contr_publ['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $for_mat_contr_publ['nro_comprobante']


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_par_comi_10');


            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $exp_par_comi_10['id'],
                    'n_certif' => $exp_par_comi_10['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],

                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_dic_cap_3');

            $this->db->select('max(e.id) as id');
            $query = $this->db->get('certificacion.exp_dic_cap_3 e');
            $response3 = $query->row_array();
            $id = $response3['id'] + 1;
            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $exp_dic_cap_3['id'],
                    'n_certif' => $exp_dic_cap_3['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
        }
        return true;
    }
    public function save_renovacion__certificacion_pn(
        $rif_cont,
        $certifi,   //Renovar certificacion  pn
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3,
        $infor_per_natu
    ) {
        $this->db->where('rif_cont', $rif_cont);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('certificacion.certificaciones', $certifi);

        if ($update) {


            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_natu');
            $id = $id;
            $data2 = array(
                'id'              => $infor_per_natu['id'],
                'nombre_ape'             => $infor_per_natu['nombre_ape'],
                'cedula' => $infor_per_natu['cedula'],
                'rif' => $infor_per_natu['rif'],
                'sub_total'                   => $infor_per_natu['sub_total'],
                'total_final'              => $infor_per_natu['total_final'],
                'n_certif'             => $infor_per_natu['n_certif'],
                'rif_cont'                 => $infor_per_natu['rif_cont'],
                'nro_comprobante'                 => $infor_per_natu['nro_comprobante'],
            );
            $this->db->insert('certificacion.infor_per_natu ', $data2);


            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.infor_per_prof');


            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $infor_per_prof['id'],
                    'n_certif' => $infor_per_prof['n_certif'],
                    'rif_cont' => $infor_per_prof['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $infor_per_prof['nro_comprobante']


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.for_mat_contr_publ');

            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $for_mat_contr_publ['id'],
                    'n_certif' => $for_mat_contr_publ['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $for_mat_contr_publ['nro_comprobante']


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_par_comi_10');


            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $exp_par_comi_10['id'],
                    'n_certif' => $exp_par_comi_10['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],

                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }

            $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
            $this->db->delete('certificacion.exp_dic_cap_3');


            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $exp_dic_cap_3['id'],
                    'n_certif' => $exp_dic_cap_3['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
        }
        return true;
    }

    public function certificaciones_id($data)
    {
        $this->db->select('m.*');
        $this->db->from('certificacion.certificaciones m');

        $this->db->where('m.id', $data['id']);

        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }




    // public function guardar_proc_pag($data)
    // {
    //     // se guardan los fecha de vigencia

    //     $this->db->select('e.id as id, e.rif_cont');
    //     $this->db->where('e.rif_cont', $data['rif_cont']);
    //     $query = $this->db->get('certificacion.certificaciones e');
    //     $response = $query->row_array();

    //     $id = $response['id'] + 0;
    //     $data1 = array(
    //         'status' => $data['status'],
    //         'vigen_cert_desde' => $data['vigen_cert_desde'],

    //         'vigen_cert_hasta' => $data['vigen_cert_hasta'],
    //         'user_snc_aprob' => $data['users'],
    //         'fecha_status' => date('Y-m-d h:i:s'),
    //         'observacion' => $data['observacion'],

    //     );


    //     $this->db->where('rif_cont', $data['rif_cont']);
    //     $update = $this->db->update('certificacion.certificaciones', $data1);

    //     //return true;
    //     return $id;
    // }
    public function guardar_proc_pag($data)
    {
        // === ADAPTACIÓN CLAVE: Usar el ID de la certificación para la actualización ===
        // Este 'id_certificacion_gestion' debe venir del formulario JS
        $id_certificacion_to_update = $data['id_certificacion_gestion'];

        if (empty($id_certificacion_to_update)) {
            // Manejar error si el ID no llegó, o lanzar una excepción
            log_message('error', 'ID de certificación faltante para guardar_proc_pag en el modelo.');
            return 0; // O false para indicar fallo
        }

        $update_data = array(
            'status' => $data['status'],
            'vigen_cert_desde' => $data['vigen_cert_desde'],
            'vigen_cert_hasta' => $data['vigen_cert_hasta'], // Este valor viene calculado del JS (1 año)
            'user_snc_aprob' => $data['users'],
            'fecha_status' => date('Y-m-d H:i:s'), // Formato YYYY-MM-DD HH:MM:SS
            'observacion' => $data['observacion'],
        );

        // Actualiza por el ID único de la certificación, no por rif_cont, para mayor precisión
        $this->db->where('id', $id_certificacion_to_update); // <<-- Cláusula WHERE por el ID único
        $update = $this->db->update('certificacion.certificaciones', $update_data);

        if ($update) {
            return $id_certificacion_to_update; // Retorna el ID de la certificación si fue exitoso
        } else {
            log_message('error', 'Error al actualizar certificación en DB: ' . $this->db->error()['message']);
            return 0; // O false si hay error
        }
    }

    //pdf
    public function ver_pdfs($data)
    {
        $this->db->select('m.*, b.nombre_ape, b.cedula');
        $this->db->from('certificacion.certificaciones m');
        $this->db->join('certificacion.infor_per_natu b', 'b.id = m.id', 'left');
        $this->db->where('m.id', $data);
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }

    public function ver_pdfs2($id_certificacion) // Renombrado de $data a $id_certificacion
    {
        // Asegurarse de que el ID es un entero para la consulta
        $id_certificacion = (int)$id_certificacion;

        $this->db->select('m.*, b.nombre_ape, b.cedula'); // Selección inicial
        $this->db->from('certificacion.certificaciones m');
        // El join actual b.id = m.id implica 1 facilitador por certificación
        // Si 'b' es infor_per_natu y 'm' es certificaciones de personas jurídicas,
        // la relación `b.id = m.id` es inusual.
        // Asumo que 'b' debería ser infor_per_juri para los datos de la empresa,
        // y 'infor_per_natu' es una tabla separada para los facilitadores.
        // Si m.id es el id de la certificación de la persona JURÍDICA,
        // y b.id es el id de la PERSONA NATURAL, ¿cómo se relacionan?
        // Necesitamos una clave foránea en 'infor_per_natu' o una tabla pivote.

        // Por ahora, para obtener la Razón Social y RIF, asumiré que 'm' ya los tiene
        // o que 'b' es la tabla de información de la Persona JURÍDICA.
        // Si 'm' es la tabla de certificación (que enlaza a infor_per_natu y infor_per_juri)
        // y tu certificación es de tipo PJ, entonces 'm' debe tener una FK a infor_per_juri.

        // Vamos a asumir que 'm' (certificaciones) tiene las columnas 'razon_social', 'rif_pj', 'nro_certificado_rnc', 'nro_comprobante_registro', 'vigencia_desde', 'vigencia_hasta'
        // Si 'm' no las tiene, entonces necesitaríamos hacer JOIN a 'infor_per_juri'.
        // Para este ejemplo, simplifico asumiendo que vienen de 'm' o 'b' si 'b' es la PJ info.

        // SELECT DE LA INFORMACIÓN PRINCIPAL (PERSONA JURÍDICA O CERTIFICACIÓN BASE)
        $this->db->select('m.*'); // Selecciona todas las columnas de la certificación
        // Añadir las columnas específicas que quieres si no están en 'm' directamente
        // Por ejemplo, si razón_social y rif_pj están en una tabla de persona jurídica relacionada.
        // $this->db->select('m.*, pj.razon_social, pj.rif_pj');
        // $this->db->join('certificacion.infor_per_juri pj', 'pj.id = m.id_persona_juridica', 'left'); // Ejemplo de JOIN

        $this->db->from('certificacion.certificaciones m');
        $this->db->where('m.id', $id_certificacion);
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }

    public function ver_pdfs_3($id_certificacion) // Renombrado de $data a $id_certificacion
    {
        // Asegurarse de que el ID es un entero para la consulta
        $id_certificacion = (int)$id_certificacion;

        // SELECT DE LOS FACILITADORES
        // Aquí es donde necesito más claridad. Cómo se relacionan los facilitadores con la certificación principal?
        // Asumo que hay una tabla 'facilitadores' (o 'infor_per_natu_facilitador') que tiene 'id_certificacion'
        // que apunta a 'certificaciones.id'.

        // Ejemplo de SELECT si hay una tabla 'certificacion.facilitadores'
        $this->db->select('f.nombre_apellido, f.cedula'); // Asumo que estas son las columnas en tu DB
        $this->db->from('certificacion.facilitadores f'); // Nombre de tabla de facilitadores
        $this->db->where('f.id_certificacion', $id_certificacion); // FK a la certificación
        // Si los facilitadores son de infor_per_natu y tienen una FK a la certificación de la PJ
        // $this->db->select('b.nombre_ape, b.cedula');
        // $this->db->from('certificacion.infor_per_natu b');
        // $this->db->where('b.id_certificacion_pj', $id_certificacion); // Suponiendo una FK en infor_per_natu

        // Si tu tabla infor_per_natu ya tiene la información de los facilitadores y está relacionada con certificaciones.
        // Tu JOIN actual 'b.id = m.id' es para una relación 1 a 1.
        // Si necesitas varios, probablemente necesites otra tabla o un JOIN diferente.
        // Por ahora, para que el código no falle, si 'ver_pdfs_2' es como lo tenías, y esperas varios resultados,
        // esto funcionará si hay múltiples registros en 'm' con el mismo 'id' (lo cual no es una PK).

        // Si realmente los facilitadores están en infor_per_natu y se relacionan por `m.id_facilitador = b.id`
        // o si es a través de una tabla intermedia.

        // Dado tu código original de ver_pdfs_2, que tenía `b.id = m.id`, esto parece una peculiaridad.
        // Para obtener múltiples, el JOIN debe ser 1 a muchos.

        // Por favor, CONFIRMA CÓMO SE RELACIONAN LOS FACILITADORES con la certificación principal.
        // Mientras tanto, para que el código compile, mantendré una versión similar a la tuya,
        // pero ten en cuenta que podría no traer todos los facilitadores si la relación no es 1 a muchos.

        $this->db->select('b.nombre_ape, b.cedula, b.status'); // Asegúrate que 'nombre_ape' y 'cedula' existen
        $this->db->from('certificacion.certificaciones m'); // Necesitas un from principal
        $this->db->join('certificacion.infor_per_natu b', 'b.id = m.id', 'left'); // Tu join original
        $this->db->where('m.id', $id_certificacion);
        $this->db->where('b.status', 1); // Solo facilitadores activos/aprobados
        $query = $this->db->get(); // No necesitas pasar el from a get() si ya lo tienes en from()
        return $result = $query->result_array(); // Esto devolverá un array de arrays, si hay múltiples.
    }
    public function ver_pdfs_2($data)
    {

        $this->db->select('m.*, b.nombre_ape, b.cedula,b.status');
        $this->db->join('certificacion.infor_per_natu b', 'b.id = m.id', 'left');
        $this->db->where('m.id', $data);
        $this->db->where('b.status', 1);
        $query = $this->db->get('certificacion.certificaciones m');
        return $result = $query->result_array();
    }
    ///////////////////////////////////////////////registro pn
    public function cons_nro_comprobantenn()
    {
        $this->db->select('id,id_comprobante,nro_comprobante,tipo_pers');
        $this->db->where('tipo_pers ', 2);
        $this->db->order_by('id_comprobante desc');
        $query = $this->db->get('certificacion.certificaciones ');
        $response = $query->row_array();
        return $response;
    }
    public function save_certificacion_pn(
        $certifi,
        $infor_per_natu,
        $infor_per_prof,
        $for_mat_contr_publ,
        $exp_par_comi_10,
        $exp_dic_cap_3
    ) {
        $qrcode_data = $this->_generate_data_qrcode();
        $this->db->select('max(e.id_comprobante) as id_comprobante,e.tipo_pers');
        $this->db->where('e.tipo_pers', 2);
        $this->db->group_by('e.tipo_pers');
        $query = $this->db->get('certificacion.certificaciones e');
        $respon = $query->row_array();
        $id_comprobante = $respon['id_comprobante'] + 1;

        $this->db->select('max(e.id) as id');
        $query = $this->db->get('certificacion.certificaciones e');
        $response3 = $query->row_array();
        $id = $response3['id'] + 1;
        $certifi1 = array(

            'id' => $id,
            'id_comprobante' => $id_comprobante,
            'nro_comprobante' => $certifi['nro_comprobante'],
            'n_certif' => $certifi['n_certif'],
            'rif_cont' => $certifi['rif_cont'],
            'nombre' => $certifi['nombre'],
            'tipo_pers' => $certifi['tipo_pers'],
            'objetivo' => $certifi['objetivo'],
            'cont_prog' => $certifi['cont_prog'],
            'total_bss' => $certifi['total_bss'],
            'n_ref' => $certifi['n_ref'],
            'banco_e' => $certifi['banco_e'],
            'banco_rec' => $certifi['banco_rec'],
            'fecha_trans' => $certifi['fecha_trans'],
            'monto_trans' => $certifi['monto_trans'],
            'declara' => $certifi['declara'],
            'acepto' => $certifi['acepto'],
            'fecha_solic' => $certifi['fecha_solic'],
            'user_soli' => $certifi['user_soli'],
            'status' => $certifi['status'],
            'qrcode_path'   => $this->_generate_qrcode($this->input->post('rif_cont'), $qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
            'qrcode_data'   => $qrcode_data
        );
        $quers = $this->db->insert('certificacion.certificaciones', $certifi1);

        if ($quers) {

            $id = $id;


            $data3 = array(
                'id'              => $id,
                'nro_comprobante' => $certifi['nro_comprobante'],
                'n_certif' => $certifi['n_certif'],
                'rif_cont' => $certifi['rif_cont'],
                'nombre_ape'                   => $infor_per_natu['nombre_ape'],
                'cedula'              => $infor_per_natu['cedula'],
                'rif'             => $infor_per_natu['rif'],
                'bolivar_estimado'                 => $infor_per_natu['bolivar_estimado'],
                //'pj' 	            => $infor_per_natu['pj'],
                'sub_total'                 => $infor_per_natu['sub_total'],
                'total_final'                 => $infor_per_natu['total_bss'],

            );
            $this->db->insert('certificacion.infor_per_natu', $data3);


            $cant_pfftt = $infor_per_prof['for_academica'];
            $count_pffrt = count($cant_pfftt);

            for ($i = 0; $i < $count_pffrt; $i++) {
                $data4 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'for_academica'           => $infor_per_prof['for_academica'][$i],
                    'titulo'              => $infor_per_prof['titulo'][$i],
                    'ano'             => $infor_per_prof['ano'][$i],
                    'culminacion'      => $infor_per_prof['culminacion'][$i],
                    'curso'                 => $infor_per_prof['curso'][$i],
                    'nro_comprobante' => $certifi['nro_comprobante']


                );
                $this->db->insert('certificacion.infor_per_prof', $data4);
            }

            $cant_1 = $for_mat_contr_publ['taller'];
            $count_1 = count($cant_1);

            for ($i = 0; $i < $count_1; $i++) {
                $data5 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'taller'           => $for_mat_contr_publ['taller'][$i],
                    'institucion'   => $for_mat_contr_publ['institucion'][$i],
                    'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                    'certi'      => $for_mat_contr_publ['certi'][$i],
                    'fech_cert'      => $for_mat_contr_publ['fech_cert'][$i],
                    'vigencia'        => $for_mat_contr_publ['vigencia'][$i],
                    'nro_comprobante' => $certifi['nro_comprobante']


                );
                $this->db->insert('certificacion.for_mat_contr_publ', $data5);
            }
            $cant_2 = $exp_par_comi_10['organo10'];
            $count_3 = count($cant_2);

            for ($i = 0; $i < $count_3; $i++) {
                $data6 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo10'           => $exp_par_comi_10['organo10'][$i],
                    'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                    'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                    'fecha_act'      => $exp_par_comi_10['fecha_act'][$i],
                    'area_10'      => $exp_par_comi_10['area_10'][$i],
                    'dura_comi'        => $exp_par_comi_10['dura_comi'][$i],



                );
                $this->db->insert('certificacion.exp_par_comi_10', $data6);
            }

            $cant_4 = $exp_dic_cap_3['organo3'];
            $count_5 = count($cant_4);

            for ($i = 0; $i < $count_5; $i++) {
                $data7 = array(
                    'id'              => $id,
                    'n_certif' => $certifi['n_certif'],
                    'rif_cont' => $certifi['rif_cont'],
                    'organo3'           => $exp_dic_cap_3['organo3'][$i],
                    'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                    'desde3'      => $exp_dic_cap_3['desde3'][$i],
                    'hasta3'      => $exp_dic_cap_3['hasta3'][$i],



                );
                $this->db->insert('certificacion.exp_dic_cap_3', $data7);
            }
        }
        return true;
    }

    /// este se usa cuando esta en prueba
    // public function llenar_contratista($data){
    //     $this->db_c->select('c.user_id,
    //                         c.edocontratista_id,
    //                         c.rifced,
    //                         c.numcertrnc,
    //                         c.nombre,
    //                         c.dirfiscal,
    //                         e.descedo,
    //                         c.ciudade_id,
    //                         c2.descciu,
    //                         m.descmun,
    //                         c.percontacto,
    //                         c.telf1,
    //                         c.ultprocaprob');
    //     $this->db_c->join('public.estados e', 'e.id = c.estado_id');
    //     $this->db_c->join('public.municipios m', 'm.id = c.municipio_id');
    //     $this->db_c->join('public.ciudades c2', 'c2.id = c.ciudade_id');
    //     $this->db_c->where('c.numcertrnc',$data['rif_b']);
    //     //$query = $this->db_c->get('public.contratistas c');
    //     $query = $this->db_c->get('evaluacion_desempenio.contratistas c');
    //     $result = $query->row_array();
    //         if ($result == '') {
    //             $this->db->select('c.user_id,
    //                                  c.edocontratista_id,
    //                                  c.rifced,
    //                                  c.nombre,
    //                                  c.dirfiscal,
    //                                  e.descedo,
    //                                  m.descmun,
    //                                  c.percontacto,
    //                                  c.telf1,
    //                                  c.procactual');
    //             $this->db->join('public.estados e', 'e.id = c.estado_id');
    //             $this->db->join('public.municipios m', 'm.id = c.municipio_id');
    //             $this->db->where('c.numcertrnc',$data['rif_b']);
    //             $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
    //             return $result = $query->row_array();
    //         }else {
    //             return $result;
    //         }
    //}
    //-------------------------------------------------------
    public function llenar_contratista_rp($data)
    {
        $this->db_c->select('proceso_id,
                           cedrif,
                           concat(nomacc, \'\' ,apeacc) as repr,
                           cargo ');
        $this->db_c->where('proceso_id', $data['ultprocaprob']);
        $query = $this->db_c->get('public.accionistas');
        $result = $query->result_array();

        if ($result == array()) {
            $this->db->select('cedrif,
                               concat(nomacc, \'\' ,apeacc) as repr,
                               cargo ');
            $this->db->where('rif_contratista', $data['rif_cont_nr']);
            $query = $this->db->get('evaluacion_desempenio.accionistas_nr');

            return $result = $query->result_array();
        } else {
            return $result;
        }
    }


    public function llenar_contratistas($data)
    {
        $this->db_b->select('*');
        $this->db_b->where('rifced', $data['rif_b']);
        $this->db_b->order_by("proceso_id", "Desc");
        $query = $this->db_b->get('public.planillapirmera2');
        return $response = $query->row_array(); // sin el foreach
    }

    public function get_data($qrcode_data = "")
    {
        $this->db->select('*')
            ->from($this->table);

        if (!empty($qrcode_data)) {
            $this->db->where('qrcode_data', $qrcode_data);
        }

        $res = $this->db->get();
        return $res->result_array();
    }

    public function save_data()
    {
        //memanggil method _generate_data_qrcode untuk proses generate data qrcode
        $qrcode_data = $this->_generate_data_qrcode();

        $data = array(
            'fullname'      => $this->input->post('fullname'),
            'email'       => $this->input->post('email'),
            'qrcode_path'   => $this->_generate_qrcode($this->input->post('fullname'), $qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
            'qrcode_data'   => $qrcode_data
        );
        $this->db->insert($this->table, $data);
    }

    //generate qrcode data
    public function _generate_data_qrcode()
    {
        $this->load->helper('string');
        $code = strtoupper(random_string('alnum', 6));
        //proses cek data qrcode untuk memastikan data qrcode bersifat unik
        $cek_data = $this->get_data($code);
        if (!empty($cek_data)) {
            //jika data qrcode ada yang sama, maka karakter terakhir dari data qrcode
            //akan di-replace dengan angka jumlah data yang sama + 1
            $code = substr_replace($code, count($cek_data) + 1, 5);
        }
        return $code;
    }


    //generate image qrcode
    public function _generate_qrcode($fullname, $data_code)
    {
        //load libraru qrcode
        $this->load->library('ciqrcode');

        //persiapan direktori untuk menyimpan image qrcode hasil generate.
        //Path dan nama direktori bisa kalian sesuaikan dengan kebutuhan kalian
        $directory = "./assets/img/qrcode";
        //persiapan filename untuk image qrcode. Diambil dari data fullname tanpa spasi + 3 digit angka random
        $file_name = str_replace(" ", "", strtolower($fullname)) . rand(pow(10, 2), pow(10, 3) - 1);

        //pembuatan direktori jika belum ada
        if (!is_dir($directory)) {
            mkdir($directory, 777, TRUE);
        }

        $config['cacheable']    = true; //boolean, the default is true
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        //menyisipkan ekstensi png pada filename qrcode
        $image_name = $file_name . '.png';

        $params['data'] = $data_code; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = $directory . '/' . $image_name;

        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        return  $image_name;
    }

    public function llenar_contratista($data)
    {  // esta es para consultar certificado en produccion
        $this->db_c->select('c.user_id,
                        c.edocontratista_id,
                        c.rifced,
                        c.numcertrnc,
                        c.nombre,
                        c.dirfiscal,
                        e.descedo,
                        c.ciudade_id,
                        c2.descciu,
                        m.descmun,
                        c.percontacto,
                        c.telf1,
                        c.ultprocaprob');
        $this->db_c->join('public.estados e', 'e.id = c.estado_id');
        $this->db_c->join('public.municipios m', 'm.id = c.municipio_id');
        $this->db_c->join('public.ciudades c2', 'c2.id = c.ciudade_id');
        $this->db_c->where('c.numcertrnc', $data['rif_b']);
        //$query = $this->db_c->get('public.contratistas c');
        $query = $this->db_c->get('public.contratistas c');
        $result = $query->row_array();
        if ($result == '') {
            $this->db->select('c.user_id,
                                 c.edocontratista_id,
                                 c.rifced,
                                 c.nombre,
                                 c.dirfiscal,
                                 e.descedo,
                                 m.descmun,
                                 c.percontacto,
                                 c.telf1,
                                 c.procactual');
            $this->db->join('public.estados e', 'e.id = c.estado_id');
            $this->db->join('public.municipios m', 'm.id = c.municipio_id');
            $this->db->where('c.numcertrnc', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
            return $result = $query->row_array();
        } else {
            return $result;
        }
    }

    function consultar_exonerado($data)
    {
        $this->db->select('*');
        $this->db->where('rif', $data['rif_organoente']);
        $query = $this->db->get('certificacion.exonerado');
        return $response = $query->row_array();
    }

    public function valida_exon($numcertrnc2)
    {
        $this->db->select('numcertrnc');
        $this->db->where('numcertrnc ', $numcertrnc2);
        //$this->db->order_by('id desc');
        $query = $this->db->get('certificacion.exonerado');
        $response = $query->row_array();
        return $response;
    }
    function consultar_exonerado_2()
    {
        $this->db->select('*');
        $this->db->from('certificacion.exonerado');
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    //GUARDAR
    function registrar_b($data)
    {
        $this->db->insert('certificacion.exonerado', $data);
        return true;
    }
    //VER PARA ver exonerado y editar
    function consulta_b($data)
    {
        $this->db->select('*');
        $this->db->from('certificacion.exonerado');
        $this->db->where('id_exonerado', $data['id_exonerado']);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    //EDITAR exonerado en bd
    function editar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $update = $this->db->update('certificacion.exonerado', $data);
        return true;
    }
    //ELIMAR
    function eliminar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $query = $this->db->delete('certificacion.exonerado');
        return true;
    }

    // esto es facilitador

    public function consulta_facilitador($usuario)
    {
        $this->db->select('c.user_soli, c.rif_cont, e.nombre_ape, e.cedula, e.rif, e.status ');

        $this->db->join('certificacion.infor_per_natu e', 'e.rif_cont = c.rif_cont');
        $this->db->where('c.user_soli', $usuario);

        $query = $this->db->get('certificacion.certificaciones c');
        return $result = $query->result_array();
    }

    function consulta_facilitadores($data)
    {
        $this->db->select('rif_cont,cedula,status');
        $this->db->from('certificacion.infor_per_natu');
        $this->db->where('cedula', $data['cedula']);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function cambiar_estatus($data)
    {
        $this->db->where('cedula', $data['cedula']);
        $this->db->where('rif_cont', $data['rif_cont']);
        $update = $this->db->update('certificacion.infor_per_natu', $data);
        return true;
    }
    /////////////////////////////////reporte por vencimiento
    public function consultar_vencimiento($data)
    {
        $this->db->select("nro_comprobante, nombre, rif_cont, n_certif, tipo_pers, vigen_cert_desde, vigen_cert_hasta,");

        $this->db->where('vigen_cert_hasta >=', $data['desde']);
        $this->db->where('vigen_cert_hasta <=', $data['hasta']);
        $this->db->order_by('nro_comprobante');

        $query = $this->db->get('certificacion.certificaciones ');
        return $query->result_array();
    }
    public function status($data)
    {
        if ($data['status'] == '1') {
            $this->db->select("nro_comprobante, nombre, rif_cont, n_certif, tipo_pers, vigen_cert_desde, status,vigen_cert_hasta,fecha_status");
            $this->db->where('status', $data['status']);
            $this->db->where('fecha_solic >=', $data['desde']);
            $this->db->where('fecha_solic <=', $data['hasta']);
            $this->db->order_by('nro_comprobante');

            $query = $this->db->get('certificacion.certificaciones ');
            return $query->result_array();
        } else {
            $this->db->select("nro_comprobante, nombre, rif_cont, n_certif, tipo_pers, vigen_cert_desde, status,vigen_cert_hasta,fecha_status");
            $this->db->where('status', $data['status']);
            $this->db->where('fecha_status >=', $data['desde']);
            $this->db->where('fecha_status <=', $data['hasta']);
            $this->db->order_by('nro_comprobante');

            $query = $this->db->get('certificacion.certificaciones ');
            return $query->result_array();
        }
    }
    /////////////////////////////llamado a concurso externo//////////////////////////////////////////////////


    function consulta_llamado($data)
    {
        $id = $data['numero_proceso'];
        $this->db->select('c.*, m.descripcion, me.descripcion as descr, obj.descripcion as obj');
        $this->db->join('public.modalidad m', 'm.id_modalidad = c.id_modalidad');
        $this->db->join('public.mecanismo me', 'me.id_mecanismo = c.id_mecanismo');
        $this->db->join('public.objeto_contratacion obj', 'obj.id_objeto_contratacion = c.id_objeto_contratacion');
        $this->db->from('public.llamado_concurso_view c');
        $this->db->where("numero_proceso", $id);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function consulta_llamados($data)
    {
        $id = $data['numero_proceso'];
        $this->db->select('m.* ');
        $this->db->from('public.llamado_concurso_view  m');
        $this->db->like("numero_proceso", $id);
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }
    function consultar_llamados_externos1()
    {
        $this->db->select('rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado ');
        $this->db->from('public.llamado_concurso_view');
        $this->db->order_by("fecha_disponible_llamado", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_llamados_externos($date)
    {

        $this->db->select('rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
        $this->db->from('public.llamado_concurso_view');
        $this->db->where("id_llcestatus >", "3");
        $this->db->where('fecha_disponible_llamado <=', $date);
        $this->db->order_by("fecha_disponible_llamado", "desc");
        $query = $this->db->get();
        return $query->result_array();

        // $query = $this->db->query("SELECT rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,

        // to_char(fecha_disponible_llamado,'DD/MM/YYYY') as formatted_date ,fecha_disponible_llamado,denominacion_proceso,estado


        // FROM public.llamado_concurso_view
        // where estatus= 'Iniciado' and fecha_disponible_llamado<='31-05-2023'"
        //                            );
        // return $response = $query->result_array();

    }
    ////////////consulta para pago 2
    function consulta_pago_2($data)
    {
        $this->db->select('id,rif_cont,total_bss');
        $this->db->from('certificacion.certificaciones');
        $this->db->where('id', $data['id']);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function guardar_pago_2($data)
    {
        $this->db->where('id', $data['id']);
        $update = $this->db->update('certificacion.certificaciones', $data);
        return true;
    }


    /////////////////////////

    private function _generate_data_qrcode1()
    {
        return uniqid() . '_' . time();
    }

    private function _generate_qrcode1($rif, $data_qrcode)
    {
        $path = './uploads/qrcodes/';
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
        $file_name = 'qrcode_' . $rif . '_' . time() . '.png';

        $params['data'] = $data_qrcode;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $path . $file_name;

        $this->ciqrcode->generate($params);
        return $path . $file_name;
    }

    // Nueva función para guardar la certificación inicial
    public function save_initial_certificacion_pn($data)
    {
        $this->db->trans_begin();

        // 1. Obtener el siguiente id_comprobante
        $this->db->select('MAX(id_comprobante) as max_id_comprobante');
        $this->db->where('tipo_pers', 2);
        $query = $this->db->get('certificacion.certificaciones');
        $result = $query->row_array();
        $next_id_comprobante = ($result['max_id_comprobante'] === null) ? 1 : $result['max_id_comprobante'] + 1;

        $formatted_nro_comprobante = 'PN-' . str_pad($next_id_comprobante, 19, '0', STR_PAD_LEFT);

        // 2. Obtener el siguiente id global
        $this->db->select('MAX(id) as max_id');
        $query_global_id = $this->db->get('certificacion.certificaciones');
        $result_global_id = $query_global_id->row_array();
        $next_global_id = ($result_global_id['max_id'] === null) ? 1 : $result_global_id['max_id'] + 1;

        // Datos para la tabla principal 'certificacion.certificaciones'
        // ¡Aquí simplificamos al máximo!
        $certificaciones_data = array(
            'id'              => $next_global_id, // Usamos el ID generado
            'id_comprobante'  => $next_id_comprobante,
            'nro_comprobante' => $formatted_nro_comprobante,
            'nombre'          => $data['nombre'],
            'rif_cont'        => $data['rif_cont'],
            'tipo_pers'       => $data['tipo_pers'],
            'objetivo'        => $data['objetivo'],
            'cont_prog'       => $data['cont_prog'],
            'fecha_solic'     => $data['fecha_solic'],
            'user_soli'       => $data['user_soli'],
            'status'          => $data['status'],
            // Dejar los campos numéricos como cadenas directas si son VARCHAR y permitir NULL
            'total_bss'       => $data['total_bss'], // Se espera ya formateado de frontend
            'monto_trans'     => $data['monto_trans'], // Se espera ya formateado de frontend
            'n_ref'           => $data['n_ref'],
            'banco_e'         => $data['banco_e'],
            'banco_rec'       => $data['banco_rec'],
            'fecha_trans'     => $data['fecha_trans'], // Puede ser NULL si no viene
            // Todos los demás campos que son NULL en tu tabla se pueden omitir aquí
            // o establecer explícitamente a NULL si es necesario
            'n_certif'          => NULL,
            'vigen_cert_desde'  => NULL,
            'vigen_cert_hasta'  => NULL,
            'observacion'       => NULL,
            'user_snc_aprob'    => NULL,
            'fecha_status'      => NULL,
            'declara'           => NULL,
            'acepto'            => NULL,
            'qrcode_path'       => NULL,
            'qrcode_data'       => NULL,
            'pago2'             => NULL,
            'motivo_pago_2'     => NULL,
            'banco_e2'          => NULL,
            'nro_referencia2'   => NULL,
            'fecha_trans2'      => NULL,
            'banco_rec_2'       => NULL,
            'revision'          => NULL,
            'fechatrnas2'       => NULL,
            'fecha_ven_solici'  => NULL
        );

        $this->db->insert('certificacion.certificaciones', $certificaciones_data);

        if ($this->db->affected_rows() > 0) {
            // Inserción de infor_per_natu (si es que siempre va con la principal)
            // Puedes simplificar esto también, o quitarlo temporalmente para aislar el problema
            $infor_per_natu_to_insert = array(
                'id'               => $next_global_id,
                'nro_comprobante'  => $formatted_nro_comprobante,
                'rif_cont'         => $data['rif_cont'],
                'nombre_ape'       => $data['nombre'],
                'bolivar_estimado' => $data['total_bss'], // De nuevo, si es VARCHAR, solo pasa el string
                'total_final'      => $data['total_bss'],
                'sub_total'        => NULL, // Se puede calcular en el frontend o dejar nulo por ahora
                'cedula'           => NULL,
                'n_certif'         => NULL
            );
            $this->db->insert('certificacion.infor_per_natu', $infor_per_natu_to_insert);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return ['success' => false, 'message' => 'Error en la transacción al guardar información de persona natural.'];
            } else {
                $this->db->trans_commit();
                return ['success' => true, 'cert_id' => $next_global_id, 'nro_comprobante' => $formatted_nro_comprobante];
            }
        } else {
            $this->db->trans_rollback();
            return ['success' => false, 'message' => 'No se pudo insertar la certificación principal.'];
        }
    }
    // Obtener información de la certificación principal por ID
    public function get_cert_info_by_id($cert_id)
    {
        $this->db->select('nro_comprobante, n_certif, rif_cont, nombre');
        $this->db->where('id', $cert_id);
        $query = $this->db->get('certificacion.certificaciones');
        return $query->row();
    }

    // Función para guardar Información de Persona Natural (si no se hizo en la principal)
    public function save_infor_persona_natural($data)
    {
        // Verificar si ya existe un registro para esta certificación y actualizar, o insertar
        $this->db->where('id', $data['id']);
        $query = $this->db->get('certificacion.infor_per_natu');
        if ($query->num_rows() > 0) {
            $this->db->where('id', $data['id']);
            return $this->db->update('certificacion.infor_per_natu', $data);
        } else {
            return $this->db->insert('certificacion.infor_per_natu', $data);
        }
    }


    // Función para agregar Formación Profesional
    public function add_formacion_profesional($data)
    {
        return $this->db->insert('certificacion.infor_per_prof', $data);
    }

    // Función para obtener la lista de formación profesional
    public function get_formacion_profesional_by_cert_id($cert_id)
    {
        $this->db->where('id', $cert_id);
        $query = $this->db->get('certificacion.infor_per_prof');
        return $query->result();
    }

    // Función para eliminar formación profesional
    public function delete_formacion_profesional($id_infor_prof)
    {
        $this->db->where('id_infor_prof', $id_infor_prof);
        return $this->db->delete('certificacion.infor_per_prof');
    }

    // Funciones similares (add, get, delete) para:
    // - for_mat_contr_publ
    // - exp_par_comi_10
    // - exp_dic_cap_3

    // Función para actualizar la certificación (declaración y status)
    public function update_certificacion_status($cert_id, $data_update)
    {
        $this->db->where('id', $cert_id);
        return $this->db->update('certificacion.certificaciones', $data_update);
    }

    // public function save_certificacion2(
    //     $certifi,
    //     $experi_empre_capa,
    //     $experi_empre_cap_comisi

    // ) {

    //     $qrcode_data = $this->_generate_data_qrcode();
    //     $this->db->select('max(e.id_comprobante) as id_comprobante,e.tipo_pers');
    //     $this->db->where('e.tipo_pers', 1);
    //     $this->db->group_by('e.tipo_pers');
    //     $query = $this->db->get('certificacion.certificaciones e');
    //     $respon = $query->row_array();
    //     $id_comprobante = $respon['id_comprobante'] + 1;

    //     $this->db->select('max(e.id) as id');
    //     $query = $this->db->get('certificacion.certificaciones e');
    //     $response3 = $query->row_array();
    //     $id = $response3['id'] + 1;
    //     $certifi1 = array(

    //         'id' => $id,
    //         'id_comprobante' => $id_comprobante,
    //         'nro_comprobante' => $certifi['nro_comprobante'],
    //         'n_certif' => $certifi['n_certif'],
    //         'rif_cont' => $certifi['rif_cont'],
    //         'nombre' => $certifi['nombre'],
    //         'tipo_pers' => $certifi['tipo_pers'],
    //         'objetivo' => $certifi['objetivo'],
    //         'cont_prog' => $certifi['cont_prog'],
    //         'total_bss' => $certifi['total_bss'],
    //         'n_ref' => $certifi['n_ref'],
    //         'banco_e' => $certifi['banco_e'],
    //         'banco_rec' => $certifi['banco_rec'],
    //         'fecha_trans' => $certifi['fecha_trans'],
    //         'monto_trans' => $certifi['monto_trans'],
    //         'declara' => $certifi['declara'],
    //         'acepto' => $certifi['acepto'],
    //         'fecha_solic' => $certifi['fecha_solic'],
    //         'user_soli' => $certifi['user_soli'],
    //         'status' => $certifi['status'],
    //         'qrcode_path'   => $this->_generate_qrcode($this->input->post('rif_cont'), $qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
    //         'qrcode_data'   => $qrcode_data
    //     );
    //     $quers = $this->db->insert('certificacion.certificaciones', $certifi1);

    //     if ($quers) {
    //         $this->db->select('max(e.id) as id');
    //         $query = $this->db->get('certificacion.experi_empre_capa e');
    //         $response3 = $query->row_array();
    //         $id = $response3['id'] + 1;

    //         $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
    //         $count_prog = count($cant_proy);
    //         for ($i = 0; $i < $count_prog; $i++) {
    //             $data1 = array(
    //                 'id'              => $id,
    //                 'organo_experi_empre_capa'               => $experi_empre_capa['organo_experi_empre_capa'][$i],
    //                 'actividad_experi_empre_capa'              => $experi_empre_capa['actividad_experi_empre_capa'][$i],
    //                 'desde_experi_empre_capa'               => $experi_empre_capa['desde_experi_empre_capa'][$i],
    //                 'hasta_experi_empre_capa'                 => $experi_empre_capa['hasta_experi_empre_capa'][$i],
    //                 'n_certif' => $certifi['n_certif'],
    //                 'rif_cont'             => $experi_empre_capa['rif_cont'],
    //                 'nro_comprobante' => $experi_empre_capa['nro_comprobante']
    //             );
    //             $this->db->insert('certificacion.experi_empre_capa', $data1);
    //         }
    //         $this->db->select('max(e.id) as id');
    //         $query = $this->db->get('certificacion.experi_empre_cap_comisi e');
    //         $response3 = $query->row_array();
    //         $id = $response3['id'] + 1;
    //         $cant_pff = $experi_empre_cap_comisi['organo_expe'];
    //         $count_pff = count($cant_pff);

    //         for ($i = 0; $i < $count_pff; $i++) {
    //             $data2 = array(
    //                 'id'              => $id,
    //                 'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
    //                 'n_certif' => $certifi['n_certif'],
    //                 'rif_cont' => $experi_empre_cap_comisi['rif_cont'],
    //                 'organo_expe'                   => $experi_empre_cap_comisi['organo_expe'][$i],
    //                 'actividad_exp'              => $experi_empre_cap_comisi['actividad_exp'][$i],
    //                 'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
    //                 'hasta_exp'                 => $experi_empre_cap_comisi['hasta_exp'][$i],

    //             );
    //             $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
    //         }


    //         return true;
    //     }
    // }

    public function save_certificacion2(
        $certifi,
        $experi_empre_capa_data,
        $experi_empre_cap_comisi_data
    ) {
        // Generate QR code data
        $qrcode_data = $this->_generate_data_qrcode();

        // Get the next id_comprobante for the main certification
        // (This seems to be a custom sequential ID, not necessarily the primary key 'id')
        $this->db->select('MAX(e.id_comprobante) as id_comprobante');
        $this->db->where('e.tipo_pers', 1);
        $this->db->group_by('e.tipo_pers');
        $query_comprobante = $this->db->get('certificacion.certificaciones e');
        $respon_comprobante = $query_comprobante->row_array();
        $id_comprobante = ($respon_comprobante && $respon_comprobante['id_comprobante']) ? $respon_comprobante['id_comprobante'] + 1 : 1;

        // Get the next main certification 'id' (primary key, if not auto-incrementing)
        $this->db->select('MAX(e.id) as id');
        $query_id = $this->db->get('certificacion.certificaciones e');
        $response_id = $query_id->row_array();
        $cert_id = ($response_id && $response_id['id']) ? $response_id['id'] + 1 : 1; // This will be the ID for the current certification

        // Prepare main certification data for insertion
        $certifi1 = array(
            'id'              => $cert_id, // Use the calculated ID for the main certification
            'id_comprobante'  => $id_comprobante,
            'nro_comprobante' => $certifi['nro_comprobante'],
            'n_certif'        => $certifi['n_certif'],
            'rif_cont'        => $certifi['rif_cont'],
            'nombre'          => $certifi['nombre'],
            'tipo_pers'       => $certifi['tipo_pers'],
            'objetivo'        => $certifi['objetivo'],
            'cont_prog'       => $certifi['cont_prog'],
            'total_bss'       => $certifi['total_bss'],
            'n_ref'           => $certifi['n_ref'],
            'banco_e'         => $certifi['banco_e'],
            'banco_rec'       => $certifi['banco_rec'],
            'fecha_trans'     => $certifi['fecha_trans'],
            'monto_trans'     => $certifi['monto_trans'],
            'declara'         => $certifi['declara'],
            'acepto'          => $certifi['acepto'],
            'fecha_solic'     => $certifi['fecha_solic'],
            'user_soli'       => $certifi['user_soli'],
            'status'          => $certifi['status'],
            'qrcode_path'     => $this->_generate_qrcode($certifi['rif_cont'], $qrcode_data),
            'qrcode_data'     => $qrcode_data
        );

        // Insert main certification data
        $quers = $this->db->insert('certificacion.certificaciones', $certifi1);

        // If the main certification was successfully inserted
        if ($quers) {
            // We now have the 'cert_id' from the main insert to use as a foreign key
            $inserted_cert_id = $cert_id; // This is the ID of the certification just inserted

            // --- Insert experi_empre_capa data ---
            if (!empty($experi_empre_capa_data['organo_experi_empre_capa']) && is_array($experi_empre_capa_data['organo_experi_empre_capa'])) {
                $count_prog = count($experi_empre_capa_data['organo_experi_empre_capa']);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        // Aquí asignamos el ID de la certificación principal a la columna 'id' de esta tabla
                        'id'                          => $inserted_cert_id,
                        'organo_experi_empre_capa'    => $experi_empre_capa_data['organo_experi_empre_capa'][$i],
                        'actividad_experi_empre_capa' => $experi_empre_capa_data['actividad_experi_empre_capa'][$i],
                        'desde_experi_empre_capa'     => $experi_empre_capa_data['desde_experi_empre_capa'][$i],
                        'hasta_experi_empre_capa'     => $experi_empre_capa_data['hasta_experi_empre_capa'][$i],
                        'n_certif'                    => $certifi['n_certif'],
                        'rif_cont'                    => $certifi['rif_cont'],
                        'nro_comprobante'             => $certifi['nro_comprobante']
                    );
                    $this->db->insert('certificacion.experi_empre_capa', $data1);
                }
            }

            // --- Insert experi_empre_cap_comisi data ---
            if (!empty($experi_empre_cap_comisi_data['organo_expe']) && is_array($experi_empre_cap_comisi_data['organo_expe'])) {
                $count_pff = count($experi_empre_cap_comisi_data['organo_expe']);
                for ($i = 0; $i < $count_pff; $i++) {
                    $data2 = array(
                        // Aquí asignamos el ID de la certificación principal a la columna 'id' de esta tabla
                        'id'              => $inserted_cert_id,
                        'nro_comprobante' => $certifi['nro_comprobante'],
                        'n_certif'        => $certifi['n_certif'],
                        'rif_cont'        => $certifi['rif_cont'],
                        'organo_expe'     => $experi_empre_cap_comisi_data['organo_expe'][$i],
                        'actividad_exp'   => $experi_empre_cap_comisi_data['actividad_exp'][$i],
                        'desde_exp'       => $experi_empre_cap_comisi_data['desde_exp'][$i],
                        'hasta_exp'       => $experi_empre_cap_comisi_data['hasta_exp'][$i],
                    );
                    $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
                }
            }
            return true;
        }
        return false;
    }
    function check_miemb_certi($id_comision)
    {

        $this->db->select('id, nro_comprobante, rif_cont, n_certif, nombre_ape, cedula, rif, bolivar_estimado, pj, sub_total, total_final, status, nombre_desin, cargo_desin, motivo');
        // $this->db->join('comisiones.area_miembro c2', 'c2.id_area_miembro = pi2.id_area_miembro');
        // $this->db->join('comisiones.tp_miembro c3', 'c3.id_tp_miembro = pi2.id_tp_miembro');
        // $this->db->join('comisiones.status_comision st', 'st.id_status = pi2.id_status');
        // $this->db->join('comisiones.status_miembro c4', 'c4.id_status_miembro = pi2.id_cert');
        $this->db->where('id ', $id_comision);
        $this->db->from('certificacion.infor_per_natu');
        $query = $this->db->get();
        return $query->result_array();
    }

    function registrar_facilitadoresjs($data)
    {
        $this->db->insert('certificacion.infor_per_natu', $data);
        return true;
    }

    public function save_inff($data) // Keep the existing function name
    {
        // Obtener el siguiente id_per
        $this->db->select('MAX(e.id_per) as max_id_per'); // Changed alias for clarity
        $query = $this->db->get('certificacion.infor_per_prof e');
        $result = $query->row_array();
        $next_id_per = ($result['max_id_per'] ?? 0) + 1;

        $insert_data = array(
            'id'             => $data['id_miembro'],      // This 'id' refers to the ID from infor_per_natu
            'rif_cont'       => $data['cedula'],           // Asumiendo que rif_cont es la cédula aquí
            'n_certif'       => null,                       // No hay campo para n_certif en tu form de acá. Dejar null.
            'for_academica'  => $data['fm_ac'],            // Desde el select de Formación Académica
            'titulo'         => $data['titulo'],
            'ano'            => $data['anioi'],            // Mapeando 'anioi' a 'ano'
            'culminacion'    => $data['anioc'],
            'curso'          => $data['curso'],
            'nro_comprobante' => $data['nro_comprobante'], // Desde el campo oculto
            'cedula'         => $data['cedula'],           // La cédula del miembro
            'id_per'         => $next_id_per,               // El ID autogenerado para esta tabla
        );

        // Debugging (optional): Log data before insertion
        log_message('debug', 'Data for infor_per_prof insertion: ' . print_r($insert_data, true));

        $query = $this->db->insert('certificacion.infor_per_prof', $insert_data);

        if ($query) {
            return 1; // Success
        } else {
            log_message('error', 'Error inserting into certificacion.infor_per_prof: ' . $this->db->error()['message']);
            return 0; // Error
        }
    }

    function check_miemb_inf_ac($cedula_del_miembro_actual)
    {
        // Add this line to see the value received by the model
        log_message('debug', 'Value of $id_miembros received in model: ' . $cedula_del_miembro_actual);

        $this->db->select('t1.id, t1.rif_cont, t1.n_certif, t1.for_academica, t1.titulo, t1.ano, t1.culminacion, t1.curso, t1.nro_comprobante, t1.cedula, t1.id_per, t2.desc_academico');
        $this->db->join('comisiones.academico t2', 't2.id_academico = t1.for_academica', 'left');
        $this->db->where('t1.cedula', $cedula_del_miembro_actual);
        $this->db->from('certificacion.infor_per_prof t1');
        $query = $this->db->get();
        return $query->result_array();
    }

    function check_miemb_inf_contr_pub($cedula_del_miembro_actual)
    {
        // Add this line to see the value received by the model
        log_message('debug', 'Value of $id_miembros received in model: ' . $cedula_del_miembro_actual);

        $this->db->select('id, rif_cont, n_certif, taller, institucion, hor_dura, certi, fech_cert, vigencia, nro_comprobante, cedula, id_form');
        $this->db->where('cedula', $cedula_del_miembro_actual);
        $this->db->from('certificacion.for_mat_contr_publ');

        // To see the exact query CodeIgniter generates:
        // echo $this->db->last_query();
        // die();

        $query = $this->db->get();
        return $query->result_array();
    }
    function check_miemb_inf_EXP_10($cedula_del_miembro_actual)
    {
        // Add this line to see the value received by the model
        // log_message('debug', 'Value of $id_miembros received in model: ' . $cedula_del_miembro_actual);

        $this->db->select('id, rif_cont, n_certif, organo10, act_adminis_desid, n_acto, fecha_act, area_10, dura_comi, nro_comprobante, cedula, id_exp_10');
        $this->db->where('cedula', $cedula_del_miembro_actual);
        $this->db->from('certificacion.exp_par_comi_10');

        // To see the exact query CodeIgniter generates:
        // echo $this->db->last_query();
        // die();

        $query = $this->db->get();
        return $query->result_array();
    }
    function check_miemb_inf_EXP_3($cedula_del_miembro_actual)
    {
        // Add this line to see the value received by the model
        // log_message('debug', 'Value of $id_miembros received in model: ' . $cedula_del_miembro_actual);

        $this->db->select('id, rif_cont, n_certif, organo3, actividad3, desde3, hasta3, cedula, id_dic_cap_3');
        $this->db->where('cedula', $cedula_del_miembro_actual);
        $this->db->from('certificacion.exp_dic_cap_3');

        // To see the exact query CodeIgniter generates:
        // echo $this->db->last_query();
        // die();

        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_formacion_cp($data)
    {
        // Obtener el siguiente id_form. Asumiendo que id_form es auto-incrementable
        // Si id_form no es auto-incrementable o es una secuencia específica, ajusta esta lógica.
        $this->db->select('MAX(t.id_form) as max_id_form');
        $query = $this->db->get('certificacion.for_mat_contr_publ t');
        $result = $query->row_array();
        $next_id_form = ($result['max_id_form'] ?? 0) + 1;

        $insert_data = array(
            'id'             => $data['id_comision'],      // ID del miembro de infor_per_natu
            'rif_cont'       => $data['cedula'],           // O el RIF que corresponda si es diferente a la cédula
            'n_certif'       => $data['certi'],            // Número de certificado
            'taller'         => $data['taller'],
            'institucion'    => $data['institucion'],
            'hor_dura'       => $data['hor_dura'],
            'certi'          => $data['certi'],            // Aquí hay duplicidad con n_certif, revisa tu tabla
            'fech_cert'      => $data['fech_cert'],
            'vigencia'       => $data['vigencia'],
            'nro_comprobante' => $data['nro_comprobante'],
            'cedula'         => $data['cedula'],
            'id_form'        => $next_id_form,
        );

        // print_r($insert_data); die; // Descomentar para depurar los datos antes de insertar

        $query = $this->db->insert('certificacion.for_mat_contr_publ', $insert_data);

        if ($query) {
            return 1; // Éxito
        } else {
            // Puedes loggear el error del DB si necesitas más detalles
            // log_message('error', 'Error inserting into for_mat_contr_publ: ' . $this->db->error()['message']);
            return 0; // Error
        }
    }
    public function get_member_basic_info_by_cedula($id_miembros)
    {
        $this->db->select('id, cedula, nro_comprobante'); // Select the columns you need
        $this->db->where('cedula', $id_miembros);
        $this->db->from('certificacion.infor_per_natu'); // Assuming this table holds cedula and nro_comprobante
        $query = $this->db->get();
        return $query->row_array(); // Return a single row (array) or null if not found
    }

    public function save_experiencia_comision($data)
    {
        // Obtener el siguiente id_exp_10. Asumiendo que id_exp_10 es auto-incrementable
        $this->db->select('MAX(t.id_exp_10) as max_id_exp_10');
        $query = $this->db->get('certificacion.exp_par_comi_10 t');
        $result = $query->row_array();
        $next_id_exp_10 = ($result['max_id_exp_10'] ?? 0) + 1;

        $insert_data = array(
            'id'                 => $data['id_comision'],      // ID del miembro de infor_per_natu
            'rif_cont'           => $data['cedula'],           // O el RIF que corresponda si es diferente a la cédula
            'n_certif'           => null,                       // No parece haber un campo n_certif en tu form para esto
            'organo10'           => $data['organo10'],
            'act_adminis_desid'  => $data['act_adminis_desid'],
            'n_acto'             => $data['n_acto'],
            'fecha_act'          => $data['fecha_act'],
            'area_10'            => $data['area_10'],
            'dura_comi'          => $data['dura_comi'],
            'nro_comprobante'    => $data['nro_comprobante'],
            'cedula'             => $data['cedula'],
            'id_exp_10'          => $next_id_exp_10,
        );

        // print_r($insert_data); die; // Descomentar para depurar los datos antes de insertar

        $query = $this->db->insert('certificacion.exp_par_comi_10', $insert_data);

        if ($query) {
            return 1; // Éxito
        } else {
            // Loggear el error del DB si necesitas más detalles
            log_message('error', 'Error inserting into exp_par_comi_10: ' . $this->db->error()['message']);
            return 0; // Error
        }
    }
    public function save_dictado_capacitacion($data)
    {
        // Obtener el siguiente id_dic_cap_3
        $this->db->select('MAX(t.id_dic_cap_3) as max_id_dic_cap_3');
        $query = $this->db->get('certificacion.exp_dic_cap_3 t');
        $result = $query->row_array();
        $next_id_dic_cap_3 = ($result['max_id_dic_cap_3'] ?? 0) + 1; // Usar 0 si es nulo + 1

        $insert_data = array(
            'id'             => $data['id_comision'],      // Este 'id' se refiere al ID del miembro de infor_per_natu
            'rif_cont'       => $data['cedula'],           // Asumiendo que rif_cont es la cédula del miembro
            'n_certif'       => null,                       // Mantener null si no hay campo en el formulario
            'organo3'        => $data['organo3'],
            'actividad3'     => $data['actividad3'],
            'desde3'         => $data['desde3'],
            'hasta3'         => $data['hasta3'],
            'cedula'         => $data['cedula'],           // La cédula del miembro
            'id_dic_cap_3'   => $next_id_dic_cap_3,         // <-- AHORA INCLUIMOS ESTE ID
            // 'nro_comprobante' no está en tu estructura de tabla, no lo incluimos
        );

        // print_r($insert_data); die; // Descomentar para depurar los datos antes de insertar

        $query = $this->db->insert('certificacion.exp_dic_cap_3', $insert_data);

        if ($query) {
            return 1; // Éxito
        } else {
            log_message('error', 'Error inserting into exp_dic_cap_3: ' . $this->db->error()['message']);
            return 0; // Error
        }
    }

    /////////////////editar  informacion de facilitadores
    // Método para obtener un registro académico por su id_per
    function get_inf_academica_by_id($id_per)
    {
        $this->db->select('t1.*, t2.desc_academico'); // Selecciona todos los campos de infor_per_prof y la descripción de academico
        $this->db->from('certificacion.infor_per_prof t1');
        $this->db->join('comisiones.academico t2', 't2.id_academico = t1.for_academica', 'left'); // JOIN para obtener desc_academico
        $this->db->where('t1.id_per', $id_per); // Filtra por el ID específico del registro
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una sola fila
    }

    // Método para actualizar un registro de información académica
    public function update_inf_academica($id_per, $data)
    {
        $this->db->where('id_per', $id_per);
        $query = $this->db->update('certificacion.infor_per_prof', $data);

        if ($query) {
            return 1; // Éxito
        } else {
            log_message('error', 'Error updating certificacion.infor_per_prof for id_per ' . $id_per . ': ' . $this->db->error()['message']);
            return 0; // Error
        }
    }
    function get_formacion_cp_by_id($id_form)
    {
        $this->db->select('id, rif_cont, n_certif, taller, institucion, hor_dura, certi, fech_cert, vigencia, nro_comprobante, cedula, id_form');
        $this->db->from('certificacion.for_mat_contr_publ');
        $this->db->where('id_form', $id_form); // Filtra por el ID específico del registro
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una sola fila
    }

    // Método para actualizar un registro de Formación Contratación Pública
    public function update_formacion_cp($id_form, $data)
    {
        $this->db->where('id_form', $id_form);
        $query = $this->db->update('certificacion.for_mat_contr_publ', $data);

        if ($query) {
            return 1; // Éxito
        } else {
            log_message('error', 'Error updating certificacion.for_mat_contr_publ for id_form ' . $id_form . ': ' . $this->db->error()['message']);
            return 0; // Error
        }
    }
    function get_exp_comis_by_id($id_exp_10)
    {
        $this->db->select('organo10, act_adminis_desid, n_acto, fecha_act, area_10, dura_comi, nro_comprobante, cedula, id_exp_10');
        $this->db->from('certificacion.exp_par_comi_10');
        $this->db->where('id_exp_10', $id_exp_10); // Filtra por el ID específico del registro
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una sola fila
    }

    // Método para actualizar un registro de Experiencia en Comisiones
    public function update_exp_comis($id_exp_10, $data)
    {
        $this->db->where('id_exp_10', $id_exp_10);
        $query = $this->db->update('certificacion.exp_par_comi_10', $data);

        if ($query) {
            return 1; // Éxito
        } else {
            log_message('error', 'Error updating certificacion.exp_par_comi_10l for id_exp_10 ' . $id_exp_10 . ': ' . $this->db->error()['message']);
            return 0; // Error
        }
    }
    function get_dictado_cap_by_id($id_dic_cap_3)
    {
        $this->db->select('id, rif_cont, n_certif, organo3, actividad3, desde3, hasta3, cedula, id_dic_cap_3');
        $this->db->from('certificacion.exp_dic_cap_3');
        $this->db->where('id_dic_cap_3', $id_dic_cap_3); // Filtra por el ID específico del registro
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una sola fila
    }

    // Método para actualizar un registro de Dictado de Capacitación
    public function update_dictado_cap($id_dic_cap_3, $data)
    {
        $this->db->where('id_dic_cap_3', $id_dic_cap_3);
        $query = $this->db->update('certificacion.exp_dic_cap_3', $data);

        if ($query) {
            return 1; // Éxito
        } else {
            log_message('error', 'Error updating certificacion.exp_dic_cap_3 for id_dic_cap_3 ' . $id_dic_cap_3 . ': ' . $this->db->error()['message']);
            return 0; // Error
        }
    }

    public function get_certificacion_info($id_certificacion)
    {
        $this->db->select('id, nro_comprobante, nombre, rif_cont, fecha_solic, objetivo, cont_prog,status, vigen_cert_desde, vigen_cert_hasta,qrcode_path, qrcode_data');
        $this->db->from('certificacion.certificaciones');
        $this->db->where('id', $id_certificacion);
        $query = $this->db->get();
        return $query->row_array(); // Retorna una sola fila
    }

    // 2. Obtener experiencia de la empresa en capacitación
    public function get_experiencia_empresa($id_certificacion)
    {
        // Asumo que 'experi_empre_cap_comisi' se relaciona con 'certificaciones' por 'id'
        // Si se relaciona por 'rif_cont' o 'nro_comprobante', ajusta el where
        $this->db->select('id, nro_comprobante, rif_cont, n_certif, organo_expe, actividad_exp, desde_exp, hasta_exp');
        $this->db->from('certificacion.experi_empre_cap_comisi');
        $this->db->where('id', $id_certificacion); // ASUNCIÓN: 'id' de certificaciones
        $query = $this->db->get();
        return $query->result_array(); // Retorna múltiples filas
    }
    // 2. Obtener experiencia de la empresa en capacitación
    public function get_experiencia_empresa10($id_certificacion)
    {
        // Asumo que 'experi_empre_cap_comisi' se relaciona con 'certificaciones' por 'id'
        // Si se relaciona por 'rif_cont' o 'nro_comprobante', ajusta el where
        $this->db->select('id, nro_comprobante, rif_cont, n_certif, organo_experi_empre_capa, actividad_experi_empre_capa, desde_experi_empre_capa, hasta_experi_empre_capa');
        $this->db->from('certificacion.experi_empre_capa');
        $this->db->where('id', $id_certificacion); // ASUNCIÓN: 'id' de certificaciones
        $query = $this->db->get();
        return $query->result_array(); // Retorna múltiples filas
    }

    // 3. Obtener facilitadores asociados por rif_cont (ASUNCIÓN para el ejemplo)
    public function get_facilitadores_by_rif_cont($id_certificacion)
    {
        $this->db->select('id, nombre_ape, cedula, rif'); // Selecciona las columnas básicas del facilitador
        $this->db->from('certificacion.infor_per_natu');
        $this->db->where('id', $id_certificacion); // Asumo que rif_cont es el campo de unión
        $query = $this->db->get();
        return $query->result_array();
    }
    public function check_miemb_inf_exp_comis($cedula)
    {
        $this->db->select('id, rif_cont, n_certif, organo10, act_adminis_desid, n_acto, fecha_act, area_10, dura_comi, nro_comprobante, cedula, id_exp_10');
        $this->db->from('certificacion.exp_par_comi_10');
        $this->db->where('cedula', $cedula);
        $query = $this->db->get();
        return $query->result_array();
    }

    // 7. Obtener Dictado de Capacitación de un Facilitador (NUEVA si no la tienes, o ajusta una existente)
    public function check_miemb_inf_cap_dictado($cedula)
    {
        $this->db->select('id, rif_cont, n_certif, organo3, actividad3, desde3, hasta3, cedula, id_dic_cap_3');
        $this->db->from('certificacion.exp_dic_cap_3');
        $this->db->where('cedula', $cedula);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_facilitadores_by_cert_id($id_certificacion)
    {
        // Paso 1: Obtener el rif_cont de la certificación principal de la tabla 'certificaciones'
        // Asegúrate de que 'get_certificacion_info' selecciona 'rif_cont'
        $certificacion_principal = $this->get_certificacion_info($id_certificacion);


        $this->db->select('id, nombre_ape, cedula'); // <-- SELECCIONAR SOLO LAS COLUMNAS NECESARIAS
        $this->db->from('certificacion.infor_per_natu');
        $this->db->where('id', $id_certificacion); // Filtrar por el rif_cont de la certificación
        $query = $this->db->get();


        return $query->result_array(); // Devolver un array de objetos (facilitadores)
    }


    //qr
    public function save_certificacion3(
        $certifi,
        $experi_empre_capa_data,
        $experi_empre_cap_comisi_data,
        $verification_url_base // Nuevo parámetro: la URL base para el verificador del QR
    ) {
        // Generar un ID secuencial para id_comprobante si es necesario
        $this->db->select('MAX(e.id_comprobante) as id_comprobante');
        $this->db->where('e.tipo_pers', 1); // Asumo que 1 es para persona jurídica
        $this->db->group_by('e.tipo_pers');
        $query_comprobante = $this->db->get('certificacion.certificaciones e');
        $respon_comprobante = $query_comprobante->row_array();
        $id_comprobante = ($respon_comprobante && $respon_comprobante['id_comprobante']) ? $respon_comprobante['id_comprobante'] + 1 : 1;

        // Obtener el siguiente 'id' principal para la tabla certificacion.certificaciones
        // Esto es si 'id' no es AUTO_INCREMENT y se gestiona manualmente
        $this->db->select('MAX(e.id) as id');
        $query_id = $this->db->get('certificacion.certificaciones e');
        $response_id = $query_id->row_array();
        $cert_id = ($response_id && $response_id['id']) ? $response_id['id'] + 1 : 1; // ID de la certificación actual

        // Preparamos los datos principales de la certificación para la inserción inicial
        // (Sin la ruta y datos del QR todavía, ya que necesitan el ID insertado)
        $certifi1 = array(
            'id'              => $cert_id, // Usar el ID calculado para la certificación principal
            'id_comprobante'  => $id_comprobante,
            'nro_comprobante' => $certifi['nro_comprobante'],
            'n_certif'        => $certifi['n_certif'],
            'rif_cont'        => $certifi['rif_cont'],
            'nombre'          => $certifi['nombre'],
            'tipo_pers'       => $certifi['tipo_pers'],
            'objetivo'        => $certifi['objetivo'],
            'cont_prog'       => $certifi['cont_prog'],
            'total_bss'       => $certifi['total_bss'],
            'n_ref'           => $certifi['n_ref'],
            'banco_e'         => $certifi['banco_e'],
            'banco_rec'       => $certifi['banco_rec'],
            'fecha_trans'     => $certifi['fecha_trans'],
            'monto_trans'     => $certifi['monto_trans'],
            'declara'         => $certifi['declara'],
            'acepto'          => $certifi['acepto'],
            'fecha_solic'     => $certifi['fecha_solic'],
            'user_soli'       => $certifi['user_soli'],
            'status'          => $certifi['status']
        );

        // Insertar los datos principales de la certificación
        $quers = $this->db->insert('certificacion.certificaciones', $certifi1);

        // Si la certificación principal se insertó correctamente
        if ($quers) {
            $inserted_cert_db_id = $cert_id; // Este es el ID de la certificación recién insertada

            // --- Generar la URL de verificación del QR y el QR ---
            // La URL completa que será codificada en el QR
            $qrcode_data_to_encode = $verification_url_base . $inserted_cert_db_id; // Ejemplo: http://domain.com/verificador/certificado?id=123

            // Generar la imagen del QR y obtener su ruta relativa
            // Pasa la URL a codificar y el nombre de la empresa/RIF para el nombre del archivo QR
            $qrcode_path = $this->_generate_qrcode3(
                $qrcode_data_to_encode,
                $certifi['rif_cont'] // Usar RIF para el nombre del archivo QR
            );

            // Actualizar la entrada de la certificación con la ruta y los datos del QR
            $update_qr_data = array(
                'qrcode_path' => $qrcode_path,
                'qrcode_data' => $qrcode_data_to_encode // Guardar la URL completa en la BD
            );
            $this->db->where('id', $inserted_cert_db_id);
            $this->db->update('certificacion.certificaciones', $update_qr_data);

            // --- Insertar datos de Experiencia de la Empresa en Capacitación (experi_empre_capa) ---
            // Asumo que 'organo_experi_empre_capa' es un array de datos
            if (!empty($experi_empre_capa_data['organo_experi_empre_capa']) && is_array($experi_empre_capa_data['organo_experi_empre_capa'])) {
                $count_prog = count($experi_empre_capa_data['organo_experi_empre_capa']);
                for ($i = 0; $i < $count_prog; $i++) {
                    // Generar ID para experi_empre_capa si es necesario y no es AUTO_INCREMENT
                    $this->db->select('MAX(id) as max_id');
                    $query_exp_id = $this->db->get('certificacion.experi_empre_capa');
                    $result_exp_id = $query_exp_id->row_array();
                    $next_exp_id = ($result_exp_id['max_id'] ?? 0) + 1;

                    $data1 = array(
                        // 'id_exp_empresa'              => $cert_id, // Usar el ID calculado
                        'id'                          => $cert_id, // FK a certificaciones
                        'organo_experi_empre_capa'    => $experi_empre_capa_data['organo_experi_empre_capa'][$i],
                        'actividad_experi_empre_capa' => $experi_empre_capa_data['actividad_experi_empre_capa'][$i],
                        'desde_experi_empre_capa'     => $experi_empre_capa_data['desde_experi_empre_capa'][$i],
                        'hasta_experi_empre_capa'     => $experi_empre_capa_data['hasta_experi_empre_capa'][$i],
                        'n_certif'                    => $certifi['n_certif'], // De la data principal
                        'rif_cont'                    => $certifi['rif_cont'], // De la data principal
                        'nro_comprobante'             => $certifi['nro_comprobante'] // De la data principal
                    );
                    $this->db->insert('certificacion.experi_empre_capa', $data1);
                }
            }

            // --- Insertar datos de Experiencia en Capacitación en Comisiones (experi_empre_cap_comisi) ---
            // Asumo que 'organo_expe' es un array de datos
            if (!empty($experi_empre_cap_comisi_data['organo_expe']) && is_array($experi_empre_cap_comisi_data['organo_expe'])) {
                $count_pff = count($experi_empre_cap_comisi_data['organo_expe']);
                for ($i = 0; $i < $count_pff; $i++) {
                    // Generar ID para experi_empre_cap_comisi si es necesario y no es AUTO_INCREMENT
                    $this->db->select('MAX(id) as max_id');
                    $query_comisi_id = $this->db->get('certificacion.experi_empre_cap_comisi');
                    $result_comisi_id = $query_comisi_id->row_array();
                    $next_comisi_id = ($result_comisi_id['max_id'] ?? 0) + 1;

                    $data2 = array(
                        // // 'id_exp_comisi'   => $cert_id, // Usar el ID calculado
                        'id'              => $cert_id, // FK a certificaciones
                        'nro_comprobante' => $certifi['nro_comprobante'], // De la data principal
                        'n_certif'        => $certifi['n_certif'], // De la data principal
                        'rif_cont'        => $certifi['rif_cont'], // De la data principal
                        'organo_expe'     => $experi_empre_cap_comisi_data['organo_expe'][$i],
                        'actividad_exp'   => $experi_empre_cap_comisi_data['actividad_exp'][$i],
                        'desde_exp'       => $experi_empre_cap_comisi_data['desde_exp'][$i],
                        'hasta_exp'       => $experi_empre_cap_comisi_data['hasta_exp'][$i],
                    );
                    $this->db->insert('certificacion.experi_empre_cap_comisi', $data2);
                }
            }

            return true;; // Retornar el ID de la certificación principal insertada
        }
        return false;
    }

    // Asegúrate de que la función _generate_qrcode está definida en este mismo modelo
    public function _generate_qrcode3($cert_verification_url, $fullname_or_rif)
    {
        $this->load->library('ciqrcode');

        $directory = "./assets/img/qrcode"; // Ruta absoluta

        // Usar fullname_or_rif para el nombre del archivo QR
        $file_name = str_replace(" ", "", strtolower($fullname_or_rif)) . '_' . rand(pow(10, 2), pow(10, 3) - 1);

        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, TRUE)) {
                log_message('error', 'Error al crear directorio QR: ' . $directory);
                error_log('FALLO CRITICO: No se pudo crear el directorio QR: ' . $directory); // Añadir esto
                return null;
            }
        }

        $config['cacheable']    = true;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(0, 0, 0); // Color de los módulos (negro)
        $config['white']        = array(255, 255, 255); // Color de fondo (blanco)
        $this->ciqrcode->initialize($config);

        $image_name = $file_name . '.png';
        $params['data'] = $cert_verification_url; // La URL a codificar
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $directory . '/' . $image_name;

        log_message('debug', 'Intentando generar QR: ' . $params['savename'] . ' con data: ' . $params['data']);

        $this->ciqrcode->generate($params);

        if (file_exists($params['savename'])) {
            log_message('debug', 'QR generado exitosamente: ' . $params['savename']);
            return "assets/img/qrcode/" . $image_name;
        } else {
            log_message('error', 'Fallo al generar QR: El archivo no se encontró después de la generación en ' . $params['savename']);
            error_log('FALLO CRITICO: QR no se generó o no se encontró en: ' . $params['savename']); // Añadir esto
            return null;
        }
    }
}
