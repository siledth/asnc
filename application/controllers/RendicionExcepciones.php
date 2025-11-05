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

    public function excepciones()
    {
        $rif = trim((string)$this->input->get('rif'));

        $data = [
            'rif'          => $rif,
            'anios'        => [],
            'excepciones'  => [],
            'razon_social' => null,
        ];

        if ($rif !== '') {
            // Años y excepciones
            $data['anios']       = $this->Programacion_model->anios_programados_por_rif($rif);
            $data['excepciones'] = $this->Programacion_model->listar_excepciones_por_rif($rif);

            // 🔹 Razón social buscada directamente en public.organoente por RIF exacto
            $ente = $this->Programacion_model->descripcion_por_rif_exacta($rif);
            $data['razon_social'] = $ente['descripcion'] ?? null;
        }

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

    // Deshabilitar excepción  
    public function deshabilitar_tradicional()
    {
        // Carga la librería de sesión para usar flashdata (mensajes)
        $this->load->library('session');

        $id  = (int)$this->input->post('id');
        // Capturamos el RIF enviado para la redirección
        $rif_buscado = $this->input->post('rif_actual');

        if ($id > 0) {
            // Llama a la función del modelo corregida (que ya tienes)
            $res = $this->Programacion_model->deshabilitar_excepcion_rendicion($id);

            if ($res['ok']) {
                $this->session->set_flashdata('success', '✅ Excepción deshabilitada correctamente.');
            } else {
                // Si affected es 0 (ya estaba inactiva o error)
                $this->session->set_flashdata('error', '❌ No se pudo deshabilitar la excepción: ' . $res['msg']);
            }
        } else {
            $this->session->set_flashdata('error', '❌ ID de excepción inválido.');
        }

        // Redirige de vuelta a la vista de excepciones para ver el estado actualizado
        // Usamos el RIF guardado para mantener la vista del ente.
        redirect('RendicionExcepciones/excepciones?rif=' . urlencode($rif_buscado));
    }
}
