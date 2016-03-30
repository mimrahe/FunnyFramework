<?php 
namespace Core\Helper
{
	class Request {

		public static function get(array $items, array $default = [])
		{
			$gets = new \stdClass();
			foreach ($items as $item) {
				if(isset($_GET[$item])){
					$gets->{$item} = $_GET[$item];
					continue;
				}
				if(isset($default[$item])){
					$gets->{$item} = $default[$item];
					continue;
				}
				$gets->{$item} = null;
			}
			if(count($items) == 1)
				return $gets->{$items[0]};
			
			return $gets;
		}

		public static function getHas(array $items)
		{
			$has = new \stdClass();
			foreach ($items as $item) {
				$has->{$item} = isset($_GET[$item]);
			}
			if(count($items) == 1)
				return $has->{$items[0]};

			return $has;
		}

		public static function post(array $items, array $default = [])
		{
			$posts = new \stdClass();
			foreach ($items as $item) {
				if(isset($_POST[$item])){
					$posts->{$item} = $_POST[$item];
					continue;
				}
				if(isset($default[$item])){
					$posts->{$item} = $default[$item];
					continue;
				}
				$posts->{$item} = null;
			}
			if(count($items) == 1)
				return $posts->{$items[0]};
			return $posts;
		}

		public static function postHas(array $items)
		{
			$has = new \stdClass();

			foreach ($items as $item) {
				$has->{$item} = isset($_POST[$item]);
			}

			if(count($items) == 1)
				return $has->{$items[0]};

			return $has;
		}

		public static function file(array $items)
		{
			$files = new \stdClass();

			foreach ($items as $item) {
				if (isset($_FILES[$item]) ) {
					$files->{$item} = new \stdClass();
					foreach ($_FILES[$item] as $attr => $value) {
						$files->{$item}->{$attr} = $value;
					}
				}
			}
			if(count($items) == 1)
				return $files->{$items[0]};

			return $files;
		}

		public static function server(array $items)
		{
			/*
			$obj->request_method = $_SERVER['REQUEST_METHOD']
			*/
			$servers = new \stdClass();
		
			foreach ($items as $item) {
				$search = strtoupper($item);
				if(isset($_SERVER[$search])){
					$servers->{$item} = $_SERVER[$search];
				}
			}
			if(count($items) == 1)
				return $servers->{$items[0]};

			return $servers;
		}
	}//class
}//ns
?>