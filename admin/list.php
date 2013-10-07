<?php

require_once "../utils.php";
global $config;
$config = include_once "../conf.php";

$arubaStorage = getArubaStorage();
$bucketName = $config['bucketName'];


$action = isSet($_GET['action']) ? $_GET['action'] : null;
$filename = isSet($_GET['file']) ? $_GET['file'] : null;

if($action && $filename && in_array($action, array('delete'))){

	switch($action){
	
		case 'delete':
			
			$arubaStorage->deleteObject($bucketName, $filename);
			
			break;
	
	}

}


$files = $arubaStorage->getBucket($bucketName);


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>My Gallery - Admin</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.0.0/css/bootstrap.min.css">
		<script src="//cdn.jsdelivr.net/jquery/2.0.3/jquery-2.0.3.min.js"></script>
		<script src="//cdn.jsdelivr.net/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
	
		<div class="container">
		
			<h1>Manage your Gallery</h1>
			<br/>
	
			<table class="table table-striped table-bordered table-hover text-center">
				<thead>
					<tr>
						<th>Filename</th>
						<th>Size</th>
						<th>Preview</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($files as $file): 
						$path = generatePath($file['name']); 
						$encodedPath = urlencode($file['name']);
					?>
					<tr>
						<td><?php echo $file['name']; ?></td>
						<td><?php echo round($file['size']/1024); ?>KB</td>
						<td>
							<a href="<?php echo $path; ?>" target="_blank">
								<img width="150" src="<?php echo $path; ?>"/>
							</a>
						</td>
						<td>
							<a class="btn btn-danger" href="?action=delete&amp;file=<?php echo $encodedPath; ?>">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<div class="row">
				<a href="upload.php" class="btn btn-primary pull-right">New Image </a>
			</div>
			<br/>
			<div class="row">
				<a href="../gallery.php" class="btn btn-primary pull-right">Show Gallery </a>
			</div>
			
		</div>
	
	</body>
	
</html>