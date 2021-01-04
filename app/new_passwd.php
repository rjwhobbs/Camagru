<?php
session_start();
require ('./globals.php');
require ($path.'/app/controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reset password</title>
	<link rel="stylesheet" href=<?php echo $root_ws."/css/layout.css"?>>
	<link rel="stylesheet" href=<?php echo $root_ws."/css/style.css"?>>
</head>
<body class="flex-con-cen-col mt-30">
	<div>
		<?php
			if (!empty($_SESSION['message']))
			{	
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			}
		?>
	</div> 
	<form class="flex-con-cen-col" action="new_passwd.php" method="post">
		<span class="mt-10">Enter your email address:</span><input type="email" name="email" require><br> 
		<span class="mt-10">Enter your new password:</span><input type="password" name="passwd" require><br>
		<span class="mt-10">Confirm your new password:</span><input type="password" name="confirm-passwd" require><br>
		<input class="mt-10" type="submit" name="Reset" value="Reset">
	</form>
</body>
</html>