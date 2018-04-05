<?php

/**
 *	CLASS : ExifReader
 *  VERSION : 1.0 
 *  DATE : 01/10/2010
 *  PHP MIN REQUIREMENT : 4.2.0  
 *  AUTHOR : Stephen Braitsch : stephen@quietless.com
 *  DESCRIPTION : Class to extract the EXIF data from a .jpg
**/

class ExifReader{
	
	public function __construct() { }
		
/**
 * Returns an array of EXIF data objecta for all jpgs in the target directory 
**/	
	public function readDirectory($dir, $props)
	{
	// $dir points to this directory from amfphp //	
		$files = scandir($dir);
		$images = array();
	// loop over the files array and look for images	
		for ($i=0; $i < count($files); $i++) { 
			if (stristr($files[$i], '.jpg')){
			// if the jpeg has gps data add it to the images array //	
				$img = $this->readImage($dir.'/'.$files[$i], $props);
				if ($img) array_push($images, $img);
			}
		}
		return $images;		
	}

/**
 * Returns the EXIF data object of a single image 
**/	
	public function readImage($image, $props)
	{
		$exif = exif_read_data($image, 0, true);		
		if ($exif){
			$data = array();
			$data['name'] = $exif['FILE']['FileName']; 
			foreach($props as $val)
			{				
			// return an array [lat, lng] //		
			 	if ($val=='gps') $data['gps'] = $this->getGPS($image);
			// return date value in milliseconds //
				if ($val=='gps') $data['date'] = $exif['FILE']['FileDateTime']*1000;
			// return size in kilobytes //		
				if ($val=='gps') $data['size'] = floor(($exif['FILE']['FileSize'] / 1024 * 10 )/10)."KB"; 				
			}	
			return $data;
		}	else{
			return null;
		}			
	}
	
/**
 * Returns GPS latitude & longitude as decimal values 
**/	
	public function getGPS($image)
	{
		if(!file_exists($image)){
			return array("$image has no data.","$img has no data");
		}
		$exif = exif_read_data($image, 0, true);		
		if ($exif){
			$lat = $exif['GPS']['GPSLatitude'];
			$log = $exif['GPS']['GPSLongitude'];	
			if (!$lat || !$log) return null;
		// latitude values //
			$lat_degrees = $this->divide($lat[0]);
			$lat_minutes = $this->divide($lat[1]);
			$lat_seconds = $this->divide($lat[2]);
			$lat_hemi = $exif['GPS']['GPSLatitudeRef'];	
	
		// longitude values //
			$log_degrees = $this->divide($log[0]);
			$log_minutes = $this->divide($log[1]);
			$log_seconds = $this->divide($log[2]);	
			$log_hemi = $exif['GPS']['GPSLongitudeRef'];
			
			$lat_decimal = $this->toDecimal($lat_degrees, $lat_minutes, $lat_seconds, $lat_hemi);
			$log_decimal = $this->toDecimal($log_degrees, $log_minutes, $log_seconds, $log_hemi);
			
			return array($lat_decimal, $log_decimal);	
		}	else{
			return null;
		}
	}
	
	private  function toDecimal($deg, $min, $sec, $hemi)
	{
		$d = $deg + $min/60 + $sec/3600;
		return ($hemi=='S' || $hemi=='W') ? $d*=-1 : $d;
	}	
	
	private function divide($a)
	{
	// evaluate the string fraction and return a float //	
		$e = explode('/', $a);
	// prevent division by zero //
		if (!$e[0] || !$e[1]) {
			return 0;
		}	else{
			return $e[0] / $e[1];	
		}
	}
	
/**
 * Print all the EXIF metadata associated with an image 
**/		
	public function printEXIF($image)
	{
		foreach ($exif as $key => $section) 
		{
	    	foreach ($section as $name => $val) 
			{
	        	echo "$key.$name: $val<br />\n";
	    	}
		}		
	}
	
}

?>
