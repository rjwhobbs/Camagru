<?php
session_start();
require ('globals.php');
require ($path.'/app/controller.php');
require ($path.'/app/form_block.php');
require ($path.'/views/header.php');
?>
	<h1 class="flex-con-cen-col">Sign in</h1>
	<div class="flex-con-cen-col mt-10 font-red bold">
		<?php 	
			if (isset($_SESSION['message']))
			{	
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			} 
		?>
	</div>
	<form class="flex-con-cen-col mt-10" action="signin.php" method="POST">
		<span class="flex-con-cen-col mt-10">Username:</span><input type="text" placeholder="username" name="username" required/><br>
		<span class="flex-con-cen-col mt-10">Password:</span><input type="password" placeholder="password" name="passwd" required/><br>
		<input class="flex-con-cen-col mt-10" type="submit" name="submit-signin" value="Sign in">
	</form>
	<a class="flex-con-cen-col mt-10" href=<?php echo $root_ws."/app/forgotpasswd.php" ?>><input type="submit" value="Forgot your password?"></a><br />
	<span class="flex-con-cen-col" >Don't have an account?</span>
	<a class="flex-con-cen-col mt-10" href="form.php"><input type="submit" value="Sign Up"></a>
<?php
require ($path.'/views/footer.php');
?>