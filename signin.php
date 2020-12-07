<?php
session_start();
require ('globals.php');
require ($path.'/app/controller.php');
require ($path.'/app/form_block.php');
require ($path.'/views/header.php');
?>
	<h1>Sign in</h1>
	<div>
		<?php 	
			if (isset($_SESSION['message']))
			{	
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			} 
		?>
	</div>
	<form action="signin.php" method="POST">
		<span>Username:</span><input type="text" placeholder="username" name="username" required/><br>
		<span>Password:</span><input type="password" placeholder="password" name="passwd" required/><br>
		<input type="submit" name="submit-signin" value="Sign in">
	</form>
	<a href="forgotpasswd.php"><input type="submit" value="Forgot your password?"></a>
	<br>
	<span>Don't have an account?</span><br>
	<a href="form.php"><input type="submit" value="Sign Up"></a>
<?php
require ($path.'/footer.php');
?>