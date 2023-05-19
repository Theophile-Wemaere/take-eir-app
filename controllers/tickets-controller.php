<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["create_ticket"])) {
        $tag = null;
        switch($_POST["tag"]) {
            case 1:
                $tag = 1;
                break;
            case 2:
                $tag = 2;
                break;
            case 3:
                $tag = 3;
                break;
            default:
                $tag = 4;
                break;
        }
        $subject = $_POST["subject"];
        $body = $_POST["body"];
        $results = $_DB
            ->execute(
                "INSERT INTO tickets (id_user, state,id_tag, subject, body) 
                VALUES(:id, 'OPEN', :tag, :subject, :body)", 
                [
                    "id" => md5($_SESSION["email"]),
                    "tag" => $tag,
                    "subject" => $subject, 
                    "body" => $body
                ])->fetchAll();
        echo json_encode(count($results) == 0 ? null : $results);
    }
} else {
    if(isset($_GET["action"])) {
        switch($_GET["action"]) {
        case "tag":
            $results = $_DB->execute("SELECT * from tags")->fetchAll();
            echo json_encode(count($results) == 0 ? null : $results);
            break;
        case "tickets":
            $id_user = md5($_SESSION["email"]);
            $results = $_DB->execute(
                "SELECT * from tickets where id_user = :id", 
                ["id" => $id_user])
                           ->fetchAll();
            echo json_encode(count($results) == 0 ? null : $results);
        }
    }
}
?>
