<?php
use PHPMailer\PHPMailer\PHPMailer;

function prepare_mail()
{
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/SMTP.php";
    require "PHPMailer/Exception.php";

    //smtp settings
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "contact.healtheir@gmail.com";
    $mail->Password = 'xuxzhbgbwtyqeoco';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    return $mail;
}

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $mail = prepare_mail();
    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("contact.healtheir@gmail.com");
    $mail->Subject = ("Vous avez un message de la part de : $email (Tel : $subject)");
    $mail->Body = $body;

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));

} elseif (isset($_POST["reset_passwd"])) {

    require "../database.php";

    $to_email = $_POST["email"];
    $email = "contact.healtheir@gmail.com";
    $name = "Support TAKE-EIR";
    $stmt = $_DB->execute("SELECT * FROM users WHERE email = :email", [
        "email" => $to_email,
    ]);
    if ($stmt->rowCount() > 0) {

        // generate secret token for password reset
        $token = bin2hex(random_bytes(32));
        $results = $_DB->execute("DELETE FROM reset_passwd WHERE email = :email",
        ["email" => $to_email]);
        $results = $_DB->execute("INSERT INTO reset_passwd VALUES (:email, :token)",
            [
                "email" => $to_email,
                "token" => $token
            ]);
        $url = generateResetUrl($token);
        $body = "
<html>
    <meta charset='utf-8' />
</head>
<body>
    <p>Bonjour,</p>
    <p>Voici votre lien de réinitialisation de mot de passe :</p>
    <p>
        <a href='$url'>
            Réinitialiser le mot de passe
        </a>
    </p>
    <p>Si le lien ci-dessus ne fonctionne pas, copier coller celui-ci dans votre navigateur :</p>
    <p>$url</p></br>
    <p>Bonne journée à vous,</p>
    <p>L'équipe take-eir</p>
</body>
</html>
";
        //email settings
        $mail = prepare_mail();
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress($to_email);
        $mail->Subject = ("Reinitialisation de votre mot de passe");
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br>" . $mail->ErrorInfo;
        }
        echo $status;
    } else {
        echo "email_not_found";
    }
}

function generateResetUrl($token) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    if ($host === 'take-eir') {
        $host = 'take-eir.fr';
    }

    return $protocol . '://' . $host . '/index.php/new-passwd?token=' . $token;
}