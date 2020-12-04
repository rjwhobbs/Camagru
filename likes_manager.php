<?php
session_start();
require ('./connection.php');
include ('./query_functions.php');
include ('./mail_notif_function.php');
if (isset($_POST['likes']) && isset($_POST['image_path']) && isset($_POST['image_id']) && isset($_SESSION['user_id']))
{
	$image_id = $_POST['image_id'];
	$image_path = $_POST['image_path'];
	$user_id = $_SESSION['user_id'];

	try
	{
		// Lets try use this join some where
		// SELECT * FROM `images` INNER JOIN `likes` ON `images`.`id` = `likes`.`image_id` WHERE (`images`.`user_id` = 2 AND `likes`.`user_id` = 2) 
		$query = "LOCK TABLES `images` WRITE, `likes` WRITE, `users` WRITE";
		$conn->query($query);

		$query = "SELECT * FROM `images` WHERE `path` = ? && `id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$image_path, $image_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		unset($stmt);
		if ($res)
		{
			$likes = $res['likes'];
			$likes += 1;
			if ($image_id == $res['id'])
			{
				$image_owner_id = $res['user_id'];
				if ($image_owner_id == $user_id)
					$liker = "You";
				else
					$liker = $_SESSION['username'];
				
				$query = "SELECT `liked` FROM `likes` WHERE `image_id` = ? 
							&& `user_id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$image_id, $user_id]);
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				unset($stmt);
				if (!$res)
				{
					$query = "UPDATE `images` SET `likes` = ? 
								WHERE `id` = ?";
					$stmt = $conn->prepare($query);
					$stmt->execute([$likes, $image_id]);
					unset($stmt);
					
					$query = "INSERT INTO `likes` (`user_id`, `image_id`, `liked`)
								VALUE (?, ?, ?)";
					$stmt = $conn->prepare($query);
					$stmt->execute([$user_id, $image_id, 1]);
					unset($stmt);
					
					$query = "SELECT * FROM `users` WHERE `id` = ?";
					$stmt = $conn->prepare($query);
					$stmt->execute([$image_owner_id]);
					$res = $stmt->fetch(PDO::FETCH_ASSOC);

					if ($res)
					{
						if ($res['notifications'] == 1)
							mail_like_notif($res['email'], $res['username'],$liker);
					}

					echo $likes;
				}
				else
					echo get_image_likes($image_path);
			}
			else
				echo get_image_likes($image_path);
		}
		else
			echo get_image_likes($image_path);
		
		$query = "UNLOCK TABLES";
		$conn->query($query);
	}
	catch (Throwable $e)
	{
		$query = "UNLOCK TABLES";
		$conn->query($query);
		echo $e->getMessage();
	}
}
else
{
	if (isset($_POST['image_path']))
		echo get_image_likes($_POST['image_path']);
	else
		echo "0";
}
?>