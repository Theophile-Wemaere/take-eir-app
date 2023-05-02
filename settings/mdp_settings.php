<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/mdp_settings.css">
    <script src="/JS/scripts.js"></script>
    <title>Modifier son mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap" rel="stylesheet" />
</head>

<body>
<?php require "../top-bar.php"; ?>


    <div class="wrapper">
        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Modifiez votre mot de passe :</h1>
            <div class="separation"></div>

            <div class="corps-formulaire">
                <div class="droite">
                    <div class="groupe">
                        <div class="test">
                            <a href="../index.php"><i class="fa-solid fa-user"></i></a>
                            <a href=""><label>Profil</label></a>
                        </div>
                        <div class="test">
                            <a href="settings.php"><i class="fa-solid fa-envelope"></i></a>
                            <a href="settings.php"><label> E-mail </label></a>
                        </div>
                        <div class="test">
                            <a href="mdp_settings.php"><i class="fa-solid fa-key"></i></a>
                            <a href="mdp_settings.php"><label> <span class="email">Mot de passe</span></label></a>
                        </div>
                        <div class="test">
                            <a href="notif_settings.php"><i class="fa-solid fa-comment"></i></a>
                            <a href="notif_settings.php"><label>Notifications</label></a>
                        </div>
                        <div class="test">
                            <a href="delete_settings.php"><i class="fa-solid fa-user-minus"></i></a>
                            <a href="delete_settings.php"><label><span class="supprimer">Supprimer le compte</span></label></a>
                        </div>
                    </div>
                </div>
                
                <div class="gauche">
                    <div class="groupe">
                        <label>Mot de passe actuel</label>
                        <input id="name" type="password" name="name" require>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="groupe">
                        <label>Nouvel mot de passe</label>
                        <input id="email" type="password" name="email" require>
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="groupe">
                        <label>Vérification du mot de passe</label>
                        <input id="subject" type="password" name="phoneNumber">
                        <i class="fa-solid fa-key"></i>
                    </div>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" onclick="sendEmail()" value="Send An Email">Confirmer</button>
                </div>
            </center>


        </form>

        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                        },
                        success: function(response) {
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
    </div>
    <div class="bottom-bar">
        <a>© take-eir</a>
        <a href="/contact/contact.php">Nous contacter</a>
        <div class="medias">
            <!-- https://icons8.com/icons/set/social-media -->
            <a href="https://linkedin.com/"><img src="/images/icons8-linkedin-24.png" />
            </a>
            <a href="https://youtube.com/"><img src="/images/icons8-youtube-logo-24.png" /></a>
            <a href="https://twitter.com/"><img src="/images/icons8-twitter-24.png" />
            </a>
            <a href="https://instagram.com/"><img src="/images/icons8-instagram-24.png" />
            </a>
        </div>
    </div>
</body>

</html>
