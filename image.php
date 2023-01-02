<?php

// The target directory of uploading is uploads
$target_dir = "image/users/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uOk = 1;

if(isset($_POST["submit"])) {
	
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "file already exists.<br>";
		$uOk = 0;
	}
	
	// Check if $uOk is set to 0
	if ($uOk == 0) {
		echo "Your file was not uploaded.<br>";
	}
	
	// if uOk=1 then try to upload file
	else {
		
		// $_FILES["file"]["tmp_name"] implies storage path
		// in tmp directory which is moved to uploads
		// directory using move_uploaded_file() method
		if (move_uploaded_file($_FILES["file"]["tmp_name"],
											$target_file)) {
			echo "The file ". basename( $_FILES["file"]["name"])
						. " has been uploaded.<br>";
			
			// Moving file to New directory
			if(rename($target_file, "image/".
						basename( $_FILES["file"]["name"]))) {
				echo "File moving operation success<br>";
			}
			else {
				echo "File moving operation failed..<br>";
			}
		}
		else {
			echo "Sorry, there was an error uploading your file.<br>";
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>
		Move a file into a different
		folder on the server
	</title>
</head>

<body>
	<form action="image.php" method="post"
			enctype="multipart/form-data">
		
		<input type="file" name="file" id="file">
		
		<br><br>
		
		<input type="submit" name="submit" value="Submit">
	</form>
</body>

</html>					
