<?php
session_start(); 
require (getcwd().'/connection.php');
require (getcwd().'/valid_session_check.php');
if (!empty($_POST['deletepath']) ) 
{
	
	$path = trim($_POST['deletepath']);
	if ($path != "images/error.png")
		unlink($path);
}
?>