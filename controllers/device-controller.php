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
            case "set_patient":
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
                break;

            case "add_key":
                $key = $_POST["key"];
                $_DB->execute(
                    "INSERT INTO devices_users VALUES(:id,:id_user,:id_device)",
                    [
                        "id" => md5($key . $_SESSION["id"]),
                        "id_user" => $_SESSION["id"],
                        "id_device" => $key
                    ]
                );
                $stmt = $_DB->execute("SELECT * FROM patients WHERE id_device = :id", [
                    "id" => $key,
                ]);
                if ($stmt->rowCount() == 0) {
                    $name = $_SESSION["name"];
                    $surname = $_SESSION["surname"];
                    $doctor_email = $_SESSION["email"];
                    $id = md5($name . $surname . $doctor_email . $id_device . bin2hex(random_bytes(5)));
                    $_DB->execute(
                        "INSERT INTO patients VALUES (:id, :name, :surname, :doctor_email, :id_device)",
                        [
                            "id" => $id,
                            "name" => $name,
                            "surname" => $surname,
                            "doctor_email" => $doctor_email,
                            "id_device" => $key
                        ]
                    );
                    echo "success";
                }


                echo "success";
                break;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "devices":
                $query = "SELECT patients.doctor_email, patients.name, patients.surname, patients.id_device FROM patients
                        JOIN devices_users ON patients.id_device = devices_users.id_device
                        WHERE devices_users.id_user = :id";
                $results = $_DB->execute(
                    $query,
                    ["id" => $_SESSION["id"]]
                )->fetchAll();
                echo json_encode(count($results) == 0 ? null : $results);
                break;

            case "status":
                $query = "SELECT value, entry_time from metrics
                            JOIN devices_users ON metrics.id_device = devices_users.id_device
                            WHERE devices_users.id_user = :id AND metrics.id_device = :id_device AND metrics.metric_type = 1 ORDER BY entry_time DESC LIMIT 1";
                $results = $_DB->execute(
                    $query,
                    ["id" => $_SESSION["id"],
                     "id_device" => $_GET["device"]]
                )->fetch();
                echo json_encode(count($results) == 0 ? null : $results);
                break;
        }
    }
}

?>