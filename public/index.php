<?php
	//use
	use Core\Helper\Router;
	use Core\Helper\App;

	//autoload
	require_once '../vendor/autoload.php';
	
	//initialize app
	App::init();

	// start routing
	Router::start();
?>
