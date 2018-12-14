<header class="header">
            <div class = "container">
                <div class="row row-header">
                    <div class="col">
                    <a href="client.php"><img src="images/play-button.svg"></a>
                StudioLabs
                    </div>
            <div class="col nav-home">
                <ul>
                    <li>Accueil</li>
                    <li>Shop</li>
                </ul>
            </div>
            <div class="col user">
                <div class="picto">
                    <img src="images/search.svg">
                    <img src="images/notification.svg">
                    <img src="images/user.svg">
                    <?php
                    $pseudo = $_SESSION["pseudo"];
                        echo "<a href='#'>$pseudo</a>";
                    ?>
                </div>
            </div>
                    </div>
                </div>
            </div>
    </header>