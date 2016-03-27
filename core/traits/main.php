<?php 
namespace Core\Traits
{
	Trait Main
	{
		public function arrayToObject($array) {
			$object = new \stdClass();
			foreach ($array as $key => $value) {
				if (is_array($value)) {
					$value = $this->arrayToObject($value);
				}
				$object->$key = $value;
			}
			return $object;
		}

		public function default($item, $default, $check_empty = true)
		{
			// item exists
			if(isset($item)){
				// check empty
				if($check_empty){
					// item is empty
					if(empty($item)){
						return $default;
					}
					// item is not empty
					return $item;
				}
				// item is empty
				return $item;
			}
			// item not exists
			return $default;
		}
	}
}
?>