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

                                $query = $db_connect -> prepare("select membre.id_fiche_perso, historique_membre.id_membre, historique_membre.id_film, film.titre, historique_membre.date, membre.id_dernier_film, membre.date_inscription from historique_membre inner join membre on historique_membre.id_membre = membre.id_membre inner join film on film.id_film = historique_membre.id_film WHERE historique_membre.id_membre = $id");
                                $query -> execute();


                                echo "<form method='post'name='form' action='./info.php?id=". $_GET["id"] ."'". ">";
                                echo "<div class='all_info'>"; 
                                while($array = $query->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<div class='nom list'>Nom: " .$array['nom'] . "</div>";
                                    echo "<div class='prenom list'>Prenom: " .$array['prenom'] . "</div>";
                                    echo "<div class='email list'>Email: " .$array['email'] . "</div>";
                                    echo "<input type='checkbox' id='hidden' value='valueofcheckbox' name='check' style='position:absolute;'";
                                }
                                echo "</div>";


                                //var_dump($_POST);
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
        <script src="js/script.js"></script>
    </body>
</html>