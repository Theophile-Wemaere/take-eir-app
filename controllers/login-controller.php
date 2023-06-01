<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
require "../database.php";
// Get the email and password from the form
$email = $_POST["email"];
$password = $_POST["password"];
$stmt = $_DB->execute(
    "SELECT id_user, password, surname, name, roles.role_name, roles.role_permission FROM users JOIN roles on users.id_role = roles.id_role WHERE email = :email",
    ["email" => $email]
);
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $password_hash = $row["password"];
    if (password_verify($password, $password_hash)) {
        session_start();
        $_SESSION["name"] = $row["name"];
        $_SESSION["surname"] = $row["surname"];
        $_SESSION["email"] = $email;
        $_SESSION["role_name"] = $row["role_name"];
        $_SESSION["role_permission"] = $row["role_permission"];
        $_SESSION["id"] = $row["id_user"];

        if ($_SESSION["role_permission"] == 6) {
            echo 'redirect_admin';
        } else {
            echo 'redirect_user';
        }
    } else {
        echo 'bad_passwd';
    }
} else {
    echo "bad_credentials";
}
} ?>

