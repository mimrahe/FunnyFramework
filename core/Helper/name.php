<?php 
namespace Core\Helper
{
	class Name
	{
		//helper name
		//properties

		//methods
		public static function name_to_timestamp($name)
		{
			//change name into timestamp
			//name is in base hex
			//timestamp go to base dex
			$timestamp = hexdec($name);
			return $timestamp;
		}//function

		public static function timestamp_to_name($timestamp)
		{
			//change timestamp into name
			//timestamp is in base dec
			//name is in base hex
			$name = dechex($timestamp);
			return $name;
		}//function
	}//class
}//namespace
 ?>