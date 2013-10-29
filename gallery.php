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
		<link rel="stylesheet" href="./style.css">
		<script src="//cdn.jsdelivr.net/jquery/2.0.3/jquery-2.0.3.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
		<script src="lib/lightbox/js/lightbox-2.6.min.js"></script>
		<script type="text/javasctipt">
		$(function(){
			$('#myGallery').lightbox();
		});
		</script>
    </head>
    <body>
	<div class="container">
		<h1>La mia Gallery Cloud!</h1><br/>
	
		<?php if(count($files)>0): ?>
			
			<div class="row-fluid text-center thumbnails">
			<?php foreach($files as $i=>$file): 
				$path = generatePath($file['name']); 
			?>
				<div class="span3">
					<a href="<?php echo $path; ?>" data-lightbox="my-gallery" title="<?php echo $i; ?>" >
						<img class="img-circle img-shadowed" src="<?php echo $path; ?>" title="<?php echo $i; ?>" alt="<?php echo $i; ?>"/>
					</a>
				</div>
				
			<?php endforeach; ?>
			</div>
			
		<?php else: ?>
			
			<h2>Non ci sono ancora immagini, caricane una...</h2>
			
		<?php endif; ?>
			
			
		<a href="admin/list.php" class="btn btn-primary pull-right">Amministrazione</a>
		
	</div>
    </body>
</html>
