<?php

require_once "lib/S3.php";

S3::$useExceptions = true;

/*
 * Ritorna una istanza della Libreria S3 correttamente istanziata 
 * per accedere al servizio di object storage di Aruba cloud  
 */
function getArubaStorage() {
	global $config;
	return new S3($config['accessKey'], $config['secretKey'], false, $config['accessPoint']);
}

/*
 * La funzione controlla l'esistenza di un determinato file sul 
 * bucket specificato nel file di configurazione 
 */
function checkFileExists($URI){
	global $config;
	$arubaStorage = getArubaStorage();
	return $arubaStorage->getObject($config['bucketName'], $URI) ? true : false;

}

/*
 * La funzione genera un URL pubblico per raggiungere un file
 * archiviato sul proprio bucket
 */
function generatePath($URI){
	global $config;
	return "http://" . implode("/", array($config['accessPoint'], $config['bucketName'], $URI));
}
