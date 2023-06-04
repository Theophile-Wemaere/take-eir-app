<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../database.php";
    $role = null;
    switch ($_POST["role"]) {
        case "famille":
            $role = 3;
            break;
        case "medecin":
            $role = 2;
            break;
        default:
            $role = 3;
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
    $email = htmlspecialchars($_POST["email"]);
    $id = md5($email);
    $password = $_POST["password"];

    $stmt = $_DB->execute("SELECT * FROM users WHERE id_user = :id", [
        "id" => $id,
    ]);
    if ($stmt->rowCount() > 0) {
        echo 'mail_exist';
    } else {
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

        // Prepare and execute the query to insert the new user into the database
        $sql =
            "INSERT INTO users (id_user, name, surname, email, password, id_role, gender) VALUES (:id,:name, :surname, :email, :password, :role, :gender)";
        $stmt = $_DB->execute($sql, [
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "password" => $hashedPassword,
            "role" => $role,
            "gender" => $gender,
        ]);

        // Check if the insert was successful
        if ($stmt->rowCount() > 0) {
            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["surname"] = $surname;
            $_SESSION["email"] = $email;
            $row = $_DB
                ->execute(
                    "SELECT role_name,role_permission from roles where id_role = :id",
                    [
                        "id" => $role,
                    ]
                )
                ->fetch();
            $_SESSION["id_role"] = $role;
            $_SESSION["role_name"] = $row["role_name"];
            $_SESSION["role_permission"] = $row["role_permission"];
            $_SESSION["id"] = $id;
            echo 'redirect_user';
        } else {
            echo 'error_creation';
        }
    }
} ?>