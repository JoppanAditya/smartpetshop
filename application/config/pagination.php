<?php
$config['base_url'] = 'https://localhost/petshop/shop';
$config['use_page_numbers'] = true;
$config['page_query_string'] = true;
$config['query_string_segment'] = 'page';
$config['reuse_query_string'] = true;

$config['full_tag_open'] = '<nav aria-label="Page navigation"> <ul class="pagination justify-content-center">';
$config['full_tag_close'] = '</ul> </nav>';

$config['first_link'] = '1';
$config['first_tag_open'] = '<li class="page-item me-sm-3">';
$config['first_tag_close'] = '</li>';

$config['last_tag_open'] = '<li class="page-item me-sm-3">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
$config['next_tag_open'] = '<li class="page-item me-sm-3">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
$config['prev_tag_open'] = '<li class="page-item me-sm-3">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item me-sm-3 active" aria-current="page"> <a class="page-link" href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item me-sm-3">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = array('class' => 'page-link');
