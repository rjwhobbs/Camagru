<?php
session_start(); 
require (__DIR__.'/connection.php');
require (__DIR__.'/valid_session_check.php');
if (!empty($_POST['deletepath']) ) 
{
	
	$path = trim($_POST['deletepath']);
	if ($path != "images/error.png")
		unlink($path);
}
?>