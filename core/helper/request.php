<?php 
namespace Core\Helper
{
	Class Request {

		public static function get($items = [])
		{
			$gets = new \stdClass();
			foreach ($items as $item) {
				$gets->{$item} = $_GET[$item] ?: false;
			}
			return $gets;
		}

		public static function getHas($items = [])
		{
			$has = new \stdClass();
			foreach ($items as $item) {
				$has->{$item} = isset($_GET[$item]);
			}
			return $has;
		}

		public static function post($items = [])
		{
			$posts = new \stdClass();
			foreach ($items as $item) {
				$posts->{$item} = $_POST[$item] ?: false;
			}
			return $posts;
		}

		public static function postHas($items = [])
		{
			$has = new \stdClass();
			foreach ($items as $item) {
				$has->{$item} = isset($_POST[$item]);
			}
			return $has;
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