<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../database.php";

if (isset($_SERVER["REQUEST_METHOD"]) == "GET" and isset($_GET["device"])) {

    $query = "
   SELECT metrics_type, entry_time, value FROM metrics
   ";
    $result = $conn->query($query);

    $device = $

    echo json_encode($data);
}
?>