<?php
function is_user_logged_in($user_id) {
    $ci =& get_instance();
    $ci->load->database();
  
    $query = $ci->db->get_where('user_sessions', array(
      'user_id' => $user_id,
      'login_time >' => date('Y-m-d H:i:s', strtotime('-10 minutes'))
    ));
  
    return $query->num_rows() > 0;
  }
function set_user_session($user_data) {
    $CI =& get_instance();
    $CI->load->library('session');

    $user_data['logged_in'] = TRUE;
    $CI->session->set_userdata($user_data);
}

function get_user_session() {
    $CI =& get_instance();
    $CI->load->library('session');

    return $CI->session->userdata();
}

function unset_user_session() {
    $CI =& get_instance();
    $CI->load->library('session');

    $CI->session->sess_destroy();
}

// function is_user_logged_in() {
//     $CI =& get_instance();
//     $CI->load->library('session');

//     return $CI->session->userdata('logged_in');
// }