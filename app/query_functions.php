<?php
function get_images()
{
	require ('./globals.php');
	require ($path.'/config/connection.php');
	$query = 'SELECT * FROM `images` WHERE `edited` = ? ORDER BY `images`.`creation_date` DESC ';
	$stmt = $conn->prepare($query);
	$stmt->execute([1]);
	$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	unset($stmt);
	return $array;
}

function get_image_author_name($id)
{
	require ('./globals.php');
	if ($id > 0)
	{
		require ($path.'/config/connection.php');
		$query = 'SELECT `username` FROM `users` WHERE `id` = ?';
		$stmt = $conn->prepare($query);
		$stmt->execute([$id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res['username'];
	}
	else
		return "";
}

function verify_image_id($id)
{
	require ('./globals.php');
	if ($id > 0)
	{
		require ($path.'/config/connection.php');
		$query = 'SELECT `path` FROM `images` WHERE `id` = ?';
		$stmt = $conn->prepare($query);
		$stmt->execute([$id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$res)
			return FALSE;
		else
			return TRUE;
	}
	else
		return FALSE;
}

function get_image_comments($image_id)
{
	require ('./globals.php');
	require ($path.'/config/connection.php');
	$query = 'SELECT * FROM `comments` WHERE `image_id` = ? ORDER BY `comments`.`creation_date` DESC';
	$stmt = $conn->prepare($query);
	$stmt->execute([$image_id]);
	$array = $stmt->fetchAll(PDO::FETCH_ASSOC); // error handling?
	unset($stmt); // is unsetting stmt here necessary, will closing the func unset it?
	return $array;	
}

function get_comment_author($user_id) // So this function does the samething as the last one
{
	require ('./globals.php');
	if ($user_id > 0)
	{
		require ($path.'/config/connection.php');
		$query = 'SELECT `username` FROM `users` WHERE `id` = ?';
		$stmt = $conn->prepare($query);
		$stmt->execute([$user_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res['username'];
	}
	else
		return "";
}

function get_image_author_from_path($author_path)
{
	require ('./globals.php');
	if (!empty($author_path))
	{
		require ($path.'/config/connection.php');
		$query = "SELECT `user_id` FROM `images` WHERE `path` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$author_path]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$res)
			return "Unkown";
		else
			return get_image_author_name($res['user_id']);
	}
	else
		return "Unknown";
}

function get_image_path_by_id($user_id)
{
	require ('./globals.php');
	if ($user_id > 0)
	{
		require ($path.'/config/connection.php');
		$query = 'SELECT * FROM `images` WHERE `user_id` = ? ORDER BY `images`.`creation_date` DESC';
		$stmt = $conn->prepare($query);
		$stmt->execute([$user_id]);
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($res)
			return $res;
		else
			return FALSE;
	}
	else
		return FALSE;
}

function get_image_likes($image_path)
{
	require ('./globals.php');
	require ($path.'/config/connection.php');
	$query = 'SELECT `likes` FROM `images` WHERE `path` = ?';
	$stmt = $conn->prepare($query);
	$stmt->execute([$image_path]);
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($res)
	{
		if ($res['likes'] == NULL) 
			return 0;		
		return $res['likes'];
	}
	else
		return 0;
}

function get_image_author_email($id)
{
	require ('./globals.php');
	if ($id > 0)
	{
		require ($path.'/config/connection.php');
		$query = 'SELECT `email` FROM `users` WHERE `id` = ?';
		$stmt = $conn->prepare($query);
		$stmt->execute([$id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res['email'];
	}
	else
		return "";
}

function get_image_owner_id($image_id)
{
	require ('./globals.php');
	if (!empty($image_id))
	{
		require ($path.'/config/connection.php');
		$query = "SELECT `user_id` FROM `images` WHERE `id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$image_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$res)
			return "";
		else
			return $res['user_id'];
	}
	else
		return "";
}

function get_owner_notif($user_id)
{
	require ('./globals.php');
	if ($user_id > 0)
	{
		require ($path.'/config/connection.php');
		$query = "SELECT * FROM `users` WHERE `id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$user_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if($res)
			return $res['notifications'];
		else 
			return 0;
	}
	else
		return 0;
}

function get_profile_pic($user_id)
{
	require ('./globals.php');
	if ($user_id > 0)
	{
		require ($path.'/config/connection.php');
		$query = "SELECT * FROM `users` WHERE `id` = ?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$user_id]);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		if($res)
		{
			if ($res['profile-pic'] == NULL)
				return FALSE;
			return $res['profile-pic'];
		}
		else 
			return FALSE;
	}
	else
		return FALSE;
}
?>