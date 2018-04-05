<?php

class AMFDirectoryReader{
	

// note: path must be relative to this script or absolute to the server root  //	
	public function __construct()
	{
		require_once '../../php/gmaps-gps-images/ExifReader.php';
	}	
	
	public function getEXIFImageData($args)
	{
		$target = $args[0];
		$params = explode(',', $args[1]);
		
		$exif = new ExifReader();
		if (is_file($target)) return $exif->readImage($target, $params);		
		if (is_dir($target)) return $exif->readDirectory($target, $params);
	
		return array('ERROR: Target Does Not Exist');
	}
	
}

?>