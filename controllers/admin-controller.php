<?php
session_start();
if (!isset($_SESSION["role_permission"]) || $_SESSION["role_permission"] < 6) {
    error_log("not allowed");
    header("Location: /");
    exit();
} else {
    require "../database.php";
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "delete":
                $_DB->execute("DELETE FROM tickets WHERE id_user = ?", [
                    $_POST["id_user"],
                ]);

                $_DB->execute("DELETE FROM users WHERE id_user = ?", [
                    $_POST["id_user"],
                ]);
                break;

            case "reset":
                // Generate hashed password using PASSWORD_ARGON2ID algorithm
                $options = [
                    "memory_cost" => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                    "time_cost" => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                    "threads" => PASSWORD_ARGON2_DEFAULT_THREADS,
                ];
                $hashedPassword = password_hash(
                    "take-eir",
                    PASSWORD_ARGON2ID,
                    $options
                );

                $_DB->execute(
                    "UPDATE users SET password = :hash WHERE id_user = :id",
                    [
                        "hash" => $hashedPassword,
                        "id" => $_POST["id_user"],
                    ]
                );
                break;

            case "delete_faq":
                $_DB->execute("DELETE FROM faq WHERE id_post = ?", [
                    $_POST["id_post"],
                ]);
                break;
        }
    } elseif (isset($_POST["search"])) {
        $_DB->execute("SET @search = :var", ["var" => "%{$_POST["search"]}%"]);
        $results = $_DB
            ->execute(
                "SELECT id_user, name, surname, email, created_at, gender, roles.role_name from users join roles on users.id_role = roles.id_role 
                WHERE name LIKE @search OR surname LIKE @search OR email LIKE @search OR gender LIKE @search OR roles.role_name LIKE @search ORDER BY created_at ASC"
            )
            ->fetchAll();
        echo json_encode(count($results) == 0 ? null : $results);
    } elseif (isset($_POST["create_faq"])) {
        $subject = $_POST["subject"];
        $body = $_POST["body"];
        $results = $_DB->execute("INSERT INTO faq (subject, body) VALUES(:subject, :body)", ["subject" => $subject, "body" => $body])->fetchAll();
        echo json_encode(count($results) == 0 ? null : $results);
    }
}
