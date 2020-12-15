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
	<div class="main-header">
	<div class="flex-con">
		<h1 class="flex-item-1 mt-15 font-60 font-choc">Camagru 
			<span class="font-16"><i>...yummy pics</i></span>
		</h1>
		<?php
			if (isset($_SESSION['user_id']))
			{?>
				<div class="flex-item-01">			
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
					<!-- <span>Logged in as: <?php echo $_SESSION['username']?></span> -->
				</div>
			<?php	
			}
			?>
	</div>
	<div class="flex-con-button">
		<a href=<?php echo $root_ws."/index.php"?>><input type="submit" value="Feed"></a>
		<?php
			if (isset($_SESSION['user_id'])) 
			{?>
				<a href=<?php echo $root_ws."/app/editor.php"?>><input type="submit" value="Camera Editor"></a> 
				<a href=<?php echo $root_ws."/app/profile.php"?>><input type="submit" value="Profile"></a>
				<span style="display: flex">
					<span class="pd-7 pdb-0 pdt-7 dark-border mr-0 right-s">Logged in as: <?php echo $_SESSION['username']?></span>
					<a href=<?php echo $root_ws."/app/signout.php"?>><input class="left-s" type="submit" value="Sign Out"></a>
				</span>
			<?php 
			} 
			else 
			{?>
				<a href=<?php echo $root_ws."/app/signin.php"?>><input type="submit" value="Sign In"></a>
				<a href=<?php echo $root_ws."/app/form.php"?>><input type="submit" value="Sign Up"></a>
			<?php 
			}
		?>
		
	</div>
	</div>	