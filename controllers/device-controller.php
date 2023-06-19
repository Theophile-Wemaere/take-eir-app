<?php
session_start();
if (!isset($_GET["token"])) {
    if (!isset($_SESSION["email"])) {
        header("Location: /index.php/login");
        exit();
    }

    require "../model/database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["action"])) {
            switch ($_POST["action"]) {
                case "update_patient":
                    $name = htmlspecialchars($_POST["name"]);
                    $surname = htmlspecialchars($_POST["surname"]);
                    $doctor_email = htmlspecialchars($_POST["doctor_email"]);
                    $regex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
                    if (preg_match($regex, $doctor_email)) {
                        $id_device = $_POST["id_device"];
                        $_DB->execute(
                            "UPDATE patients 
                    JOIN devices_users ON patients.id_device = devices_users.id_device
                    SET patients.name = :name, patients.surname = :surname, patients.doctor_email = :doctor_email
                    WHERE patients.id_device = :id_device AND devices_users.id_user = :id_user",
                            [
                                "name" => $name,
                                "surname" => $surname,
                                "doctor_email" => $doctor_email,
                                "id_device" => $id_device,
                                "id_user" => $_SESSION["id"]
                            ]
                        );
                        echo "success";
                    }
                    break;

                case "add_key":
                    $key = $_POST["key"];
                    $stmt = $_DB->execute("SELECT * FROM devices_users WHERE id_device = :id AND id_user = :id_user", [
                        "id" => $key,
                        "id_user" => $_SESSION["id"]
                    ]);
                    if ($stmt->rowCount() == 0) {

                        $stmt = $_DB->execute("SELECT * FROM devices_users WHERE id_device = :id", [
                            "id" => $key,
                        ]);

                        $credentials = file_get_contents('../.credentials');
                        $dictionary = json_decode($credentials, true);
                        if ($stmt->rowCount() == 0 or $dictionary["email_username"] == "") { // no user use this device yet or no mail 
                            $_DB->execute("UPDATE devices SET email = :email WHERE id_device = :id", [
                                //"email" => $_SESSION["email"],
                                "email" => $_SESSION["contact.healtheir@gmail.com"],
                                "id" => $key
                            ]);
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
                                $name = "nom";
                                $surname = "prenom";
                                $doctor_email = "email medecin";
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

                                $_DB->execute(
                                    "INSERT INTO alert_threshold VALUES (:id_device,1,'60:100')",
                                    [
                                        "id_device" => $key
                                    ]
                                );
                                echo "success";
                            }
                        } else {
                            echo "to_confirm";
                        }
                    }
                    break;

                case "delete_device":
                    $id_device = $_POST['id_device'];
                    $id_user = $_SESSION['id'];
                    $query = "DELETE FROM devices_users WHERE id_device = :id_device AND id_user = :id_user";
                    $_DB->execute($query, ["id_device" => $id_device, "id_user" => $id_user]);

                    // check if the device is still associated with an account
                    $stmt = $_DB->execute("SELECT * FROM devices_users WHERE id_device = :id", [
                        "id" => $id_device,
                    ]);
                    if ($stmt->rowCount() == 0) {
                        // if no the delete the patient and all metrics
                        $_DB->execute("DELETE FROM patients WHERE id_device = :id_device", ["id_device" => $id_device]);
                        $_DB->execute("DELETE FROM metrics WHERE id_device = :id_device", ["id_device" => $id_device]);
                        $_DB->execute("DELETE FROM alert_threshold WHERE id_device = :id_device", ["id_device" => $id_device]);
                    }
                    break;
            }
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["action"])) {
            switch ($_GET["action"]) {
                case "devices":
                    if ($_GET["search"] == "") {
                        $query = "SELECT patients.doctor_email, patients.name, patients.surname, patients.id_device FROM patients
                            JOIN devices_users ON patients.id_device = devices_users.id_device
                            WHERE devices_users.id_user = :id";

                        $results = $_DB->execute(
                            $query,
                            ["id" => $_SESSION["id"]]
                        )->fetchAll();
                        echo json_encode(count($results) == 0 ? null : $results);
                    } else {
                        $_DB->execute("SET @search = :var", ["var" => "%{$_GET["search"]}%"]);
                        $query = "SELECT patients.doctor_email, patients.name, patients.surname, patients.id_device FROM patients
                            JOIN devices_users ON patients.id_device = devices_users.id_device
                            WHERE devices_users.id_user = :id 
                            AND (patients.doctor_email LIKE @search 
                            OR patients.name LIKE @search 
                            OR patients.surname LIKE @search 
                            OR patients.id_device LIKE @search)";
                        $results = $_DB->execute(
                            $query,
                            ["id" => $_SESSION["id"]]
                        )->fetchAll();
                        echo json_encode(count($results) == 0 ? null : $results);
                    }
                    break;

                case "status":
                    $query = "SELECT value, entry_time from metrics
                            JOIN devices_users ON metrics.id_device = devices_users.id_device
                            WHERE devices_users.id_user = :id AND metrics.id_device = :id_device AND metrics.metric_type = 1 ORDER BY entry_time DESC LIMIT 1";
                    $results = $_DB->execute(
                        $query,
                        [
                            "id" => $_SESSION["id"],
                            "id_device" => $_GET["device"]
                        ]
                    )->fetch();
                    echo json_encode(count($results) == 0 ? null : $results);
                    break;
            }
        }
    }
} else {
    require "../model/database.php";
    $token = $_GET["token"];
    $stmt = $_DB->execute("SELECT * FROM confirm_device WHERE token = :token", ["token" => $token])->fetch();
    if (isset($stmt) and $stmt["token"] == $token) { // token is valid, we can add the user
        $_DB->execute(
            "INSERT INTO devices_users VALUES(:id,:id_user,:id_device)",
            [
                "id" => md5($stmt["id_device"] . $stmt["id_user"]),
                "id_user" => $stmt["id_user"],
                "id_device" => $stmt["id_device"]
            ]
        );
        $_DB->execute("DELETE FROM confirm_device WHERE token = :token", ["token" => $token]);
    }
    header("Location: /index.php/login");
}
?>