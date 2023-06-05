<?php

session_start();
if (!isset($_SESSION["email"])) {
   header("Location: /index.php/login");
   exit();
}

require "../model/database.php";

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

         echo json_encode(count($results) == 0 ? null : $results);
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
         echo json_encode(count($results) == 0 ? null : $results);
         break;

      case "patient":
         $query = "SELECT name, surname, doctor_email FROM patients
                  JOIN devices_users ON patients.id_device = devices_users.id_device
                  WHERE patients.id_device = :id_device AND devices_users.id_user = :id_user";
         $results = $_DB->execute($query, [
            "id_device" => $_GET["device"],
            "id_user" => $_SESSION["id"]
         ])->fetch();
         echo json_encode(count($results) == 0 ? null : $results);
         break;
   }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["action"])) {
   switch ($_POST["action"]) {
      case "set_threshold":
         if ($_SESSION["role_permission"] == 3) {
            $min = $_POST["min"];
            $max = $_POST["max"];
            $type = $_POST["type"];
            $id_device = $_POST["device"];
            $stmt = $_DB->execute("SELECT * FROM alert_threshold WHERE id_device = :id", [
               "id" => $id_device,
            ]);
            if ($stmt->rowCount() == 0) {
               $query = "INSERT INTO alert_threshold VALUES (:id_device, :type, :values)";
               $_DB->execute($query, [
                  "id_device" => $id_device,
                  "type" => $type,
                  "values" => $min . ":" . $max
               ]);
            } else {
               $query = "UPDATE alert_threshold set value = :values WHERE id_device = :id_device";
               $_DB->execute($query, [
                  "values" => $min . ":" . $max,
                  "id_device" => $id_device
               ]);
            }
         }
         break;
   }
}
?>