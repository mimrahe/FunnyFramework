<?php 
return [
	"get" => [
		'/create/?' => [
			'name' => 'getCreateIndex',
			"controller" => 'Index',
			"action" => 'getIndex'
		],
		'/createLink/([[:alnum:][:punct:]]+)/?' => [
			'name' => 'getCreateLink',
			'controller' => 'Index',
			'action' => 'getCreateLink'
		]
	],
];
?>