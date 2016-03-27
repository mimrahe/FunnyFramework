<?php 
$routes = [
	"get" => [
		"%^/create$%" => [
			'controller' => 'index',
			'action' => 'getIndex'
		];
	];

	"ajax" => [
		"%create_link/([[:punct:][:alnum:]]+)%" => [
			'controller' => 'index',
			'action' => 'ajaxCreateLink'
		];
	];
];
?>