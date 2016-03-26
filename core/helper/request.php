<?php 
namespace Core\Helper
{
	Class Request {

		public static function get($items = [])
		{
			$gets = new \stdClass();
			foreach ($items as $item) {
				$gets->{$item} = $_GET[$item];
			}
			return $gets;
		}

		public static function post($items = [])
		{
			$posts = new \stdClass();
			foreach ($items as $item) {
				$posts->{$item} = $_POST[$item];
			}
			return $posts;
		}

		public static function file($items = [])
		{
			$files = new \stdClass();
			foreach ($items as $item) {
				$files->{$item} = new \stdClass();
				foreach ($_FILES[$item] as $attr => $value) {
					$files->{$item}->{$attr} = $value;
				}
			}
			return $files;
		}
	}
}
?>