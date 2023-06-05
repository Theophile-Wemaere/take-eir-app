<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../model/database.php";
$admin = false;
if ($_SESSION["role_permission"] == 6) {
    $admin = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {

        switch ($_POST["action"]) {

            case "edit_email":
                $email = $_POST["email"];
                $new_email = htmlspecialchars($_POST["new_email"]);
                $regex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
                if (preg_match($regex, $new_email)) {
                    $stmt = $_DB->execute(
                        "SELECT * FROM users WHERE email = :email",
                        ["email" => $new_email]
                    );
                    if ($stmt->rowCount() > 0) {
                        echo 'mail_exist';
                    } else {
                        $query = "UPDATE users SET email = :new_email WHERE email = :email";
                        if (!$admin) {
                            $query = $query . " AND id_user = :id";
                        }
                        $results = $_DB
                            ->execute(
                                $query, $admin ?
                                ["new_email" => $new_email, "email" => $email] :
                                ["new_email" => $new_email, "email" => $email, "id" => $_SESSION["id"]]
                            )->fetchAll();
                        if (count($results) == 0) {
                            $_SESSION["email"] = $new_email;
                        }
                        echo "success";
                    }
                }
                break;

            case "edit_password":
                $password = $_POST["password"];
                $new_password = $_POST["new_password"];
                $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
                if (preg_match($regex, $new_password)) {
                    $stmt = $_DB->execute("SELECT password FROM users WHERE id_user = :id", ["id" => $_SESSION["id"]])->fetch();
                    if (!password_verify($password, $stmt["password"])) {
                        echo 'bad_password';
                    } else {
                        // Generate hashed password using PASSWORD_ARGON2ID algorithm
                        $options = [
                            "memory_cost" => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                            "time_cost" => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                            "threads" => PASSWORD_ARGON2_DEFAULT_THREADS,
                        ];
                        $hashedPassword = password_hash(
                            $new_password,
                            PASSWORD_ARGON2ID,
                            $options
                        );

                        $query = "UPDATE users SET password = :new_password WHERE id_user = :id";
                        $results = $_DB
                            ->execute($query, ["new_password" => $hashedPassword, "id" => $_SESSION["id"]])->fetchAll();
                        echo "success";
                    }
                }
                break;

            case "update_notif":
                $notif = "";
                switch ($_POST["notif"]) {
                    case "N":
                        $notif = "N";
                        break;
                    case "Y":
                        $notif = "Y";
                        break;
                    default:
                        $notif = "Y";
                        break;
                }
                $results = $_DB->execute(
                    "UPDATE users SET notification = :notif WHERE id_user = :id",
                    [
                        "notif" => $notif,
                        "id" => $_SESSION["id"]
                    ]
                );
                echo "success";
                break;

            case "delete_user":
                $password = $_POST["password"];
                $reason = htmlspecialchars($_POST["reason"]);
                $stmt = $_DB->execute("SELECT password FROM users WHERE id_user = :id", ["id" => $_SESSION["id"]])->fetch();
                if (!password_verify($password, $stmt["password"])) {
                    echo 'bad_password';
                } else {
                    $_DB->delete_user($_SESSION["id"]);
                    $results = $_DB->execute("INSERT INTO deleted_users VALUES (:reason)", ["reason" => $reason]);
                    echo "success";
                }
                break;

            case "update_profil":
                $role = null;
                switch ($_POST["role"]) {
                    case "famille":
                        $role = 3;
                        break;
                    case "medecin":
                        $role = 2;
                        break;
                    default:
                        $role = $_SESSION["id_role"];
                        break;
                }
                $gender = null;
                switch ($_POST["gender"]) {
                    case "M":
                        $gender = "M";
                        break;
                    case "F":
                        $gender = "F";
                        break;
                    default:
                        $gender = "X";
                        break;
                }
                $name = htmlspecialchars($_POST["name"]);
                $surname = htmlspecialchars($_POST["surname"]);

                $query = "UPDATE users SET name = :name, surname = :surname, gender = :gender, id_role = :role 
                    WHERE id_user = :id";
                $_DB->execute(
                    $query,
                    [
                        "name" => $name,
                        "surname" => $surname,
                        "gender" => $gender,
                        "role" => $role,
                        "id" => $_SESSION["id"]
                    ]
                );

                $result = $_DB->execute(
                    "SELECT role_name, role_permission FROM roles WHERE id_role = :role",
                    ["role" => $role]
                )->fetch();
                $_SESSION["name"] = $name;
                $_SESSION["surname"] = $surname;
                $_SESSION["role_name"] = $result["role_name"];
                $_SESSION["role_permission"] = $result["role_permission"];

                if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
                    error_log("uploading picture");
                    $file_path = $_SERVER['DOCUMENT_ROOT'] . "/views/uploads/" . $_SESSION["id"] . ".png";

                    $allowed_types = array("image/jpeg", "image/png", "image/gif");

                    if (in_array($_FILES["picture"]["type"], $allowed_types)) {
                        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $file_path)) {
                            echo "success";
                        } else {
                            echo "error_upload";
                        }
                    } else {
                        echo "error_file";
                    }
                } else {
                    echo "success";
                }
        }
    }
} else {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "notification":
                $results = $_DB->execute("SELECT notification FROM users where id_user = :id", ["id" => $_SESSION["id"]])->fetch();
                echo $results["notification"];
                break;

            case "profil":
                $results = $_DB
                    ->execute(
                        "SELECT gender, name, surname, roles.role_name FROM users JOIN roles on users.id_role = roles.id_role WHERE id_user = :id",
                        ["id" => $_SESSION["id"]]
                    )->fetch();
                echo json_encode(count($results) == 0 ? null : $results);
                break;

            case "picture":
                $filename = $_SERVER['DOCUMENT_ROOT'] . "/views/uploads/" . $_SESSION["id"] . ".png";
                $file_path = null;
                if (file_exists($filename)) {
                    $file_path = $filename;
                } else {
                    $file_path = $_SERVER['DOCUMENT_ROOT'] . "/views/uploads/default.png";
                }
                header('Content-Type: image/jpeg');
                readfile($file_path);
        }
    }
}
?>