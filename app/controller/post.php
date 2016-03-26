<?php 
namespace App\Controller
{
	use \Core\Controller as Controller;
	use \Core\View as View;
	use \Core\Helper\Config as Config;
	use \App\Model as Model;

	class Post extends Controller
	{
		///controller post

		//methods
		public function default_action($params = array())
		{
			//$this->show($parameters);
			$this->show($params);
		}
		
		public function show($params = array() )
		{
			//default action
			//model
			$model = new Model\Post();
			$model->init();
			$post_id = ( empty($params[ 'id' ]) ) ? 1 : $params[ 'id' ];
			$context = $model->get_post( $post_id );
			if(empty($context))
			{
				echo 'error';
				exit();
			}

			//view
			View::init();
			$host = Config::get('website.host');
			$context['host'] = $host;
			View::render('post', $context ); // */
		}
	}//class
}//namespace
 ?>