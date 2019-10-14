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
#users
$route['users/login'] = 'users/users/users_login';
$route['users/sign_up'] = 'users/users/users_sign_up';
$route['users/sign_up'] = 'users/users/users_sign_up_form';
$route['users/login'] = 'users/users/users_login_form';
$route['users/(:any)'] = 'users/users/index/$1';
$route['users/search_quote'] = 'users/users/execute_search';
$route['users'] = 'users/users';

#quotes routes
$route['quotes/get_quotes_by_category'] = 'quotes/quotes/get_quotes_by_category';
$route['quotes/search_quote'] = 'quotes/quotes/execute_search';
$route['quotes/delete_quote/(:any)'] = 'quotes/quotes/delete_quote/$1';
$route['quotes/save_quote'] = 'quotes/quotes/save_quote';
$route['quotes/add_quote'] = 'quotes/quotes/add_quote';
$route['quotes/view_quote'] = 'quotes/quotes/view_quote';
$route['quotes/create_quote'] = 'quotes/quotes/create_quote';

#category routes
$route['categories/view_quotes_by_category/(:any)'] = 'categories/categories/view_quotes_by_category/$1';
$route['categories/edit_category/(:any)'] = 'categories/categories/edit_category/$1';
$route['categories/update_category/(:any)'] = 'categories/categories/update_category/$1';
$route['categories/delete_category/(:any)'] = 'categories/categories/delete_category/$1';
$route['categories/create_category'] = 'categories/categories/create_category';
$route['categories/add_category'] = 'categories/categories/add_category';
$route['categories/view_category/(:any)'] = 'categories/categories/view_category/$1';
$route['categories/view_category'] = 'categories/categories/view_category';


#admin routes
$route['admin/(:any)'] = 'admin/home/index/$1';
$route['admin/logout'] = 'admin/home/admin_logout';
$route['admin/sign_up'] = 'admin/home/admin_sign_up_form';
$route['admin/login'] = 'admin/home/admin_login_form';
$route['admin'] = 'admin/home';

#quotes routes
$route['quotes'] = 'quotes/home';

$route['default_controller'] = 'quotes/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
