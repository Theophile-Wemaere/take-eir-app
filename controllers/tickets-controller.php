<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}

require "../database.php";
$admin = false;
if($_SESSION["role_permission"] == 6) {
    $admin = true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_SESSION["name"];
    $surname = $_SESSION["surname"];
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
                    "body" => $surname . " " .  $name . "[" . $body . "]"
                ])->fetchAll();
        echo json_encode(count($results) == 0 ? null : $results);
    } elseif(isset($_POST["edit_ticket"])) {
        $message = $surname . " " . $name . "[" . base64_encode($_POST["message"]) . "]";
        $ticket_id = $_POST["id"];
        $state = $_POST["state"];
        $query = "UPDATE tickets SET body = CONCAT(body, :message), state = :state WHERE tickets_id = :ticket_id "; 
        if(!$admin) {
            $query = $query . " AND id_user = :id_user";
        }
        $results = $_DB->execute($query, $admin ? 
                    ["message" => $message,"state" => $state, "ticket_id" => $ticket_id] : 
                    ["message" => $message,"state" => $state, "ticket_id" => $ticket_id,"id_user" => md5($_SESSION["email"])]
        )->fetchAll();
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
            $query = "SELECT tickets.*, tags.tag_name, users.name, users.surname
                      FROM tickets
                      JOIN tags ON tickets.id_tag = tags.id_tag
                      JOIN users ON tickets.id_user = users.id_user";
            if(!$admin) {
               $query = $query . " WHERE tickets.id_user = :id AND tickets.state != 'DELETED'";
            } else {
                $query = $query . " WHERE tickets.state != 'DELETED'";
            }
                
            $query = $query . " ORDER BY tickets.created_at DESC";

            $results = $_DB->execute($query, $admin ? null : ["id" => md5($_SESSION["email"])
                ])->fetchAll();
            echo json_encode(count($results) == 0 ? null : $results);
            break;

        case "conv":
            $query = "SELECT tickets.*,users.name, users.surname 
                      FROM tickets 
                      JOIN users ON users.id_user = :id 
                      WHERE tickets_id = :id_ticket"; 
            if(!$admin) {
                $query = $query . " AND tickets.id_user = :id"; 
            }   
            $results = $_DB->execute($query,["id_ticket" => $_GET["id"],"id" => md5($_SESSION["email"])])->fetch();
            echo json_encode(count($results) == 0 ? null : $results);
        }
    }
}
?>
