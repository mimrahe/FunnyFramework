<?php 
namespace {
	//use
	use App\Controller as Controller;
	use Core\Helper\Config as Config;
	use Core\Helper\Autoload as Autoload;
	use Core\Helper\Router as Router;

	//autoload
	require_once 'core/helper/autoload.php';
	Autoload::init();

	//set default timezone
	$timezone = Config::get('website.timezone');
	date_default_timezone_set($timezone);

	//get url
	$url = ( !empty( $_GET['url'] ) ) ? $_GET['url'] : '' ;
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
