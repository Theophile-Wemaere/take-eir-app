<?php
session_start();
//ini_set('display_errors', '0');

$whitelist = file(".whitelist", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$whitelist = array_filter($whitelist, function($line) {
    return strpos($line, '#') !== 0;
});
  $path = $_SERVER['PHP_SELF'];
$filename = basename($path);
  if ($filename == "index.php") {
    require "views/home.php";
  } else {
    if (in_array($filename, $whitelist, true)) {
      $name = $whitelist[array_search($filename, $whitelist, true)];
      if (strpos($name,"settings") !== false) {
        require "views/settings/$name.php";
      } elseif (strpos($name,"admin") !== false) {
        require "views/admin/$name.php";
      } else {
        require "views/$name.php";
      }
    } else {
      require "views/404.php";
    }
  }
?>