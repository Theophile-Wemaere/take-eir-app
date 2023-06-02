<?php

require "../database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reset_passwd"])) {
        $password = $_POST["password"];
        $token = $_POST["token"];
        $stmt = $_DB->execute("SELECT email, token FROM reset_passwd WHERE token = :token", ["token" => $token])->fetch();
        if ( isset($stmt) and $stmt["token"] == $token) {
            $email = $stmt["email"];
            // Generate hashed password using PASSWORD_ARGON2ID algorithm
            $options = [
                "memory_cost" => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                "time_cost" => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                "threads" => PASSWORD_ARGON2_DEFAULT_THREADS,
            ];
            $hashedPassword = password_hash(
                $password,
                PASSWORD_ARGON2ID,
                $options
            );

            $query = "UPDATE users SET password = :new_password WHERE email = :email";
            $results = $_DB
                ->execute($query, ["new_password" => $hashedPassword, "email" => $email]);
            $results = $_DB
                ->execute("DELETE FROM reset_passwd WHERE email = :email",["email" => $email]);
            echo "success";
        } else {
            echo "invalid_token";
        }
    }
}
?>
