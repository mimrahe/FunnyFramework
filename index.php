<?php
namespace {
	//use
	use App\Controller;
	use Core\Helper\Config;
	use Core\Helper\Autoload;
	use Core\Helper\Router;
	use Core\Helper\Request;

	echo '<pre>';
	die(var_dump($_GET, $_POST, $_SERVER));

	//autoload
	require_once 'core/helper/autoload.php';
	Autoload::init();

	//set default timezone
	$main_config = new Config('main');

	date_default_timezone_set($main_config->timezone);

	//get url
	$url = Request::get(['url']);
	die($url);
	//route the url
	$route = Router::to($url);
}

?>
