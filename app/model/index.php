<?php 
namespace App\Model 
{
	use \Core\Model as Model;
	use \Core\Helper\Database as Database;
	use \Core\Helper\Config as Config;
	use \Core\Helper\Name as Name;
	use \Core\Helper\Redirect as Redirect;

	class Index extends Model
	{
		//model index
		//properties
		private static $count_all = '';
		private static $page_offset = '';
		private static $pages = '';
		private static $posts = array();
		private static $page = '';

		//methods
		public function get_page($page = 1)
		{
			//count all rows
			$this->_count_all();
			//check to see page is number
			$page = ( is_nan( $page ) and $page == 0 ) ? 1 : $page;
			//check to see page is valid
			if(  !$this->_is_page_valid( $page ) ){
				//if page is not valid then it can be last page
				$page = self::$pages;
				$redirect_address = 'index/show/page-' . $page;
				Redirect::to( $redirect_address );
				exit;
			}
			self::$page = $page;
			//get posts from database
			$query_result = $this->_get_posts( (int)$page );
			//test
				//test//echo '<pre>';
				//test//print_r($posts);// */
			//get posts body
			self::$posts = $this->_get_posts_body( $query_result );
			//test
				//echo '<pre>';
				//print_r($posts);
		}//function

		private function _get_post_body( $post_file_name )
		{
			//get text file of post//
			//only section of posts that named for index page
			//get post contents
			//set file name
			$website_dir = Config::get('website.dir');
			$posts_dir = Config::get('posts.dir');
			$post_file_name .= '.post.html';
			$post_file_path = $website_dir . $posts_dir . $post_file_name;
			//open file and get contents
			$post_content = file_get_contents($post_file_path , null , null , 0 , 1070 );
			//echo '<br>'.$post_file_path;
			//return post index body
			return $post_content;
		}//function

		private function _get_posts_body( $query_result )
		{
			//call function:_get_post_body
			foreach ($query_result as &$value) {
				//for each post of posts calls function: _get_post_body
				//save the result into a new key (post_body) of array
				//set post title
				$value['post_title'] = $value['title'];
					//delete title
					unset($value['title']);
				//post timestamp
				$timestamp = $value[ 'timestamp' ];
					//delete timestamp
					unset( $value['timestamp'] );
				//post file name
				$post_file_name = Name::timestamp_to_name( $timestamp );
				//set post date
				$value['post_date'] = $this->_get_post_date( $timestamp );
				//set post body
				$value[ 'post_body' ] = $this->_get_post_body( $post_file_name );
				//post_link_name
				$value[ 'post_page_name' ] = $post_file_name;
			}
			//for all posts
			//return posts
			return $query_result;
		}//function

		public function set_context()
		{
			//host
			$host = Config::get('website.host');
			//set context
			$context = array();
			$context[ 'page_title' ] = 'وبلاگ محسن رنجبر ';
			$context['host'] = $host;
			$context['posts'] = self::$posts;
			$context['post_page_url'] = $host . 'post/show/id-';
			$context['page_link_url'] = $host . 'index/show/page-';
			$context['prev_page'] = $this->_calc_prev_page();
			$context['next_page'] = $this->_calc_next_page();
			return $context;
		}//function

		private function _calc_prev_page()
		{
			//calculate previous page
			return self::$page - 1;
		}//function

		private function _calc_next_page()
		{
			//calculate next page
			if( self::$page < self::$pages ){
				return self::$page + 1;
			}
			return 0;
		}//function

		private function _get_post_date( $timestamp )
		{
			//return post date
			return $this->format_date( $timestamp );
		}//function

		private function _get_posts($page)
		{
			//get posts
			//query string
			$sql = <<<SQL
SELECT
	`post_title` as `title`, 
	unix_timestamp(`release_date`) as `timestamp`
FROM
	`posts`
ORDER BY
	`release_date` DESC
LIMIT
	:start_row_num,:page_offset_num
SQL;
			//page first row
			$page_first_row = $this->_calc_page_first_row($page);
			//test
				//var_dump($page_first_row );
			//page offset
			$page_offset = (int)Config::get('index.page_offset');
			//test
				//var_dump($page_offset );
			//parameters to sql query
			$sql_values = array(
				'start_row_num' => $page_first_row,
				'page_offset_num' => $page_offset
				);
			//get result from database
			return Database::exec( $sql , $sql_values );
		}//function

		private function _calc_page_first_row($page)
		{
			//get page first row
			return ( ($page - 1 ) * self::$page_offset );
		}//function

		private function _count_all()
		{
			//count all rows
			$sql = <<<SQL
select
	count(*) as `count`
from
	`posts`
SQL;
			$result = Database::query($sql);
			self::$count_all = $result[0]['count'];
		}//function

		private function _is_page_valid( $page )
		{
			//check to see if page is valid
			self::$page_offset = Config::get( 'index.page_offset' );
			self::$pages = ceil( self::$count_all / self::$page_offset );
			//return pages
			return ( $page <= self::$pages ) ? true : false ;
		}//function

		/*private function _get_post_index_body( $post_body )
		{
			//split index section of post body
			//test
				//echo '<br><pre>';
				//echo $post_body;
			$pattern = '#^<!-- index -->.*<!-- index -->#im';
			echo '<pre>';
			//print_r($post_body);
			preg_match( $pattern , $post_body , $result );
			print_r($result);
		}//function */

	}//class
}//namespace
 ?>