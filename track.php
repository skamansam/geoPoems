<?php
  $myFile = "path.txt";
  $theData = array();
  if($_GET['lat'] && $_GET['lon'] && $_GET['t']){
    save_loc($_GET['t'],$_GET['lat'],$_GET['lon']);
  }
  
  function save_loc($time,$lat,$lon){
    $fh = fopen($myFile, 'w') or die("can't open file");
    fputcsv( $fh, array($time,$lat,$lon) );
    fclose($fh);
  }
  
  function get_locations(){
    $fh = fopen($myFile, 'r') or die("can't open file");
    $theData.push(fgetcsv($fh));
    fclose($fh);
    return $theData;
  }
?>