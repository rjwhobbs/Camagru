<?php
session_start();
require ('./globals.php');
require ($path.'/app/controller.php');
require ($path.'/views/header.php');
?>
	<h1 class="flex-con-cen-col"> 
		Don't worry everyone forgets their passwords
	</h1>
	<p class="flex-con-cen-col">Please enter your email address, check your email and click on the link provided.</p>
	<div class="flex-con-cen-col font-red bold">
		<?php
				if (!empty($_SESSION['message']))
				{	
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				}
		?>
	</div> 
	<form class="flex-con-cen-col" action=<?php echo $root_ws."/app/forgotpasswd.php"?> method="post">
		<input class="mt-10" type="email" name="email" require><br>
		<input class="mt-10" type="submit" name="reset-passwd" value="Send email">
	</form>
</body>
</html>