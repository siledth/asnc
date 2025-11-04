<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RendicionExcepciones extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('session')) redirect('login');
        // Aquí podrías validar rol admin
        $this->load->model('Programacion_model');
    }

    // Vista: buscar por RIF, ver años y excepciones, crear/gestionar
    public function excepciones()
    {
        $rif = $this->input->get('rif');
        $data['rif'] = $rif ?: '';
        $data['anios'] = $rif ? $this->Programacion_model->anios_programados_por_rif($rif) : [];
        $data['excepciones'] = $rif ? $this->Programacion_model->listar_excepciones_por_rif($rif) : [];
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/rendicion_excepciones/execciones.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function crear()
    {
        $rif = $this->input->post('rif');
        $anio = $this->input->post('anio');
        $fi = $this->input->post('fecha_inicio'); // opcional
        $ff = $this->input->post('fecha_fin'); // opcional
        $mot = $this->input->post('motivo');
        $uid = $this->session->userdata('id_user');

        $ok = $this->Programacion_model->crear_excepcion_rendicion($rif, $anio, $fi, $ff, $mot, $uid);
        echo json_encode($ok ? 1 : 0);
    }

    public function deshabilitar()
    {
        $id = $this->input->post('id');
        $ok = $this->Programacion_model->deshabilitar_excepcion_rendicion($id);
        echo json_encode($ok ? 1 : 0);
    }
}
