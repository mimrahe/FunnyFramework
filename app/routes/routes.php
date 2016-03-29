<?php 
return [
	"get" => [
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