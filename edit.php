<html>
    <head>
    <link href="css/login.css" rel="stylesheet">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="video">
                <video autoplay muted loop id="myVideo">
                <source src="images/kaka.mp4" type="video/mp4">
                </video>
        </div>
        <section class="page_login">
            <div class="login">
                <div class="login_form">
                    <div class="container">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <img src="images/play-button.svg">
                                StudioLabs
                            </div>
                            <?php
                                include("fonction/connect.php");
                                include("fonction/select.php");
                                $id = $_GET["id"];

                                $query = $db_connect -> prepare("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE fiche_personne.id_perso = $id");
                                $query -> execute();
                                //$array = $query->fetch(PDO::FETCH_ASSOC);
                                // /var_dump($array);
                                echo "<form method='post'name='form' action='./edit.php?id=". $_GET["id"] ."'". ">";
                                echo "<div class='all_info'>"; 
                                while($array = $query->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<div class='nom list'>Nom: " .$array['nom'] . "</div>";
                                    echo "<div class='prenom list'>Prenom: " .$array['prenom'] . "</div>";
                                    echo "<div class='abo list'>Abonnement: " .$array['id_abo'] . $res = createSelect("SELECT id_abo, nom FROM abonnement", "select","id_abo", "abonnement"). "<button type='button' id='delete' class='btn btn-danger'>Danger</button>" . "</div>";
                                    echo "<div class='email list'>Email: " .$array['email'] . "</div>";
                                    echo "<div class='list cp'>Adress: " . $array['ville'] . " " .  $array['cpostal'] . "</div>";
                                    echo "<input type='checkbox' id='hidden' value='valueofcheckbox' name='check' style='position:absolute;'";
                                }
                                echo "</div>";

                                //var_dump($_POST);

                                if($_POST["select"] != "All")
                                {
                                    $select = $_POST["select"];
                                    $query2 = $db_connect -> prepare("UPDATE membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso SET id_abo = $select WHERE membre.id_fiche_perso = $id");
                                    $query2 -> execute();
                                }

                                if(isset($_POST["check"]))
                                {
                                    $check = $_POST["check"];
                                    $query3 = $db_connect -> prepare("UPDATE membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso SET id_abo = NULL WHERE membre.id_fiche_perso = $id");
                                    $query3 -> execute();
                                }
                            ?>
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Confirm</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/edit.js"></script>
    </body>
</html>