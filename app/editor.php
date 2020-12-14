<?php
session_start();
require ('globals.php');
require ($path.'/app/valid_session_check.php');
require ($path.'/app/query_functions.php');
require ($path.'/views/header.php');
?>
	<!-- <h1>Camera Editor</h1> -->
	<h2 class="text-cen">Please select a sticker inorder to take a picture.</h2>
	<div>
		<div id="stickers" class="image-checkbox flex-con-cen">
			<input type="checkbox" name="sticker-menu2" id="sticker1" value="sticker1.png">
				<label for="sticker1"><img  src="../images/sticker1.png" ></label>
			<input type="checkbox" name="sticker-menu2" id="sticker2" value="sticker2.png">
				<label for="sticker2"><img  src="../images/sticker2.png" ></label>
			<input type="checkbox" name="sticker-menu2" id="sticker3" value="sticker3.png">
				<label for="sticker3"><img  src="../images/sticker3.png"></label>
			<input type="checkbox" name="sticker-menu2" id="sticker4" value="sticker4.png">
				<label for="sticker4"><img src="../images/sticker4.png" ></label>
			<input type="checkbox" name="sticker-menu2" id="stickernone" value="nosticker">
				<label for="stickernone">No Sticker</label>
		</div>
		<div class="flex-con-cen">
			<video id="video">Stream not available...</video>
		</div>
		<div class="flex-con-cen">
			<button style="display: none" id="photo-button" class="btn btn-dark">
				Take Photo
			</button>
			<label id="imagelable" style="display: none"> or upload a pic</label>
			<input id="uploadImage" style="display: none" type="file" name="upload-user" accept="image/*"><br> 
			<button id="save-button" class="btn btn-dark" style="display: none">
				Save Photo
			</button>
			<button id="clear-button" style="display: none">
				Try again
			</button>
		</div>
		<br>
		<canvas id="canvas"></canvas>
	</div>
	<div>
		<div id="photos">
		</div>
	</div>
	<div class="thumbnails">
		<?php
			$id = $_SESSION['user_id'];

			$thumbnails = get_image_path_by_id($id);
			
			$i = 0;
			if ($thumbnails !== FALSE)
				$len = count($thumbnails);
			else 
				$len = 0;
			if ($len > 0)
			{?>
				<p>Your photo history: </p><br>
			<?php
			}
			while ($i < $len)
			{?>
				<img src=<?php echo '../'.$thumbnails[$i]['path']?>>
				<form action="delete_img.php" method="POST">
					<input type="hidden" name="path" value=<?php echo $thumbnails[$i]['path'];?>>
					<input type="hidden" name="id" value=<?php echo $id;?>>
					<input type="submit" name="Delete" value="Delete">
				</form>
				<?php $i++; ?>
			<?php	
			}
		?>
	</div>
	<script src=<?php echo $root_ws."/javascript/main.js"?>></script>
<?php
require ($path.'/views/footer.php');
?>