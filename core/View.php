<?php 
namespace Core{

	//use \Core\Helper\Twig\
	class View{
		//properties
		//private static $template = '';
		//private static $context = array();
		private static $twig_environment = '';
		const TEMPLATES_PATH = 'app/template/';
		const TEMPLATE_NAME_PATTERN = '.template.html';

		//methods
		public static function render($template, $context = array() )
		{
			//render template
			$template = $template . self::TEMPLATE_NAME_PATTERN;
			echo self::$twig_environment->render( $template , $context);
		}//function

		/*public static function set_context($context)
		{
			self::$context = $context;
		}//function  */

		/*private static function load_template($template)
		{
			$template = self::TEMPLATES_PATH . $template . self::TEMPLATE_NAME_PATTERN;
			ob_start();
				include $template;
				$template = ob_get_contents();
			ob_end_clean();
			self::$template = $template;
		}//function  */

		public static function init()
		{
			//init twig template engine
			require_once '/home/mohsen/public_html/localhost_list/core/Twig/lib/Twig/Autoloader.php';
			\Twig_Autoloader::register();
			////load template content
			//change//self::load_template($template);
			//instance twig and give it template content
			$twig_loader = new \Twig_Loader_Filesystem(self::TEMPLATES_PATH);
			self::$twig_environment = new \Twig_Environment($twig_loader);
			//unset twig loader
			unset($twig_loader);
		}//function
	}//class
}//namespace
?>