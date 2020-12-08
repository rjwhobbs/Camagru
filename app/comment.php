<?php
session_start();
require ('./globals.php');
require ($path.'/valid_session_check.php'); 
require ($path.'/app/controller.php');
require ($path.'/views/header.php');
if (!empty($_POST['image_src']) && !empty($_POST['image_id']))
{
	$_SESSION['image_src'] = $_POST['image_src'];
	$_SESSION['image_id'] = $_POST['image_id'];
}
else if (!isset($_SESSION['image_src']) || !isset($_SESSION['image_id']))
{
	$_SESSION['message'] = "We couldn't load the comments page right now, please try again later.";
	header('location: index.php');
	exit();
} 
$comments_array = get_image_comments($_SESSION['image_id']);
$array_size = count($comments_array);
$i = 0;
require ($path.'/views/comments.php');
?>
