<?php
require "database.php";

$results = $_DB->execute(
    "SELECT id_user, name, surname, email, created_at, roles.role_name from users join roles on users.id_role = roles.id_role WHERE surname LIKE ?",
    ["%{$_POST["search"]}%"]
)->fetchAll();

echo json_encode(count($results) == 0 ? null : $results);
