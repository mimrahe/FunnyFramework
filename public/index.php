<?php
namespace {
	//use
	use Core\Helper\Autoload;
	use Core\Helper\Router;
	use Core\Helper\App;

	//autoload
	require_once '../core/helper/autoload.php';
	Autoload::init();

	//initialize app
	App::init();

	// start routing
	Router::start();
}

?>
