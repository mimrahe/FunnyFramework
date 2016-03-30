<?php 
namespace Core\Helper
{
	use Core\Traits\Main;

	class Config
	{
		use Main;
		//helper config
		//properties
		private $settings;
		const CONFIG_DIR = '../app/config/';

		public function __construct($config_type)
		{
			$config = require_once self::CONFIG_DIR . $config_type . '.php';
			
			$this->settings = $this->arrayToObject($config);
		}

		public function __get($item)
		{
			return isset($this->settings->{$item}) ? $this->settings->{$item} : null;
		}
		
	}//class
}//namespace
 ?>