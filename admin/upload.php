<?php

require_once "../utils.php";
global $config;
$config = include_once "../conf.php";

$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isSet($_FILES['myFile'])){
	
	$arubaStorage = getArubaStorage();
	$path = $_FILES['myFile']['tmp_name'];
	$URI = basename($_FILES['myFile']['name']);
	
	$arubaStorage->putObjectFile($path, $config['bucketName'], $URI, S3::ACL_PUBLIC_READ);
	
	$publicURI = generatePath($URI);
	
	$msg = "File successfully uploaded here: <a href='$publicURI' target='_blank'>$publicURI</a> <button type='button' class='close' data-dismiss='alert'>&times;</button>";
	
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>My Gallery - Admin</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
		<link rel="stylesheet" href="../style.css">
		<script src="//cdn.jsdelivr.net/jquery/2.0.3/jquery-2.0.3.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    </head>
    <body>
	
		<div class="container">
		
			<h1>Upload a new Image</h1>
			<br/>
			
			<?php if ($msg): ?>
			<p class="alert alert-success"><?php echo $msg; ?></p>
			<?php endif; ?>
	
			<form action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal text-center" style="width:250px;margin:20px auto;">

			
				<div class="control-group">
					<label class="control-label" for="inputEmail">New File:</label>
					<div class="controls">
					  <input type="file" name="myFile" placeholder="Upload a new file here!" required="required" />
					</div>
				  </div>
				
				<br/>
				
				<div class="control-group">
					<div class="controls">
					  <button type="submit" class="btn btn-success">Upload!</button>
					</div>
				  </div>
				
				

			</form>
			
			
			
			<div class="row">
				<a href="list.php" class="btn btn-primary pull-right">Manage Gallery</a>
			</div>
			<br/>
			<div class="row">
				<a href="../gallery.php" class="btn btn-primary pull-right">Show Gallery </a>
			</div>
			
		</div>
	
	</body>
	
</html>

