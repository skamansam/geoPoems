<?php 
include 'ExifReader.php';

function get_page($folder,$title,$id) {
	print  <<< _EOF
		<div data-role="page" id="$id" data-add-back-btn="true">
		  <div data-role="header">
			<h1> $title </h1>
			<a href="/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
		  </div>
		
		  <div data-role="content" data-title="$title" style="padding-left:2em;">
		    <div class="images">
_EOF;
	$reader = new ExifReader();
	$dh  = opendir($folder);
	while (false !== ($img = readdir($dh))) {
	  if($img != "." && $img != ".."){
  		$imgPath="$folder".$img;
  		#print $img;
  		print "<div class='frame'><img src=\"$imgPath\" alt=\"/../$imgPath\" style='width:90%;'/>";
  		$geo = $reader->getGPS(realpath("$imgPath"));
  		$lat=$geo[0];$long=$geo[1];
      print "<a href='#' onclick='nextFrame()' data-role='button'>Next Image</a><br/>";
  		print "<a href=\"geo: $lat,$long\" data-role='button'>Navigate To Next</a></div>";
    }
	}
	
	print  <<< _EOF
	     </div>
		  </div><!-- /content $id-->
		  <div data-role="footer">
			<h6 class='location'> No Location Available </h6>
		  </div>
		  <script>
		    $('.images .frame').hide();
        $('.images .frame').first().show();
        window.curFrame=0;
		  </script>
		</div> <!-- /page $id-->
_EOF;
	#return $ret;
}
?>