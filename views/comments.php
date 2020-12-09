<br>
<br>
<h1>Add a comment, or don't.</h1>
<?php
if (count($errors) > 0)
{
	foreach ($errors as $error)
		echo $error.'<br>';
	unset($errors);
}
?>
<div class="indexfeed">
	<p>Upload by <?php echo get_image_author_from_path($_SESSION['image_src'])?></p>
	<img src=<?php echo '../'.$_SESSION['image_src'] ?>><br>
	<form action="../app/comment.php" method="post">
		<textarea class="comment-text" rows="1" cols="50" name="comment" placeholder="Comment here..."></textarea>
		<input type="submit" name="add_comment" value="Add Comment"><br>
	</form>
	<?php
	while ($i < $array_size)
	{?>
		<span><?php echo get_comment_author($comments_array[$i]['user_id']).": "?></span><br>
	 	<span><?php echo $comments_array[$i]['comment']; ?></span><br><br>
		<?php $i++; ?>	
	<?php
	}
	?>
</div>
<?php
require ($path.'/views/footer.php');
?>