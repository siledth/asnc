<?php

defined('BASEPATH') or exit('No direct script access allowed');
// application/controllers/Llamado_concurso.php
class Llamado_concurso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('llamado_concurso_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config = array();
        $config['base_url'] = base_url('llamado_concurso/index');
        $config['total_rows'] = $this->llamado_concurso_model->count_all($this->input->get('search'));
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['results'] = $this->llamado_concurso_model->get_records($config['per_page'], $page, $this->input->get('search'));
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('llamado_concurso_view', $data);
    }
}