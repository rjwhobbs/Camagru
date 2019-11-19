<?php
session_start(); 
require ('./connection.php');
require ('./valid_session_check.php');
if (!empty($_POST['deletepath']) ) 
{
	
	$path = trim($_POST['deletepath']);
	if ($path != "images/error.png")
		unlink($path);
}
?>