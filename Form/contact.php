<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Formulaire de contact</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>
    <body>

        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Contactez-nous</h1>
            <div class="separation"></div>
    
            <div class="corps-formulaire">
                <div class="gauche">
                    <div class="groupe">
                        <label>Votre prénom</label>
                        <input id="name" type="text" name="name" require>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="groupe">
                        <label>Votre adresse e-mail</label>
                        <input id="email" type="text" name="email" require>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="groupe">
                        <label>Votre téléphone</label>
                        <input id = "subject" type="text" name="phoneNumber">
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                </div>
    
                <div class="droite">
                    <div class="groupe">
                        <label>Message</label>
                        <textarea id="body" placeholder="Saisissez ici..." name="message"></textarea>
                    </div>
                </div>
            </div>
    
            <center>
            <div class="pied-formulaire">
                <button type="button" onclick="sendEmail()" value="Send An Email">Envoyer le message</button>
            </div>
            </center>
           

        </form>
    
    </body>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
        function sendEmail() {
            var name = $("#name");
            var email = $("#email");
            var subject = $("#subject");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                $.ajax({
                   url: 'sendEmail.php',
                   method: 'POST',
                   dataType: 'json',
                   data: {
                       name: name.val(),
                       email: email.val(),
                       subject: subject.val(),
                       body: body.val()
                   }, success: function (response) {
                        $('#myForm')[0].reset();
                        $('.sent-notification').text("Message envoyé avec succès !");
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>
    
</body>
</html>

