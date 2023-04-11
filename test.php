<?php
  // Check if the "var" parameter is set in the URL
  if(isset($_GET['var'])) {
    // Get the value of the "var" parameter from the URL
    $var = $_GET['var'];

    // Print the value of the "var" parameter to the screen
    echo "The value of the 'var' parameter is: " . $var;
  } else {
    // If the "var" parameter is not set in the URL, print an error message
    echo "Use /test.php?var=something to input something ";
  }
?>

