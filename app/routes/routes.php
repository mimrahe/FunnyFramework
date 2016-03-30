<?php 
return [
	"get" => [
		'/' => [
			'name' => 'getCreateIndex',
			"controller" => 'Create',
			"action" => 'getIndex'
		],

		'/create/?' => [
			'name' => 'getCreateIndex',
			"controller" => 'Create',
			"action" => 'getIndex'
		],

		'/createLink/([[:alnum:][:punct:]]+)' => [
			'name' => 'getCreateLink',
			'controller' => 'Index',
			'action' => 'getCreateLink'
		]
	],
];
?>