<?php 
require "database.php";
$results = $_DB->execute("SELECT * from faq")->fetchAll();
echo json_encode(count($results) == 0 ? null : $results);
?>
