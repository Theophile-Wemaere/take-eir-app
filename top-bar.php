<div class="top-bar">
    <div class="top-bar-img">
        <a href="/"><img src="/images/logo-notext.png" /></a>
    </div>
    <div class="right-items">
        <a href="/produit.php">
            <button class="page-button" style="margin-right: 10px">
                Notre produit
            </button></a>
        <div class="separator" style="margin-right: 10px"></div>
        <?php if ($_SERVER["REQUEST_URI"] == "/presentation.php") {
            echo '      
<div class="dropdown">
            <a href="/presentation.php"> <button id="menu-btn" onmouseenter="dropMenuPres()" onmouseleave="dropMenuPres()" class="dropbtn current-button">
                    Qui sommes nous ?
                </button></a>
            <div id="myDropdown" onmouseleave="dropMenuPres()" class="dropdown-content">
                <a href="#title" class="smooth-scroll">Notre Client</a>
                <a href="#sectionNous" class="smooth-scroll">Qui sommes-nous</a>
                <a href="#sectionEquipe" class="smooth-scroll">Notre Equipe</a>
            </div>
        </div>';
        } else {
            echo '<a href="/presentation.php">
            <button class="page-button" style="margin-right: 10px">
                Qui sommes nous ?
            </button></a>';
        } ?>
        <div class="dropdown">
            <a href="/login.php">
                <button class="login-button" id="user-menu" onmouseenter="dropMenuUser()" onmouseleave="dropMenuUser()">
                    <?php
                    session_start();
                    if (isset($_SESSION["email"])) {
                        echo $_SESSION["name"] .
                            " " .
                            $_SESSION["surname"] .
                            " &nabla;";
                    } else {
                        echo "Se connecter";
                    }
                    ?>
                </button></a>
            <?php if (isset($_SESSION["email"])) {
                echo '<div id="userDropdown" onmouseleave="dropMenuUser()" class="dropdown-content-user">';
                echo "<p>" . $_SESSION["role_name"] . "</p>";
                echo '<a href="/monitor.php">HEALTH-EIR View</a>
          <a href="#" onclick="logout()">Se deconnecter</a>
        </div>';
            } ?>
        </div>

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
    <a href="/produit.php"><button class="page-button">Notre produit</button></a>
    <div class="separator"></div>
    <a href="/presentation.php"><button class="page-button">Qui sommes nous ?</button></a>
    <div class="separator"></div>
    <a href="/login.php"><button class="login-button" style="margin-top: 10px;margin-bottom: 10px;">
            <?php
            session_start();
            if (isset($_SESSION["email"])) {
                echo $_SESSION["name"] . " " . $_SESSION["surname"];
            } else {
                echo "Se connecter";
            }
            ?>
        </button></a>
    <?php if (isset($_SESSION["email"])) {
        echo "<p>" . $_SESSION["role_name"] . "</p>";
        echo '<a href="/monitor.php"><button class="page-button">HEALTH-EIR View</button></a>
          <a href="#" onclick="logout()"><button class="page-button">Se deconnecter</button></a>';
    } ?>

</div>
