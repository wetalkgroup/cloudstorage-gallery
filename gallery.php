<?php

require_once "utils.php";
global $config;
$config = include_once "conf.php";

$arubaStorage = getArubaStorage();
$bucketName = $config['bucketName'];

$files = $arubaStorage->getBucket($bucketName);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>My Gallery</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css">
		<link rel="stylesheet" href="lib/lightbox/css/lightbox.css">
		<script src="//cdn.jsdelivr.net/jquery/2.0.3/jquery-2.0.3.min.js"></script>
		<script src="//cdn.jsdelivr.net/bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<script src="lib/lightbox/js/lightbox-2.6.min.js"></script>
		<script type="text/javasctipt">
		$(function(){
			$('#myGallery').lightbox();
		});
		</script>
    </head>
    <body>
	
		<div class="container">
		
			<h1>My Gallery</h1>
			<br/>
	
			
			<?php if(count($files)>0): ?>
			
			<ul class="inline unstyles">
			<?php foreach($files as $file): 
				$path = generatePath($file['name']); 
			?>
				<li class="span2">
					<a href="<?php echo $path; ?>" data-lightbox="my-gallery">
						<img src="<?php echo $path; ?>" width="100" height="75" />
					</a>
				</li>
				
			<?php endforeach; ?>
			</ul>
			
			<?php else: ?>
			
			<h2>No images yet!</h2>
			
			<?php endif; ?>
			
			
			<a href="admin/list.php" class="btn btn-primary pull-right">Admin</a>
			
		</div>
		
		
		
	
	</body>
	
</html>