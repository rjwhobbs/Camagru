<?php
session_start();
require ('./valid_session_check.php');
require ('./connection.php');
if (!empty($_POST['check-confirm']) && !empty($_POST['confirm-passwd']) && !empty($_POST['delete']))
{
	$error_checker = FALSE;
	$user_id = $_SESSION['user_id'];
	$check_id = $_POST['delete'];
	$passwd = $_POST['confirm-passwd'];
	if ($user_id === $check_id)
	{
		$query = "SELECT `passwd` FROM `users` WHERE `id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$user_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($res)
		{
			if (password_verify($passwd, $res['passwd'])) 
			{
				$query = "SELECT `path` FROM `images` WHERE `user_id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				$path_arr = $stmt->fetchAll((PDO::FETCH_ASSOC));

				$len = count($path_arr);
				if ($len === FALSE)
					$len = 0;
				
				$i = 0;
				while($i < $len)
				{
					unlink($path_arr[$i]['path']);
					$i++;
				}

				$query = "SELECT `profile-pic` FROM `users` WHERE `id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				$res = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($res)
					unlink($res['profile-pic']);
					
				unset($stmt);

				$query = "DELETE FROM `users` WHERE `users`.`id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				unset($stmt);

				$query = "DELETE FROM `images` WHERE `user_id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				unset($stmt);

				$query = "DELETE FROM `comments` WHERE `user_id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				unset($stmt);

				$query = "DELETE FROM `likes` WHERE `user_id` = ?"; 
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				unset($stmt);

				$query = "SELECT * FROM `images` WHERE `user_id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				$path_arr = $stmt->fetchAll((PDO::FETCH_ASSOC));

				header('location: signout.php');
				exit();
			}
			else
				$error_checker = TRUE;
		}
		else
			$error_checker = TRUE;

		if ($error_checker)
		{
			$_SESSION['message'] = "You entered incorrect details, account not deleted.";
			header('location: profile.php');
			exit();
		}	
	}	
}
else
{
	$_SESSION['message'] = "All feilds must be filled in.";
	header('location: profile.php');
	exit();
}
?>