<?php

session_start();
if (!isset($_SESSION["email"])) {
   header("Location: /index.php/login");
   exit();
}

require "../database.php";

if (isset($_SERVER["REQUEST_METHOD"]) == "GET" and isset($_GET["action"])) {
   switch ($_GET["action"]) {
      case "metrics":
         $query = "SELECT metric_type, entry_time, value
         FROM metrics
         JOIN devices_users ON metrics.id_device = devices_users.id_device
         WHERE metrics.id_device = :id_device AND devices_users.id_user = :id_user";
         $results = $_DB->execute(
            $query,
            [
               "id_device" => $_GET["device"],
               "id_user" => $_SESSION["id"]
            ]
         )->fetchAll();

         echo json_encode($results);
         break;

      case "threshold":
         $query = "SELECT value, metric_type 
         FROM alert_threshold
         JOIN devices_users ON alert_threshold.id_device = devices_users.id_device
         WHERE alert_threshold.id_device = :id_device AND devices_users.id_user = :id_user";
         $results = $_DB->execute($query, [
            "id_device" => $_GET["device"],
            "id_user" => $_SESSION["id"]
         ])->fetchAll();
         echo json_encode($results);
         break;
   }
}
?>
