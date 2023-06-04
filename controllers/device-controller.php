<?php
/*
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}*/

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
}

?>
