<?php 
return [
	"get" => [
		"%^/create$%" => [
			'controller' => 'index',
			'action' => 'getIndex'
		];
	];

	"post" => [
		"%create_link/([[:punct:][:alnum:]]+)%" => [
			'controller' => 'index',
			'action' => 'postCreateLink'
		];
	];
];
?>