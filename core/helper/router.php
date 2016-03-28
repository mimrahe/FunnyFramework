<?php 
namespace Core\Helper
{
	use \Core\Helper\Request;

	class Router
	{		
		const DEFINED = 'app/routes/routes.php';
		private static $routes = [];

		private static function routes()
		{
			self::$routes = require_once self::DEFINED;
		}

		public static function to($url)
		{
			self::routes();

			$request_method = strtolower(Request::server(['request_method']) );
			// find = route_name or false
			$find = self::find($url, $request_method);

			if($find){
				die(var_dump($find));
				$controller = $find->controller;
				$controller = "App\\Controller\\{$controller}";
				$controller = new $controller;

				call_user_func_array([$controller, $find->action], $find->params);
				exit;
			}
			// if not found redirect to not found page
		}

		private static function find($url, $request_method)
		{
			foreach (self::$routes[$request_method] as $path => $props) {
				$pattern = '%^' . $path . '$%';

				if(preg_match_all($pattern , $url, $matches, PREG_SET_ORDER)){

					$route = (object)$props;

					$matches = $matches[0];
					unset($matches[0]);

					$route->params = $matches;

					return $route;
				}
			}

			return false;
		}
	}//class
}//namespace
 ?>