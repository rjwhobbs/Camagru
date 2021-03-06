<?php
session_start();
require ('../globals.php');
require ($path.'/app/valid_session_check.php');
require ($path.'/config/connection.php');
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
				$query = "SELECT `users`.`profile-pic`, `images`.`path` FROM `users` LEFT JOIN `images` ON `images`.`user_id` = `users`.`id` WHERE (`users`.`id` = ?) ";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				$path_arr = $stmt->fetchAll((PDO::FETCH_ASSOC));

				$len = count($path_arr);

				if ($len != FALSE && $path_arr[0]['profile-pic'] != NULL)
				{
					unlink($path_arr[0]['profile-pic']);
				}

				if ($len === FALSE)
					$len = 0;
				
				$i = 0;

				while($i < $len)
				{
					unlink('../'.$path_arr[$i]['path']);
					$i++;
				}

				$query = "DELETE FROM `users` WHERE `users`.`id` = ?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$user_id]);
				unset($stmt);

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
			header('location: ../profile.php');
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