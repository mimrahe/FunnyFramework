<?php 
namespace Core\Helper
{
	use Core\Helper\Config;

	class App
	{
		public static function init()
		{
			$init = new Config('init');
			date_default_timezone_set($init->timezone);
		}
	}
}
?>