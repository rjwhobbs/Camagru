<?php
session_start();
require ('./globals.php');
require ($path.'/app/controller.php');
require ($path.'/app/valid_session_check.php'); 

if ($_SESSION['notify'] == 'on')
{
	$notify_state = 0;
	$notify_value = 'off';
}
else if ($_SESSION['notify'] == 'off')
{
	$notify_state = 1;
	$notify_value = 'on';	
}
$query = 'UPDATE `users` SET `notifications` = ? WHERE `id` = ?';
$stmt = $conn->prepare($query);
$stmt->execute([$notify_state, $_SESSION['user_id']]); 
unset($stmt);
$_SESSION['notify'] = $notify_value;
header('location: profile.php');
exit();
?>