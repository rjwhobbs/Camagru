<?php
	$original_url = $_SERVER['REQUEST_URI'];
	$split_url = explode('/', $original_url);
	$url_len = count($split_url);
	$app_append = "app/";
	if ($url_len == 4) 
	{
		$app_append = "";
	}
	// echo $url_len;
?>