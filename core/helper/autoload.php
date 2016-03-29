<?php 
namespace Core\Helper
{
	class Autoload
	{
		//helper autoload
		//methods
		public static function init()
		{
			spl_autoload_register('self::loadClass');
		}//function

		private static function loadClass($file)
		{
			//echo $file . '<br>';
			//determine if file is twig's
			if(preg_match('/Twig/', $file))
			{
				return ;
			}
			//turn ABC to abc
			$file = strtolower($file);

			//replace \ with /
			$pattern = '/\\\/';
			$replacement = '/';
			$file = preg_replace($pattern, $replacement, $file);
			//include file
			require_once '../' . $file.'.php';
		}//function
	}//class
}//namespace

 ?>