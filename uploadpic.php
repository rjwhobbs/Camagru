<?php
session_start();
require ('globals.php');
require ($path.'/valid_session_check.php');
require ($path.'/connection.php');
include ($path.'/includes/helpers.php');
if (isset($_POST['img']) && !empty($_POST['sticker']))
{
	$img = $_POST['img'];
	$user_id = $_SESSION['user_id']; // why is this here
	$sticker_choice = $_POST['sticker'];
	$bytes = random_bytes(4);	
	$rand = bin2hex($bytes);

	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);	
	$upload = imagecreatefromstring($data);

	if (strpos($sticker_choice, "nosticker") !== FALSE)
		$clean_arr = array();
	else
	{
		$sticker_arr = preg_split('/:/', $sticker_choice, NULL, PREG_SPLIT_NO_EMPTY);
		$clean_arr = array_unique($sticker_arr);
		$clean_arr = sticker_array_validator($clean_arr);
	}

	$mwidth = imagesx($upload);
	$mheight = imagesy($upload);

	$len = count($clean_arr);
	if ($len === FALSE)
		$len = 0;
	$i = 0;
	
	if ($sticker_choice != '')
	{
		while ($i < $len && $i < 4)
		{
			$sticker = imagecreatefrompng("images/".$clean_arr[$i]);
			list($width, $height) = getimagesize("images/".$clean_arr[$i]);
			if ($i == 0)
			{
				imagecopy($upload, $sticker, 0, 0, 0, 0, $width, $height);
			}
			else if ($i == 1)
			{
				$x = $mwidth - $width;
				imagecopy($upload, $sticker, $x, 0, 0, 0, $width, $height);
			}
			else if ($i == 2)
			{
				$y = $mheight - $height;
				imagecopy($upload, $sticker, 0, $y, 0, 0, $width, $height);
			}
			else if ($i == 3)
			{
				$x = $mwidth - $width;
				$y = $mheight - $height;
				imagecopy($upload, $sticker, $x, $y, 0, 0, $width, $height);
			}
			$i++;
		}
	}

	if ($len == 0)
		$file = "images/unedited".$rand.uniqid().".png";
	else
		$file = "images/".$rand.uniqid().".png";
	$success = imagepng($upload, $file);
	
	imagedestroy($upload);

	if ($success === FALSE)
		echo "images/error.png";
	else
		echo $file;
}
else
	echo "images/error.png";
?>