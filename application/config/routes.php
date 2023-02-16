<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// to set default controller
// $this->set_directory("Backend");
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/C_Login';
$route['logout'] = 'Auth/C_Login/logout';
$route['auth/login/(:any)'] = 'Auth/C_Login/$1';

$route['register'] = 'Auth/C_Register';
$route['register/proses_daftar'] = 'Auth/C_Register/proses_register';
$route['register/unduh/biodata']['GET'] = 'Auth/C_Register/unduh/biodata';

$route['landing'] = 'Frontend/C_Landing';

$route['backend/home'] = 'Backend/C_Home';
$route['backend/home/(:any)'] = 'Backend/C_Home/$1';

// $this->set_directory("");
$route['backend/profile'] = 'Backend/C_Profile/index';
$route['backend/profile/(:any)'] = 'Backend/C_Profile/$1';

// Master Data

// Berkas
$route['backend/berkas'] = 'Backend/C_Berkas';
$route['backend/berkas/form'] = 'Backend/C_Berkas/index_frm_cmhs';
$route['backend/berkas/(:any)'] = 'Backend/C_Berkas/$1';
$route['backend/berkas/unduh/(:num)']['GET'] = 'Backend/C_Berkas/berkas_unduh/$1';

//Laporan
$route['backend/laporan'] = 'Backend/C_Laporan';
$route['backend/laporan/form'] = 'Backend/C_Laporan/index_frm_cmhs';
$route['backend/laporan/(:any)'] = 'Backend/C_Laporan/$1';
$route['backend/laporan/unduh/(:num)']['GET'] = 'Backend/C_laporan/laporan_unduh/$1';


//Monitoring
$route['backend/monitoring'] = 'Backend/C_Monitoring';
$route['backend/monitoring/form'] = 'Backend/C_Monitoring/index_frm_cmhs';
$route['backend/monitoring/(:any)'] = 'Backend/C_Monitoring/$1';
$route['backend/monitoring/unduh/(:num)']['GET'] = 'Backend/C_Monitoring/monitoring_unduh/$1';


// Web Management
$route['backend/web_manage'] = 'Backend/C_Web_Manage';
$route['backend/web_manage/(:any)'] = 'Backend/C_Web_Manage/$1';
