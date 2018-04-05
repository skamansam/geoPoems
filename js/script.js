/* Author:

*/

$(document).ready(function(){
  $('.images .frames').hide();
  $('.images .frames').first().show();
  window.curFrame=0;
});

function nextFrame(id){
  //window.curFrame=window.curFrame+1;
  cur=$(id+' .images .frame:visible');
  $(cur).hide().next().show();
  //$('.images .frames:visible').next().show();
  //$('.images .frames').get(window.curFrame).show();
}

function toRad(deg){
  var pi = Math.PI;
  var de_ra = (deg*(pi/180));
  return de_ra;
}

function handleGPSError(positionError) {
  alert('Attempt to get location failed: ' + positionError.message);
}

function get_distance(lat1,lon1,lat2,lon2){
  var R = 6378100 ; // to_m : radius of the earth
  var dLat = toRad(lat2-lat1);  //latitudinal distance
  var dLon = toRad(lon2-lon1);  //longitudinal distance
  var lat1 = toRad(lat1);         //radian conversion of "center" latitude
  var lat2 = toRad(lat2);         //radian conversion of "center" longitude
  
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var distance = R * c;
  return {"a": a,"c":c,"distance":distance};
}

function updatePosition(geo) {
  lat = geo.coords.latitude;  //toFixed(8) is more "stable", but 5 is ~1m
  lon = geo.coords.longitude;
  linkstr = ''+lat.toFixed(5)+','+lon.toFixed(5);
  console.log(geo);
  var timeStr = new Date(geo.timestamp).toLocaleTimeString();
  //var timeStr = time.getHour()+':'+time.getMinute();
  proximity = [Math.abs(nextPos.lat - lat),Math.abs(nextPos.lon - lon)];
  if (window.lastTime && geo.timestamp.toMinute > window.lastTime.toMinute){
    $.get('track.php?lat='+lat+'&lon='+lon+'&t='+geo.timestamp+'',function(){alert('Data Sent')});
  }
  window.lastTime=geo.timestamp;
  
  haversine=get_distance(lat,lon,nextPos.lat,nextPos.lon);
  
  $('#proximity').html( proximity[0].toFixed(5)+' , '+proximity[1].toFixed(5)+
        '<br/>a: '+haversine.a+'<br/>c: '+haversine.c+'<br/>d: '+haversine.distance );
  $('.location').html(timeStr+': <a href="geo:'+linkstr+'">'+linkstr+'</a>');

}

