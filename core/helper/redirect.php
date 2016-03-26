<?php 
namespace Core\Helper
{
	use \Core\Helper\Config as Config;

	class Redirect
	{
		//helper redirect
		//properties

		//methods
		public static function to($where)
		{
			$host = Config::get('website.host');
			header("Location: {$host}{$where}", true);
			exit();
		}
	}//class
}//namespace
 ?>