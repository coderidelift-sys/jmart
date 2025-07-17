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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['login_kasir'] = 'login/login_kasir';

$route['profile'] = 'akun/profile';
$route['sandi'] = 'akun/sandi';
$route['testing'] = 'login/testing';

$route['alamat'] = 'home/alamat';
$route['report'] = 'home/report';

$route['pesanan_user'] = 'pesanan/user';

$route['create_invoice'] = 'pesanan/create_invoice';
$route['verifikasi/(:any)'] = 'register/verifikasi/$1';

$route['product/pemesanan/add'] = 'product/tambah_pemesanan';
$route['product/pemesanan/ubah/(:num)'] = 'product/edit_pemesanan/$1';
$route['product/pemesanan/lihat/(:num)'] = 'product/lihat_pemesanan/$1';
$route['product/pemesanan/cetak/(:num)'] = 'product/cetak_pemesanan/$1';

$route['pesanan/autodebit'] = 'autodebit/index';
$route['pesanan/autodebit/lunas'] = 'autodebit/lunas';

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['keranjang/add_keranjang'] = 'keranjang/add';

$route['product/opname/tambah'] = 'product/tambah_opname';
$route['product/opname/delete/(:num)'] = 'product/delete_opname/$1';
$route['product/opname/json'] = 'product/json_opname';
$route['product/opname/input_fisik'] = 'product/input_fisik';
$route['product/opname/simpan_fisik/(:num)'] = 'product/simpan_fisik/$1';
$route['product/opname/json_temp_fisik'] = 'product/json_temp_fisik';
$route['product/opname/update_temp_fisik'] = 'product/update_temp_fisik';
$route['product/opname/delete_temp_fisik/(:num)'] = 'product/delete_temp_fisik/$1';

$route['product/opname/json_temp_rusak'] = 'product/json_temp_rusak';
$route['product/opname/input_rusak'] = 'product/input_rusak';
$route['product/opname/simpan_spoil/(:num)'] = 'product/simpan_spoil/$1';
$route['product/opname/update_temp_rusak'] = 'product/update_temp_rusak';
$route['product/opname/delete_temp_spoil/(:num)'] = 'product/delete_temp_spoil/$1';

$route['product/opname/simpan'] = 'product/simpan_opname';
$route['product/opname/detail/(:num)'] = 'product/detail_opname/$1';
$route['product/opname/ubah/(:num)'] = 'product/ubah_opname/$1';
