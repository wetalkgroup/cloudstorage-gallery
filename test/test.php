<?php 

//https://github.com/tpyo/amazon-s3-php-class
require_once "./S3.php";

$awsAccessKey = "test-hostingtalk";
$awsSecretKey = "AlexArubaTest";
$ap = "r1-it.storage.cloud.it";
$bucketName = "hostingtalk-foto";
$fileURI = "2013/10/logo-ht.png";
//http://r1-it.storage.cloud.it/hostingtalk-foto/2013/10/logo-ht.png

$arubaStorage = new S3($awsAccessKey, $awsSecretKey, false, $ap);

$arubaStorage->setExceptions(true);

try{
	
	$buckets = $arubaStorage->listBuckets(true);
	if(empty($buckets['buckets'])){
		
		$arubaStorage->putBucket($bucketName); //this should be unique in the region!
		$buckets = $arubaStorage->listBuckets(true);
		
	}
	
	$arubaStorage->putObjectFile("hostingtalk.png", $bucketName, $fileURI, S3::ACL_PUBLIC_READ);
	
	$files = $arubaStorage->getBucket($bucketName);
		
	print_r($files);
	
	$file = $arubaStorage->getObject($bucketName, $fileURI);
	
	
	/*if($arubaStorage->deleteObject($bucketName, $fileURI)){
		echo("OK\n");
	}else{
		echo("KO\n");
	}
	
	$files = $arubaStorage->getBucket($bucketName);
	print_r($files);
	*/
	
	/*
	header('Last-Modified: '.gmdate('D, d M Y H:i:s', $file->headers['date']).' GMT', true, 200);
    header('Content-Length: '.$file->headers['size']);
    header('Content-Type: ' . $file->headers['type']);
	die($file->body);
	*/

}catch(Exception $e){
	die($e->getMessage());
}


die("Finished.");