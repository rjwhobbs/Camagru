<?php
session_start();
require (getcwd().'/valid_session_check.php');
require (getcwd().'/app/controller.php');
require (getcwd().'/header.php');
?>
<h1>Profile settings for <?= $_SESSION['username']?></h1>
<?php
	if (count($errors) > 0)
	{
		foreach ($errors as $error)
			echo $error.'<br>';
		unset($errors);
	}
	if (!empty($_SESSION['message'])) 
	{
		echo $_SESSION['message'].'<br>';
		unset($_SESSION['message']);
	}
?><br>
<form action="profile.php" method="post"> 
	<span>Your username: <?= $_SESSION['username'].' ' ?></span><br>
		<input type="text" placeholder="update username" name="new_username">
			<input type="submit" name="update_username" value="Update"><br>
	<span>Your email address: <?= $_SESSION['user_email'].' ' ?></span><br>
		<input type="email" placeholder="update email address" name="new_email">
			<input type="submit" name="update_email" value="Update"><br>
	<span>Change Password:</span><br>
		<input type="password" placeholder="old password" name="old_passwd"><br>
		<input type="password" placeholder="new password" name="new_passwd"><br>
		<input type="password" placeholder="confirm" name="confirm_new_passwd"><br>
			<input type="submit" name="update_passwd" value="Change password">
</form><br>
<span>Email notifications are <?= $_SESSION['notify']?></span><br>
<?php
	if ($_SESSION['notify'] == "on")
	{?>
		<a href="notif_change.php"><input type="submit" value="Turn off"></a>
	<?php
	}
	else if ($_SESSION['notify'] == "off")
	{?>
		<a href="notif_change.php"><input type="submit" value="Turn on"></a>
	<?php
	}
?><br><br>
<form id="delete-account" action="delete_account.php" method="post">
	<span>Delete your account.<br> 
			Enter the required feilds and click 'Delete account'. <br>
			WARNING! This action cannot be undone!</span><br>
	<input type="hidden" value=<?= $_SESSION['user_id'] ?> name="delete">
	<span>I understand</span>
	<input type="checkbox" value="checked" name="check-confirm"><br>
	<input style="width: 300px" type="password" placeholder="Enter password to confirm account deletion" name="confirm-passwd"><br>
</form>
<button type="submit" form="delete-account">Delete account</button>
<?php
require (getcwd().'/footer.php');
?>
