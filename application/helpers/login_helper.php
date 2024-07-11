<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect(base_url());
    }
}

function is_admin()
{
    $ci = get_instance();
    $level_id = $ci->session->userdata('level_id');

    if ($level_id == 2 || $level_id == 3) {
        redirect('auth/blocked');
    }
}

function is_employee()
{
    $ci = get_instance();
    $level_id = $ci->session->userdata('level_id');

    if ($level_id == 3) {
        redirect('auth/blocked');
    }
}

function check_access($level_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('level_id', $level_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    return $result->num_rows() > 0;
}
