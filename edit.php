<?php
    include("fonction/connect.php");
    $id = $_GET["id"];

    $query = $db_connect -> prepare("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE fiche_personne.id_perso = $id");
    $query -> execute();
    $array = $query->fetch(PDO::FETCH_ASSOC);

    var_dump($array);
?>

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
                            <form method="get" name="form" action="">
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Search</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
    </body>
</html>