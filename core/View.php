<?php 
namespace Core{

	use Fenom;
	use Core\Helper\Config;

	class View{

		const TEMPLATES_DIR = '';
		const COMPILED_DIR = '';
		private static $init = false;
		private static $fenom = '';
		private static $info = [];
		private static $error = [];

		private static function init()
		{
			if (self::$init)
				return ;

			$config = new Config('fenom');
			self::TEMPLATES_DIR = $config->templates_dir;
			self::COMPILED_DIR = $config->compiled_dir;

			$options = [];

			self::$fenom = Fenom::factory(self::TEMPLATES_DIR, self::COMPILED_DIR, $options);
		}

		public static function info($message)
		{
			self::$info[] = $message;
		}

		public static function error($message)
		{
			self::$error[] = $message;
		}

		public static function display($tpl, $data)
		{
			self::init();
			self::$fenom->display($tpl, $data);
		}
	}//class
}//namespace
?>