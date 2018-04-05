<!doctype html> <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
    More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Love in Baltimore</title>
    <meta name="description" content=""/>

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width"/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/vday.min.css"/>

    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

    <!-- All JavaScript at the bottom, except this Modernizr build.
    Modernizr enables HTML5 elements & feature detects for optimal performance.
    Create your own custom Modernizr build: www.modernizr.com/download/ -->
    <script src="js/libs/modernizr-2.0.6.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/libs/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/libs/jquery.mobile.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/geo.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/geo_position_js_simulator.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/plugins.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/script.js" type="text/javascript" charset="utf-8"></script>

    <script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

  </head>
  <body>
    <div role="main" data-role="page">
      <div data-role="header">
        <h1>Love in Baltimore</h1>
      </div>

      <div data-role="content" data-title="Introduction" style="padding-left:2em;">
        <p>
          I know you seem lost,
          <br/>
          Without friends in this place.
          <br/>
          Searching to find a host
          <br/>
          Of old feelings and new grace.
          <br/>
          I hope you find love the most,
          <br/>
          With this app as your base.
        </p>
        <p>
          Please make sure you have GPS,
          <br/>
          Enabled and in use,
          <br/>
          As I will link with Google Maps,
          <br/>
          But I will not abuse
          <br/>
          Your privacy, except in part,
          <br/>
          As I will be tracking you
          <br/>
          On your journey when you start.
        </p>
        <p>
          To begin your search,
          <br/>
          Just click on the Start,
          <br/>
          And together we can find
          <br/>
          Our most beautiful heart.
        </p>
        <a href=""/>Start</a>
      </div>
    </div><!-- // page 1: intro-->


      <?php
          //include 'lib/storage.php';
          include 'lib/ExifReader.php';
          
          $dataReader = new ExifReader();
          
          $titles = array("Love in the Park","Love and Commerce","Love at the Beach", "Love is in the Hearth");
          $images = array(
          array("img/IMAG0179","img/IMAG0178"),
          array("img/IMAG0180","img/IMAG0181","img/IMAG0183","img/IMAG0184","img/IMAG0185"),
          array("img/IMAG0186","img/IMAG0187","img/IMAG0188")
          );
          
          for ($i = 0; $i < count($titles); $i++) { ?>
            <div data-role="page">
              <div data-role="header">
                <h1><?php print $titles[$i]?></h1>
              </div>
        
              <div data-role="content" data-title="Love and War" style="padding-left:2em;">
                <?php
                foreach ($images[$i] as $img){
                  $file="$img.jpg";
                  $geo = $dataReader->getGPS($file);
                  $lat=$geo[0];
                  $long=$geo[1]; ?>
                  <img src='<?php print $file?>' style='width:50%;'/><br/>
                  <a href="geo: <?php print "$lat,$long"?>">Open in Maps</a>
                  <?php 
                } ?>
              </div>
          <?php 
        } ?>
    </div>
  </body>
</html>