<?php
session_start();
//ini_set('display_errors', '0');

$whitelist = file(".whitelist", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$whitelist = array_filter($whitelist, function ($line) {
  return strpos($line, '#') !== 0;
});
$path = $_SERVER['PHP_SELF'];
$filename = basename($path);
$language = "";
if (isset($_SESSION["language"]) and $_SESSION["language"] == "EN") {
  $language = "EN";
} else {
  $language = "FR";
}

$previous = basename($_SERVER['HTTP_REFERER']);
error_log($previous);

if ($filename == "index.php") {
  require "views/$language/home.php";
} else {
  if (in_array($filename, $whitelist, true)) {
    $name = $whitelist[array_search($filename, $whitelist, true)];
    if (strpos($name, "settings") !== false) {
      require "views/$language/settings/$name.php";
    } elseif (strpos($name, "admin") !== false) {
      require "views/$language/admin/$name.php";
    } elseif ($name == "EN") {
      $_SESSION["language"] = "EN";
      require "views/EN/home.php";
    } elseif ($name == "FR") {
      $_SESSION["language"] = "FR";
      require "views/FR/home.php";
    } else {
      require "views/$language/$name.php";
    }
  } else {
    require "views/$language/404.php";
  }
}
