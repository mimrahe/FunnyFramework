<?php 
namespace Core\Helper
{
	use \Core\Helper\Config as Config;
	class Database
	{
		//helper database
		//properties
		private static $pdo = '';

		//methods
		public static function init()
		{
			//make an instance of pdo and save to $pdo
			$dbhost = Config::get('database.host');
			$dbname = Config::get('database.name');
			//dsn
			$dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";

			$dblogin = Config::get('database.login');
			$dbpassword = Config::get('database.password');
			$options = array(
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
				);
			//make a pdo
			$pdo = new \PDO($dsn, $dblogin, $dbpassword, $options);
			self::$pdo = $pdo;
		}//function

		public static function exec( $sql , $values = array() )
		{
			//test
				/*echo '<pre>';
				print_r($values);//*/
			//pdo prepare and exec
			$stmt = self::$pdo->prepare($sql);
			//test
				//echo '<pre>';
				//print_r($stmt);
			//bind values
			foreach ($values as $key => $value) {
				if( is_int( $value ) )
				{
					$stmt->bindValue( "{$key}", $value, \PDO::PARAM_INT );
				}elseif( is_string( $value ) ){
					$stmt->bindValue( "{$key}" , $value, \PDO::PARAM_STR );
				}
			}
			//execute sql
			$stmt->execute();
			//then return result
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}//function

		public static function query( $sql )
		{
			//query a sql
			$stmt = self::$pdo->query($sql);
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}//function
	}//class
}//namespace
 ?>