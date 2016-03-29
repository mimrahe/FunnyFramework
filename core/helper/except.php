<?php
namespace Core\Helper
{
	use \Core\Helper\Config;

	class Except
	{
		private static function init()
		{
			return new Config('exceptions');
		}

		public static function make($exception_group, $exception_type, $params = [])
		{
			$exceptions = self::init();
			$class = new $exceptions->{$exception_group}->class;
			$method = $exceptions->{$exception_group}->types->{$exception_type};

			call_user_func_array([$class, $method], $params);
		}
	}
}
?>