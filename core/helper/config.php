<?php 
namespace Core\Helper
{
	class Config
	{
		//helper config
		//properties
		private static $settings = array();
		const config_file = 'app/config/config.ini';

		//methods
		private function __construct()
		{
			//no access through instance
		}//function
		private function __clone()
		{
			//can not be coppied
		}//function

		private static function _init()
		{
			ob_start();
			  include self::config_file;
			  $contents = ob_get_contents();
			ob_end_clean();

			self::$settings = parse_ini_string($contents);
		}//function

		public static function get($what)
		{
			if(empty(self::$settings)){
				self::_init();
				//echo __line__;
			}

			if(array_key_exists($what, self::$settings) ){
				return self::$settings[$what];
			}

			return false;
		}//function
	}//class
}//namespace
 ?>