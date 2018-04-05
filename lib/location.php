<?php
class location
	function from_image(image_location){}
	function is_close(x1,y1,x2,y2,resolution, closeness){
		dx = x2-x1;
		dy = y2-y1;
		distance = sqrt( (dx^2) + (dy^2));
		percent = disatnce/resolution;
		return percent <= closeness
	}

}
?>