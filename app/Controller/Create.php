<?php 
namespace App\Controller
{
	use \Core\View;

	class Create
	{
		public function getIndex()
		{
			View::info("hello");
			return View::display('create.html');
		}
	}
}
?>