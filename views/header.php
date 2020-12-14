<?php
require ('./globals.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Camagru</title>
	<link rel="stylesheet" href=<?php echo $root_ws."/css/layout.css"?>>
	<link rel="stylesheet" href=<?php echo $root_ws."/css/style.css"?>>
</head>
<body>
	<h1>This is Camagru</h1>
	<?php
		$redirect = "../index.php";
		if ($_SERVER['REQUEST_URI'] == '/camagru/index.php')
		{
			$redirect = 'index.php';
		}
		if (isset($_SESSION['user_id'])) 
		{?>
			<a href=<?php echo $root_ws."/app/signout.php"?>><input type="submit" value="Sign Out"></a>
			<a href=<?php echo $root_ws."/app/profile.php"?>><input type="submit" value="Profile"></a> 
			<a href=<?php echo $root_ws."/app/editor.php"?>><input type="submit" value="Camera Editor"></a> 
		<?php 
		} 
		else 
		{?>
			<a href=<?php echo $root_ws."/app/signin.php"?>><input type="submit" value="Sign In"></a>
			<a href=<?php echo $root_ws."/app/form.php"?>><input type="submit" value="Sign Up"></a>
		<?php 
		}
	?>
	<a href=<?php echo $root_ws."/index.php"?>><input type="submit" value="Feed"></a>
	<?php
		if (isset($_SESSION['user_id']))
		{?>
			<br><span>Logged in as: <?php echo $_SESSION['username']?></span>
			<?php
				$profile_pic = get_profile_pic($_SESSION['user_id']);
				if ($profile_pic !== FALSE)
				{?>
					<div class="profile-pic-div">
						<img src=<?php echo $root_ws.'/'.$profile_pic ?> alt="">
					</div>
				<?php
				}
			?>
		<?php	
		}
	?>	