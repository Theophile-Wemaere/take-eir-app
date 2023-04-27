<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link rel="stylesheet" href="/CSS/contact.css">
    <script src="/JS/scripts.js"></script>
    <title>Nous contacter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="top-bar">
        <div class="top-bar-img">
            <a href="/"><img src="/images/logo-notext.png" /></a>
        </div>
        <div class="right-items">
            <a href="/produit.html">
                <button class="page-button" style="margin-right: 10px">
                    Notre produit
                </button></a>
            <div class="separator" style="margin-right: 10px"></div>
            <a href="/presentation.html">
                <button class="page-button" style="margin-right: 10px">
                    Qui sommes nous ?
                </button></a>
            <a href="/login.php">
                <button class="login-button" style="margin-right: 10px">
                    Se connecter
                </button></a>
        </div>
        <span style="pointer-events: auto">
            <div class="menu-button" href="javascript:void(0);" onclick="toggleMenu()">
                <div class="sphere" style="background-color: #2d67e0"></div>
                <div class="sphere" style="background-color: #e0584c"></div>
                <div class="sphere" style="background-color: #5dd1b7"></div>
            </div>
        </span>
    </div>
    <div class="drop-menu" id="dropMenu" style="display: none">
        <a href="/produit.html"><button class="page-button">Notre produit</button></a>
        <div class="separator"></div>
        <a href="/presentation.html"><button class="page-button">Qui sommes nous ?</button></a>
        <div class="separator"></div>
        <a href="/login.php"><button class="login-button" style="margin-top: 10px">
                Se connecter
            </button></a>
    </div>

    <div class="wrapper">
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
                        <input id="subject" type="text" name="phoneNumber">
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
