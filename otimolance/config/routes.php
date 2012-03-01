<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "principal/home";
$route['404_override'] = '';
$route['area-restrita'] = 'login/login';

// rotas clientes
$route['clientes/login'] = 'login/login/autenticarClientes';
$route['clientes/sair'] =  'login/login/logoffClientes';
$route['clientes/autenticar'] =  'principal/redirecionaLoginClientes';
$route['minha-conta'] =  'principal/carregarConta';


$route['home'] =  'principal/home';
$route['leiloes/(:any)'] = "clance/detalheLeilao/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */