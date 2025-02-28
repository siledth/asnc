<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_admin')) {
    function check_admin() {
        $CI =& get_instance();
        if (!$CI->session->userdata('logged_in')) {
            redirect('login');
        }
        
        if ($CI->session->userdata('perfil_id') != 1) {
            show_error('No tiene permisos para acceder a esta página', 403, 'Acceso Denegado');
        }
    }
}