<?php

  $whitelist = file(".whitelist", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $path = $_SERVER['PHP_SELF'];
  $filename = basename($path);
  
  if ($filename == "index.php") {
    require "vues/home.php";
  } else {
    if (in_array($filename, $whitelist, true)) {
      $name = $whitelist[array_search($filename, $whitelist, true)];
      require "vues/$name.php";
    } else {
      echo "stop trying to hack me pls";
    }
  }
?>

