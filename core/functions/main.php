<?php 
function dd($item, $callback_before)
{
	$callback_before();
	die(var_dump($item));
}
?>