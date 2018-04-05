<?php
  include 'lib/get_page.php';
  $url_map = array(
      "war"=>array("img/LoveIsWar/","Love is War","war"),
      "you"=>array("img/LoveIsFree/","Love is Free","free"),
      "art"=>array("img/LoveIsArt/","Love is Art","art"),
      "free"=>array("img/LoveIsFree/","Love is Free","free")
  );
  $params=$url_map[$_GET["section"]];
  get_page($params[0],$params[1],$params[2]);
?>