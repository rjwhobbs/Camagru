<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Camagru</title>
	<link rel="stylesheet" href="css/style.css">
</head> -->
<?php
session_start();
require ('globals.php');
require ($path.'/app/controller.php');
require ($path.'/views/header.php');
?>
<h2>Camagru feed</h2>
<?php
	if (count($errors) > 0)
	{
		foreach ($errors as $error)
			echo $error.'<br>';
		unset($errors);
	}
	if (isset($_SESSION['message']))
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
	$images = get_images();
	$i = 0;
	$array_size = count($images);
	while ($i < $array_size)
	{?>
		<div class="indexfeed">
			<img src=<?php echo $images[$i]['path']; ?>><br>
			<?php 
			if (isset($_SESSION['user_id']) && isset($_SESSION['username']))
			{?>
				<button id=<?php echo $images[$i]['id']?> 
						value=<?php echo $images[$i]['path']; ?> 
						onclick="likeFunction(this)">
						<?php echo get_image_likes($images[$i]['path']); ?>
						Like+</button>
			<?php
			}
			else
			{?>
				<button><?php echo get_image_likes($images[$i]['path']); ?> 
				Like+</button>
			<?php	
			}
			?>
			<p>Upload by <?php echo get_image_author_name($images[$i]['user_id']) ?></p>
			<form action="app/comment.php" method="post">
				<input type="hidden" name="image_src" value=<?php echo $images[$i]['path'] ?>>
				<input type="hidden" name="image_id" value=<?php echo $images[$i]['id'] ?>>
				<input type="submit" name="add_comment" value="View/Add Comments">
			</form><br>
		</div><br>
		<?php $i++; ?>
	<?php
	}
?>
<script src="javascript/helpers.js"></script>
<?php
require (getcwd().'/footer.php');
?>