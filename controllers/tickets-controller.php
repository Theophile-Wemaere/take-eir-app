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
        $body = base64_encode($_POST["body"]);
        $results = $_DB
            ->execute(
                "INSERT INTO tickets (id_user, state,id_tag, subject, body) 
                VALUES(:id, 'OPEN', :tag, :subject, :body)", 
                [
                    "id" => md5($_SESSION["email"]),
                    "tag" => $tag,
                    "subject" => $subject, 
                    "body" => "you[" . $body . "]"
                ])->fetchAll();
        echo json_encode(count($results) == 0 ? null : $results);
    } elseif(isset($_POST["edit_ticket"])) {
        $message = base64_encode($_POST["message"]);
        $ticket_id = $_POST["id"];
        $results = $_DB->execute(
                    "UPDATE tickets SET body = CONCAT(body, :message) WHERE tickets_id = :ticket_id AND id_user = :id_user", 
                    [
                        "message" => "you[" . $message . "]",
                        "ticket_id" => $ticket_id,
                        "id_user" => md5($_SESSION["email"])
                    ])->fetch();

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
            $results = $_DB->execute(
                "SELECT tickets.*, tags.tag_name
                FROM tickets
                JOIN tags ON tickets.id_tag = tags.id_tag WHERE tickets.id_user = :id", 
                ["id" => md5($_SESSION["email"])
                ])->fetchAll();
            echo json_encode(count($results) == 0 ? null : $results);
            break;
        case "conv":
            $results = $_DB->execute(
                "SELECT * from tickets where tickets_id = :id_ticket AND id_user = :id", 
                [
                    "id_ticket" => $_GET["id"],
                    "id" => md5($_SESSION["email"])
                ])->fetch();
            echo json_encode(count($results) == 0 ? null : $results);
        }
    }
}
?>
