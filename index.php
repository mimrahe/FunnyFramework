<?php 
// echo '<pre>';
// print_r($_GET);
// print_r($_POST);
// echo '</pre>';
namespace {
	//use
	use App\Controller;
	use Core\Helper\Config;
	use Core\Helper\Autoload;
	use Core\Helper\Router;
	use Core\Helper\Request;

	//autoload
	require_once 'core/helper/autoload.php';
	Autoload::init();

	//set default timezone
	$timezone = Config::get('website.timezone');
	date_default_timezone_set($timezone);

	//get url
	$url = Request::get(['url'])->url;
	//route the url
	$route = Router::route($url);
	//set controller
     $controller = ucfirst( $route['controller'] );
     $controller = "App\\Controller\\{$controller}";
	//instance of controller
	   $controller = new $controller;
	//set action
	$action = $route['action'];
	//set parameters
	$parameters = $route['parameters'];
	//call controller , action and give url params
     call_user_func_array( array( $controller , "{$action}" ) , array('params' => $parameters ) );
}

?>
