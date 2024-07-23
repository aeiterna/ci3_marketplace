<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'customer';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin

$route['admin/category'] = 'admin/category/view';
$route['admin/category/(:any)/(:num)'] = 'admin/category/$1/$2';
$route['admin/category/(:any)'] = 'admin/category/$1';

$route['admin/product'] = 'admin/product/view';
$route['admin/product/(:any)/(:num)'] = 'admin/product/$1/$2';
$route['admin/product/(:any)'] = 'admin/product/$1';

$route['admin/customer'] = 'admin/customer/view';

$route['admin/laporan_profit'] = 'admin/profit/view';

$route['admin/order'] = 'admin/order/view';
$route['admin/order/details/(:num)'] = 'admin/order/details/$1';

$route['admin/logout'] = 'admin/logout';

// Customer

$route['customer'] = 'customer/index';
$route['customer/product_detail/(:num)'] = 'customer/product_detail/$1';
$route['customer/cart'] = 'customer/cart';
$route['customer/update_cart'] = 'customer/update_cart';
$route['customer/checkout'] = 'customer/checkout';
$route['customer/add_to_cart'] = 'customer/add_to_cart';
$route['customer/order_confirmation'] = 'customer/order_confirmation';
$route['customer/login'] = 'customer/login';
$route['customer/register'] = 'customer/register';
$route['customer/logout'] = 'customer/logout';
$route['customer/product'] = 'customer/product';

