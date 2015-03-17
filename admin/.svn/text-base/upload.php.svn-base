<?php
	/* Note: This thumbnail creation script requires the GD PHP Extension.  
		If GD is not installed correctly PHP does not render this page correctly
		and SWFUpload will get "stuck" never calling uploadSuccess or uploadError
	 */

	// Get the session Id passed from SWFUpload. We have to do this to work-around the Flash Player Cookie Bug
/*
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}

	session_start();
	ini_set("html_errors", "0");
*/

	// Check the upload
	if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
		echo "ERROR:invalid upload";
		exit(0);
	}

	// Get the image and create a thumbnail
	$img = imagecreatefromjpeg($_FILES["Filedata"]["tmp_name"]);
	if (!$img) {
		echo "ERROR:could not create image handle ". $_FILES["Filedata"]["tmp_name"];
		exit(0);
	}

	$width = imageSX($img);
	$height = imageSY($img);

	if (!$width || !$height) {
		echo "ERROR:Invalid width or height";
		exit(0);
	}

	// Build the thumbnail
	$target_width = 600;
	$img_ratio = $width / $height;
	$target_height = $target_width / $img_ratio;
	

	$new_img = ImageCreateTrueColor($target_width, $target_height);



    if (!@imagecopyresampled($new_img, $img, 0,0,0,0,$target_width, $target_height, $width, $height)) {
		echo "ERROR:Could not resize image";
		exit(0);
	}


	imagejpeg($new_img, $_SERVER["DOCUMENT_ROOT"] ."/static/images/fotos/". $_POST["Filename"]);

	echo "FILEID:" . $_POST["Filename"];	// Return the file id to the script
?>