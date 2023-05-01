<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.Q</title>
  <link rel="stylesheet" href="../FAQ/faq.css">
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap" rel="stylesheet" />

</head>
<body>

<!-- partial:index.partial.html -->
<!--=============== FONT AWESOME ===============-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<header>
  <?php require "../top-bar.php"; ?>
</header>


<h1>Frequently Asked Questions</h1>
<div class="faq-container">
  <div class="faq">
    <h3 class="faq-title">
    How does Health-Eir work?
    </h3>
    <p class="faq-text">The Health-Eir device is a box that measures environmental data and
      physiological conditions of a patient hospitalized at home. Data is collected by built-in sensors
      in the box and sent in real time to a secure online platform, where the attending physician
       and the family can consult them.
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq active">
    <h3 class="faq-title">
    How can I access the health data of my loved one hospitalized at home?    </h3>
    <p class="faq-text"> You can access your loved one's health data at any time by logging in
      to our secure online platform. You will need your login credentials to access your account.
      <br><br>
      Once you have logged in, you can go to the 'Health-View' tab from the drop-down menu
      of your user session. This page will then display all the data needed to assess the quality of
      home hospitalization of your loved one.  
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
    How to create a user profile on the website?    </h3>
    <p class="faq-text">To create a user profile on the website, just click on the "Registration" button and complete the registration form by
      providing your personal information. You can then log in with the email and password provided.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
    How do I change my user profile information?
    </h3>
    <p class="faq-text"> To edit your user profile information, simply log into your account and click on the "Edit Profile" button. You can then update your profile information, such as your email address, password, or profile picture.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
    How can I configure the alert thresholds of the sensors?
    </h3>
    <p class="faq-text">The attending physician is the only one who can configure the thresholds of the sensors.
      If you want to change the thresholds, you can contact the attending physician
      and ask him to adjust them according to your loved one's health situation.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
    How to configure alerts to receive notifications when thresholds are exceeded?
    </h3>
    <p class="faq-text">To receive alerts when thresholds are exceeded,
      for example if the patient has a high heart rate or the room temperature
      hospitalization is too high, you can enable notifications in your profile settings,
      'Notifications' tab.
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
    Is Health-Eir secure?
    </h3>
    <p class="faq-text">Yes, Health-Eir is designed to be highly secure.
      Your loved one's health data is stored on an online platform
      secure and accessible only to authorized persons.
      <br><br>
      We also use protocols
      advanced security to protect health data from unauthorized access.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
    Can I give access to other members of my family to consult
      the health data of my loved one hospitalized at home?
    </h3>
    <p class="faq-text">Yes, you can give access to other members of your family to consult
      the health data of your loved one hospitalized at home.
      <br><br>
      To do this, simply log in to your account
      and copy the key 'Health-Key' corresponding to your Health-Eir device that you will have previously had to register on your space.
      <br><br>
      You can then forward the login link to another family member
      so that the latter can consult the patient's health data.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
</div>
<!-- partial -->
  <script  src="../FAQ/faq.js"></script>

  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact/contact.php">Contact Us</a>
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
