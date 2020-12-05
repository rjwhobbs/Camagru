<?php
session_start();
require (__DIR__.'/valid_session_check.php');
require (__DIR__.'/connection.php');
if (!empty($_POST['path']))
{
	$file = $_POST['path'];
	$file = trim($file);
	if ($file != "images/error.png")
	{
		if (strpos($file, "unedited") !== FALSE)
			$edited = 0;
		else
			$edited = 1;
		$user_id = $_SESSION['user_id'];
		$sql = 'INSERT INTO `images` (`path`, `user_id`, `edited`) VALUES (?, ?, ?)'; 
		$stmt = $conn->prepare($sql);
		$stmt->execute([$file, $user_id, $edited]);
		unset($stmt);
	
		echo "Image has been saved, please click \"Try again\" to load your photo history.";
	}
	else
		echo "Sorry, we couldn't save the image";
}
else
	echo "Sorry, we couldn't save the image";
?>