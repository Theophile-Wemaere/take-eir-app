<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../database.php";
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
                break;

            case "edit_password":
                $password = $_POST["password"];
                $new_password = $_POST["new_password"];
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

        }
    }
} else {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "notification":
                $results = $_DB->execute("SELECT notification FROM users where id_user = :id", ["id" => $_SESSION["id"]])->fetch();
                echo $results["notification"];
                break;
        }
    }
}
?>
