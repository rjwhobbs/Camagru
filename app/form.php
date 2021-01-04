<?php
session_start();
require ('globals.php');
require_once ($path.'/app/controller.php');
require ($path.'/app/form_block.php');
require ($path.'/views/header.php');
?>
<h1 class="flex-con-cen-col mt-30">Sign Up</h1>
<div class="flex-con-cen-col"><?php  
			if (count($errors) > 0)
			{
				foreach ($errors as $error)
				{?>
					<span class="font-red bold"><?php echo $error ?></span><br />
				<?php
				}
				unset($errors);
			}
			if (isset($_SESSION['message']))
			{
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			}
?></div>
<form class="flex-con-cen-col" action=<?php echo $root_ws."/app/form.php" ?> method="POST" autocomplete="off" enctype="multipart/form-data">
	<span class="mt-10">Username:</span><input type="text" placeholder="username" name="username" required/><br />
	<span class="mt-10">Email:</span><input type="email" placeholder="email address" name="email" required/><br />
	<span class="mt-10">Password:</span><input type="password" placeholder="password" name="passwd" required/><br />
	<span class="mt-10">Confirm password:</span><input type="password" placeholder="confirm" name="confirm-passwd" required/><br />
	<label class="mt-10">Choose a profile pic (optional):</label><input type="file" name="profile-pic" accept="image/*" /><br /> 
	<input class="mt-10" type="submit" name="submit-signup" value="Register" />
	<input class="mt-10" type="submit" name="resend-link" value="Resend link">
</form>
<?php
require ($path.'/views/footer.php')
?>