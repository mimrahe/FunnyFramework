<?php 
namespace Core\Helper
{
	Class Request {

		public static function get(array $items, array $default = [])
		{
			$gets = new \stdClass();
			foreach ($items as $item) {
				if ($_GET[$item] or $default[$item])
					$gets->{$item} = $_GET[$item] ?: $default[$item];
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

		public static function post(array $items, array $default = [])
		{
			$posts = new \stdClass();
			foreach ($items as $item) {
				if ($_POST[$item] or $default[$item])
					$posts->{$item} = $_POST[$item] ?: $default[$item];
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
				if ($_FILES[$item]) {
					$files->{$item} = new \stdClass();
					foreach ($_FILES[$item] as $attr => $value) {
						$files->{$item}->{$attr} = $value;
					}
				}
			}
			return $files;
		}
	}
}
?>