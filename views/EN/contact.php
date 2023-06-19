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
    <title>Contact us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
        rel="stylesheet" />
</head>

<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/top-bar.php"; ?>
    <div class="wrapper">
        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Contact us</h1>
            <div class="separation"></div>

            <div class="corps-formulaire">
                <div class="gauche">
                    <div class="groupe">
                        <label>Your name</label>
                        <input id="name" type="text" name="name" require>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="groupe">
                        <label>Your e-mail</label>
                        <input id="email" type="text" name="email" require>
                        <i class="fa-solid fa-envelope"></i>
                        <p id="emailError" class="error-match">Please enter a valid email</p>
                    </div>
                    <div class="groupe">
                        <label>Your phone (optional)</label>
                        <input id="subject" type="text" name="phoneNumber">
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                </div>

                <div class="droite">
                    <div class="groupe">
                        <label>Message</label>
                        <textarea id="body" placeholder="Enter here..." name="message"></textarea>
                    </div>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" onclick="sendEmail()" id="submit-btn" value="Send An Email">Send</button>
                    <script>
                        checkEmail("email")
                        const input = document.getElementById("email");
                        input.addEventListener("input", function () {
                            const error = document.getElementById("emailError");
                            const btn = document.getElementById("submit-btn");
                            if (error.style.display == "none") {
                                btn.disabled = false;
                                btn.style.pointerEvents = "auto";
                                btn.style.opacity = "1";
                            } else {
                                btn.disabled = true;
                                btn.style.pointerEvents = "none";
                                btn.style.opacity = "0.5";
                            }
                        });
                    </script>
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
                        url: '/controllers/email-controller.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            name: name.val(),
                            email: email.val(),
                            subject: subject.val(),
                            body: body.val()
                        },
                        success: function (response) {
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/bottom-bar.php"; ?>
</body>

</html>