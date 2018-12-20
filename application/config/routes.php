<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['admin/dashboard'] = 'admin/HalamanDashboard';

$route['logout'] = 'admin/logout';
$route['prosesLogin'] = 'admin/login';
$route['login'] = 'admin/HalamanLogin';
$route['default_controller'] = 'admin/HalamanLogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
