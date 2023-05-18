<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.Q</title>
  <link rel="stylesheet" href="faq.css">
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
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


<h1>Foire aux questions</h1>
<div class="faq-container">
  <div class="faq">
    <h3 class="faq-title">
      Comment fonctionne Health-Eir ?
    </h3>
    <p class="faq-text">Le dispositif Health-Eir est un boitier qui mesure les données environnementales et 
      physiologiques d'un patient hospitalisé à domicile. Les données sont collectées par des capteurs intégrés 
      dans le boitier et envoyées en temps réel à une plateforme en ligne sécurisée, où le médecin traitant
       et la famille peuvent les consulter.
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq active">
    <h3 class="faq-title">
      Comment puis-je accéder aux données de santé de mon proche hospitalisé à domicile ?
    </h3>
    <p class="faq-text"> Vous pouvez accéder aux données de santé de votre proche à tout moment en vous connectant
      à notre plateforme en ligne sécurisée. Vous aurez besoin de vos identifiants de connexion pour accéder à votre compte.
      <br><br>
      Une fois que vous vous êtes connectés, vous pouvez vous rendre dans l'onglet 'Health-View' à partir du menu déroulant
      de votre session utilisateur. Cette page affichera alors toutes les données nécessaires pour évaluer la qualité de 
      l'hospitalisation à domicile de votre proche.   
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
      Comment créer un profil utilisateur sur le site web ?
    </h3>
    <p class="faq-text">Pour créer un profil utilisateur sur le site web, il suffit de cliquer sur le bouton "Inscription" et de remplir le formulaire d'inscription en 
      fournissant vos informations personnelles. Vous pourrez ensuite vous connecter avec l'email et le mot de passe indiqués.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
      Comment modifier les informations de mon profil utilisateur ?
    </h3>
    <p class="faq-text"> Pour modifier les informations de votre profil utilisateur, il suffit de vous connecter à votre compte et de cliquer sur le bouton "Modifier le profil". Vous pourrez ensuite mettre à jour les informations de votre profil, comme votre adresse e-mail, votre mot de passe ou votre photo de profil.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
      Comment puis-je paramétrer les seuils d'alerte des capteurs ?  
    </h3>
    <p class="faq-text">Le médecin traitant est le seul à pouvoir paramétrer les seuils des capteurs. 
      Si vous souhaitez modifier les seuils, vous pouvez contacter le médecin traitant 
      et lui demander de les ajuster en fonction de la situation de santé de votre proche.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
      Comment paramétrer les alertes pour recevoir des notifications en cas de dépassement de seuils ?
    </h3>
    <p class="faq-text">Pour recevoir des alertes en cas de dépassement de seuils,
      par exemple si le patient a une fréquence cardiaque importante ou que la température de la chambre
      d'hospitalisation est trop élevée, vous pouvez activer les notifications dans les paramètres de votre profil,
      onglet 'Notifications'.
    </p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
       Est-ce que Health-Eir est sécurisé ?
    </h3>
    <p class="faq-text">Oui, Health-Eir est conçu pour être hautement sécurisé. 
      Les données de santé de votre proche sont stockées sur une plateforme en ligne 
      sécurisée et ne sont accessibles qu'aux personnes autorisées. 
      <br><br>
      Nous utilisons également des protocoles de 
      sécurité avancés pour protéger les données de santé contre les accès non autorisés.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  <div class="faq">
    <h3 class="faq-title">
      Est-ce que je peux donner accès à d'autres membres de ma famille pour consulter 
      les données de santé de mon proche hospitalisé à domicile ?
    </h3>
    <p class="faq-text">Oui, vous pouvez donner accès à d'autres membres de votre famille pour consulter
      les données de santé de votre proche hospitalisé à domicile. 
      <br><br>
      Pour ce faire, il suffit de vous connecter à votre compte 
      et de copier la clé 'Health-Key' correspondant à votre dispositif Health-Eir qu'il aura préalablement fallu enregistrer sur votre espace.
      <br><br>
      Vous pourrez ensuite transmettre à lien de connexion à un autre membre de la famille
      pour que celui-ci puisse pouvoir consulter les données de santé du patient.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
</div>
<h3 class="noResponse" style="color: #3f2de1; padding: 10px 20px;">Vous n'avez pas trouvé de réponse à votre question ? <a href="../contact/contact.php" style="text-decoration:none; color:#e0584c;">Contactez-nous !</a></h3>
<!-- partial -->
  <script  src="./faq.js"></script>

  <?php require "bottom-bar.php"; ?>
</div>

</body>
</html>
