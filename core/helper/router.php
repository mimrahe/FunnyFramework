<?php 
namespace Core\Helper
{
	use \Core\Helper\Config as Config;
	class Router
	{
		//helper router
		//properties
		private static $default_controller = '';
		private static $routes = array();
		private static $url_prefix = '/home/mohsen/public_html/weblog/';

		//methods
		public static function route($url = '')
		{
			//method route
			//detect if request url is a file
			/*$pattern = '/\\.[\w]+$/';
			$subject = $url;
			preg_match($pattern, $subject, $result);

			if(!empty($result)){
				ob_start();
				  include self::$url_prefix . $url;
				  $file = ob_get_contents();
				ob_end_clean();
				echo $file;
				return ;
			}// */ // this part of code removed after setting absolute path for web page urls
			//get route config from file
			$website_dir = Config::get('website.dir');
			$config_file_path = $website_dir . 'app/config/router.config.php';
			require_once $config_file_path;
			//detect what controller and action can be called
			$url = self::explode_url($url);
			$url_count = count($url );

			//set controller
			if(!empty($url[0]) and array_key_exists($url[0] , self::$routes) ){
				$controller = $url[0];
				//set action
				if( !empty($url[1]) and in_array($url[1] , self::$routes[$controller]) ){
					$action = $url[1];
					$parameters_flag = 2;
				}else{
					$action = 'default_action';
					$parameters_flag = 1;
				}//if-else
			}else{
				$controller = self::$default_controller;
				//set action
				if(!empty($url[0])  and  in_array($url[0] , self::$routes[$controller]) ){
					$action = $url[0];
					$parameters_flag = 1;
				}else{
					$action = 'default_action';
					$parameters_flag = 0;
				}//if-else
			}//if-else

			//detect parameters
			$parameters = array();
			for($i = $parameters_flag ; $i <= $url_count-1 ; $i++ ){
				//set parameters
				$param = explode( '-' , $url[ $i ] );
				$parameters[ $param[0] ] = ( !empty($param[1]) ) ? $param[1] : 0;
			}
			//return array of controller and action and its parameters
			return array(
				'controller' => $controller,
				'action' => $action,
				'parameters' => $parameters
				);

		}//function

		private static function explode_url($url)
		{
			//explode url
			if(!empty($url) )
			{
				return explode('/', $url);
			}

			return array();
		}
	}//class
}//namespace
 ?>