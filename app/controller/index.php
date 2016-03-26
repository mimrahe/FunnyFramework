<?php 
namespace App\Controller
{
	use \Core\Controller as Controller;
	use \Core\View as View;
	use \Core\Helper\Config as Config;
	use \App\Model as Model;

	class Index extends Controller
	{
		//controller index

		//methods
		public function default_action($params = array())
		{
			$this->show($params);
		}
		
		public function show($params)
		{
			//action default
			//model params to give
			//what page to show
			$page = ( !empty( $params['page'] ) and !is_nan( $params[ 'page' ] ) ) ? $params[ 'page' ] : 1;
			//model
			$model = new Model\Index();
			$model->init();
			//get info of model
			//test
				//echo '<pre>';
			//what page
			$page = ( isset( $params['page'] ) ) ? $params['page'] : 1;
			//call model
			$model->get_page( $page );
			//set context
			$context = $model->set_context();
			//view
			View::init();
			View::render('index', $context ); // */
		}
	}//class
}//namespace
 ?>