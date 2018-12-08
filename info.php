<html>
    <head>
        <meta charset="utf-8">
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
                                $selectName = $db_connect -> prepare("SELECT nom, prenom FROM fiche_personne WHERE id_perso = $id");
                                $selectName -> execute();

                                while($array = $selectName->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "Nom: " . $array["nom"] . "<br/>";
                                    echo "Prenom: " .$array["prenom"] . "<br/><br/>";
                                }

                                $selectInfoFilm = $db_connect -> prepare("SELECT membre.id_fiche_perso, historique_membre.id_membre, historique_membre.id_film, film.titre, historique_membre.date, membre.id_dernier_film, membre.date_inscription FROM historique_membre INNER JOIN membre ON historique_membre.id_membre = membre.id_membre INNER JOIN film ON film.id_film = historique_membre.id_film WHERE historique_membre.id_membre = $id");
                                $selectInfoFilm -> execute();
                                $array2 = $selectInfoFilm->fetch(PDO::FETCH_ASSOC);

                                echo "<form method='post'name='form' action='./info.php?id=". $_GET["id"] ."'". ">";
                                echo "<div class='all_info'>";

                                while($array = $selectInfoFilm->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<div class='email list'>Film vu: " .$array['titre'] . " le " .$array["date"] . "</div>";
                                }
                                echo "</div>";
                            ?>
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">BACK</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login">
                <div class="login_form">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <img src="images/play-button.svg">
                                    StudioLabs
                                </div>
                                <form method="post">
                                <?php
                                    echo "<label>Nom du film: </label>";
                                    echo "<input type='text' class='form-control'>";
                                    echo "<label>Resum: </label>";
                                    echo "<textarea class='form-control'></textarea>";
                                    echo "<label>Nom du film deja existant: </label>";
                                    echo "<input type='text' name='film_name' class='form-control'>";
                                    //echo date("Y-m-d h:i:sa");

                                    $fileName = $_POST['film_name'];
                                    $resquestAddFile = $db_connect->query("INSERT INTO historique_membre (id_membre, id_film, date) VALUES ("1",(SELECT id_film from film WHERE titre = "Akira"), '2011-12-18 13:17:17')")
                                ?>
                                    <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">ADD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/script.js"></script>
    </body>
</html>