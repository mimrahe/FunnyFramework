<?php 
namespace Core\Helper
{
	use \Symfony\Component\ClassLoader\MapClassLoader;

	class Autoload
	{
		//helper autoload
		//methods
		public static function init()
		{
			require_once '../lib/symfony/class-loader/MapClassLoader.php';

			$mapping = require_once '../app/config/autoload.php';

			$loader = new MapClassLoader($mapping);

			$loader->register(true);
		}//function
	}//class
}//namespace

 ?>