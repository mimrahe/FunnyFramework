<?php 
namespace App\Model
{
	use \Core\Model as Model;
	use \Core\Helper\Database as Database;
	use \Core\Helper\Config as Config;
	use \Core\Helper\Name as Name;

	class Post extends Model
	{
		//model post
		//properties

		//methods
		public function get_post($post_url_id)
		{
			//get post id from url
			//url post id is in base hex
			$timestamp = Name::name_to_timestamp($post_url_id);
			//get post info from database
			$sql = <<<SQL
select
	`post_title`, unix_timestamp(`release_date`) as `post_date`
from
	`posts`
where
	unix_timestamp(`release_date`)=:time
SQL;
			
			$result = Database::exec( $sql, array('time' => $timestamp ) );
			//if result is empty
			if( empty( $result ) ){
				return false;//error
			}
			$post = $result[0];
			//set post date
			$post['post_date'] = $this->format_date( $post['post_date'] );
			//get post text from file
			ob_start();
				$dir = Config::get('website.dir');
				include $dir. 'app/posts/'. $post_url_id . '.post.html';
				$body = ob_get_contents();
			ob_end_clean();
			$post['post_body'] = $body;

			//return context
			return $post;
		}//function
	}//class
}//namespace
 ?>