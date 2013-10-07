<?php

require_once "lib/S3.php";

S3::$useExceptions = true;

function getArubaStorage() {
	global $config;
	return new S3($config['accessKey'], $config['secretKey'], false, $config['accessPoint']);
}


function checkFileExists($URI){
	global $config;
	$arubaStorage = getArubaStorage();
	return $arubaStorage->getObject($config['bucketName'], $URI) ? true : false;

}

function generatePath($URI){
	global $config;
	return "http://" . implode("/", array($config['accessPoint'], $config['bucketName'], $URI));
}