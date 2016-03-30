<?php 
namespace Core{

	use Core\Helper\Config;

	class View{

		private static $init = false;
		private static $twig = '';
		private static $info = [];
		private static $error = [];

		private static function init()
		{
			if (self::$init)
				return ;

			$config = new Config('templateEngine');

			$loader = new Twig_Loader_Filesystem($config->templates_dir);
			self::$twig = new Twig_Environment($loader, [
					'cache' => $config->compiled_dir
				]);
		}

		public static function info($message)
		{
			self::$info[] = $message;
		}

		public static function error($message)
		{
			self::$error[] = $message;
		}

		public static function display($tpl, $data = [])
		{
			self::init();
			$view_data = [
				'error' => self::$error,
				'info' => self::$info
			];
			$data = array_merge($data, $wiew_data);
			self::$twig->render($tpl, $data);
		}
	}//class
}//namespace
?>