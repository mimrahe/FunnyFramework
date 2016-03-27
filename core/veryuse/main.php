<?php 
namespace Core\VeryUse
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
	}
}
?>