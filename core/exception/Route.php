<?php 
namespace Core\Exception
{
	use \Core\Helper\Router;

	class Route extends \Exception
	{
		public function notFound()
		{
			Router::redirect('/notFound.html');
		}
	}
}
?>
