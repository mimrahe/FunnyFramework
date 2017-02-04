# FunnyFramework
---
this is a very simple php framework I wrote it last year in 2015/4.
there is no need to any documentation for the framework because **FunnyFramework is very simple and clear**.

this version of FunnyFramework is 0.4.9 and has many weakness in coding and strategy and need for improvements!
anyone has permissions for using and editing FunnyFramwork!

## How to install

```bash
git init
git clone https://github.com/mimrahe/FunnyFramework
cd FunnyFramework
composer install
```

## Nginx configuration
see funny.nginx.example.txt file

## Structre
**app**: application content
  - Controller
  - Model
  - config
  - routes
  - templates
  - and any other directory you want to be
  
**core**: framework core functionalities

**public**: web accessable directory and assets content

**vendor**: app and framework dependecies

## How to use
### define routes
app/routes/routes.php

```php
return [
	"get" => [
		'/' => [
			'name' => 'getCreateIndex',
			"controller" => 'Create',
			"action" => 'getIndex'
		],
		
		'/([[:alnum:]]+)' => [
			'name' => 'getToLink',
			'controller' => 'Create',
			'action' => 'getToLink'
		]
	],
	'post' => [
		'/addLink/?' => [
			'name' => 'postAddLink',
			'controller' => 'Create',
			'action' => 'postAddLink'
		]
	]
];
```
### define controllers
app/Controller/create.php

```php
namespace App\Controller
{
	use \Core\View;
	use \Core\Helper\Request;
	use App\Model\Kutah;
	class Create
	{
		public function getIndex()
		{
			return View::display('create.html', ['host' => Request::server(['http_host'])]);
		}
		public function postAddLink()
		{
			$link = Request::post(['link']);
			$kutah = new Kutah();
			echo $kutah->addLink($link);
		}
		public function getToLink($short)
		{
			$kutah = new Kutah;
			return $kutah->redirect($short);
		}
	}
}
```
### define model
app/Model/Kutah.php

```php
namespace App\Model
{
	use Core\Model;
	use Core\Helper\Request;
	use Core\Helper\Router;
	use Core\Helper\Except;
	class Kutah extends Model
	{
		private $lock = '';
		private $xml = '';
		public function __construct()
		{
			$doc_root = Request::server(['document_root']);
			$main_dir = dirname($doc_root) . '/app/xml/';
			$this->xml = $main_dir . 'kutah.xml';
			$this->lock  = $main_dir . 'xml.lock';
		}
		public function addLink($url)
		{
			if(!$this->validateUrl($url))
				return false;
			while (file_exists($this->lock)) {
				continue;
			}
			$this->createLock();
			$xml = simplexml_load_file($this->xml);
			$subject = "/links/link[url='" . $url . "']";
			$found = $xml->xpath($subject);
			if($found){
				// return existed short
				$this->removeLock();
				return $found[0]->short;
			}
			$short = $this->makeLink($url);
			$link = $xml->addChild('link');
			$link->addChild('url', $url);
			$link->addChild('short', $short);
			$xml_file = fopen($this->xml, 'w');
			fwrite($xml_file, $xml->asXML());
			fclose($xml_file);
			$this->removeLock();
			return $short;
		}
		public function redirect($short)
		{
			$xml = simplexml_load_file($this->xml);
			$subject = "/links/link[short='" . $short . "']";
			$found = $xml->xpath($subject);
			if ($found) {
				Router::redirect($found[0]->url);
			}
			Except::make('route', 'notFound');
		}
		private function createLock()
		{
			fclose(fopen($this->lock, 'w'));
		}
		private function removeLock()
		{
			unlink($this->lock);
		}
		private function makeLink($url)
		{
			return hash('adler32', $url);
		}
		private function validateUrl($url)
		{
			return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
		}
	}
}
```

### use mysql database
when your model extends `Model`:
```php
// in your model constructor
parent::_contruct();
// inits database
```
from any other place
```php
Database::init();
```
`Database` works via PDO. you can extend `Database` and add extra functionality.

two main function is `exec` and `query` that return mysql result just like PDO result array.
