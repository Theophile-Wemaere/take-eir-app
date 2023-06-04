<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "add_patient":
                $name = htmlspecialchars($_POST["name"]);
                $surname = htmlspecialchars($_POST["surname"]);
                $doctor_email = htmlspecialchars($_POST["doctor_email"]);
                $id_device = $_POST["id_device"];
                $id = md5($name . $surname . $doctor_email . $id_device . bin2hex(random_bytes(5)));

                $stmt = $_DB->execute("SELECT * FROM patients WHERE id_patient = :id", [
                    "id" => $id,
                ]);
                if ($stmt->rowCount() == 0) {
                    $_DB->execute(
                        "INSERT INTO patients VALUES (:id, :name, :surname, :doctor_email, :id_device)",
                        [
                            "id" => $id,
                            "name" => $name,
                            "surname" => $surname,
                            "doctor_email" => $doctor_email,
                            "id_device" => $id_device
                        ]
                    );
                    echo "success";
                } else {
                    echo "patient_exist";
                }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "devices":
                $is_doctor = $_SESSION["role_permission"] == "3" ? true : false;
                $query = "";
                if ($is_doctor) {
                    $query = "SELECT doctor_email, name, surname, id_device FROM patients
                            WHERE doctor_email = :id";
                } else {
                    $query = "SELECT patients.doctor_email, patients.name, patients.surname, patients.id_device FROM patients
                            JOIN devices_users ON patients.id_device = devices_users.id_device
                            WHERE devices_users.id_user = :id";
                }
                $results = $_DB->execute($query, 
                $is_doctor ? ["id" => $_SESSION["email"]] : ["id" => $_SESSION["id"]])->fetchAll();
                echo json_encode(count($results) == 0 ? null : $results);
                break;

            case "status":
                $is_doctor = $_SESSION["role_permission"] == "3" ? true : false;
                $query = "";
                if ($is_doctor) {
                    $query = "SELECT value from metrics 
                            JOIN patients ON metrics.id_device = patients.id_device
                            WHERE patients.doctor_email = :id AND metrics.matric_type = 1";
                } else {
                    $query = "SELECT value, entry_time from metrics 
                    JOIN devices_users ON metrics.id_device = devices_users.id_device
                    WHERE devices_users.id_user = :id AND metrics.metric_type = 1 ORDER BY entry_time DESC LIMIT 1";
                }
                $results = $_DB->execute($query, 
                $is_doctor ? ["id" => $_SESSION["email"]] : ["id" => $_SESSION["id"]])->fetch();
                echo json_encode(count($results) == 0 ? null : $results);
                break;
        }
    }
}

?>