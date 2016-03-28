<?php 
namespace {
	//use
	use App\Controller;
	use Core\Helper\Config;
	use Core\Helper\Autoload;
	use Core\Helper\Router;
	use Core\Helper\Request;

	//autoload
	require_once 'core/helper/autoload.php';
	Autoload::init();

	//set default timezone
	$main_config = new Config('main');

	date_default_timezone_set($main_config->timezone);

	//get url
	$url = Request::get(['url']);
	//route the url
	$route = Router::to($url);
}

?>
