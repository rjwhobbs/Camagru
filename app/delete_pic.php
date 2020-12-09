<?php
session_start(); 
require ('./globals.php');
require ($path.'/config/connection.php');
require ($path.'/valid_session_check.php');
if (!empty($_POST['deletepath']) ) 
{
	
	$imgpath = trim($_POST['deletepath']);
	if ($imgpath != "images/error.png")
		unlink('../'.$imgpath);
}
?>