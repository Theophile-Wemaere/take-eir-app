<div class="fake-top-bar"></div>
<div class="top-bar">
    <div class="top-bar-img">
        <a href="/"><img src="/images/logo-notext.png" /></a>
        <a href="/index.php/FR">FR</a>
        <a>|</a>
        <a href="/index.php/EN">EN</a>
    </div>
    <div class="right-items">
        <a href="/index.php/produit">
            <?php if (strpos(basename($_SERVER["PHP_SELF"]), "produit") === false) {
                echo '<button class="page-button" style="margin-right: 10px">';
            } else {
                echo '<button class="page-button current-button" style="margin-right: 10px">';
            } ?>
            Our product
            </button></a>
        <div class="separator" style="margin-right: 10px"></div>
        <?php if (strpos(basename($_SERVER["PHP_SELF"]), "presentation") !== false) {
            echo '      
<div class="dropdownPres">
            <a href="/index.php/presentation"> <button id="menu-btn" onmouseenter="dropMenuPres()" onmouseleave="dropMenuPres()" class="dropbtn current-button">
                    About us
                </button></a>
            <div id="myDropdown" onmouseleave="dropMenuPres()" class="dropdown-content">
                <a href="#title" class="smooth-scroll">Our customer</a>
                <a href="#sectionNous" class="smooth-scroll">About us</a>
                <a href="#sectionEquipe" class="smooth-scroll">Our team</a>
            </div>
        </div>';
        } else {
            echo '<a href="/index.php/presentation">
            <button class="page-button" style="margin-right: 10px">
                About us
            </button></a>';
        } ?>
        <div class="dropdown">
            <a href="/index.php/login">
                <button class="login-button" id="user-menu" onmouseenter="dropMenuUser()" onmouseleave="dropMenuUser()">
                    <?php
                    if (isset($_SESSION["email"])) {
                        echo $_SESSION["name"] .
                            " " .
                            $_SESSION["surname"] .
                            " &nabla;";
                    } else {
                        echo "Login";
                    }
                    ?>
                </button></a>
            <?php if (isset($_SESSION["email"])) {
                echo '<div id="userDropdown" onmouseleave="dropMenuUser()" class="dropdown-content-user">';
                echo "<p>" . $_SESSION["role_name"] . "</p>";
                echo '<a href="/index.php/health-view">HEALTH-EIR View</a>
                      <a href="/index.php/tickets">Your tickets</a>
                      <a href="/index.php/settings-profil">Settings</a>
                      <a href="#" onclick="logout()">Logout</a>
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
    <a href="/index.php/produit"><button class="page-button">Our product</button></a>
    <div class="separator"></div>
    <a href="/index.php/presentation"><button class="page-button">About us</button></a>
    <div class="separator"></div>
    <a href="/index.php/login"><button class="login-button" style="margin-top: 10px;margin-bottom: 10px;">
            <?php
            if (isset($_SESSION["email"])) {
                echo $_SESSION["name"] . " " . $_SESSION["surname"];
            } else {
                echo "Login";
            }
            ?>
        </button></a>
    <?php if (isset($_SESSION["email"])) {
        echo "<p>" . $_SESSION["role_name"] . "</p>";
        echo '<a href="/index.php/health-view"><button class="page-button">HEALTH-EIR View</button></a>
          <a href="/index.php/tickets"><button class="page-button">Your tickets</button></a>
          <a href="/index.php/settings-profil"><button class="page-button">Settings</button></a>
          <a href="#" onclick="logout()"><button class="page-button">Logout</button></a>';
    } ?>

</div>
