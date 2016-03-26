<?php 
namespace Core
{
	use \Core\Helper\Database as Database;
	use \Core\Helper\Date as Date;
	class Model
	{
		//class model
		//properties

		//methods
		public function init($type = 'mysql')
		{
			if($type == 'mysql'){
				Database::init();
			}
		}

		public function format_date($timestamp)
		{
			$format = '.    j F Y در g:i a';
			return Date::jdate( $format , $timestamp );
		}
	}//class
}//namespace
 ?>