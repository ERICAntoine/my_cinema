<html>
    <head>
        <meta charset="utf-8">
        <link href="css/login.css" rel="stylesheet">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
        <?php
            session_start();
            include ("component/Header/header.php");
        ?>
        <div class="video">
                <video autoplay muted loop id="myVideo">
                <source src="images/kaka.mp4" type="video/mp4">
                </video>
        </div>
        <div id="overlay"></div>
        <section class="page_login change">
            <div class="login">
                <div class="login_form">
                    <div class="container">
                        <div class="card card_change">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <!--<img src="images/play-button.svg">-->
                                StudioLabs
                            </div>
                            <?php
                                include("fonction/fiche_info.php");
                            ?>
                                <a href="client.php" class="btn btn-lg btn-success btn-block text-uppercase review_change" type="submit">BACK</a>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login">
                <div class="login_form">
                    <div class="container">
                        <div class="card card_change">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    StudioLabs
                                </div>
                                <?php
                                    include("fonction/connect.php");
                                    echo "<form method='post' action='./info.php?id=". $_GET["id"] ."'". ">";                            
                                    echo "<label>Nom du film: </label>";
                                    echo "<input type='text' class='form-control input_change'>";
                                    echo "<label>Resum: </label>";
                                    echo "<textarea class='form-control input_change'></textarea>";
                                    echo "<label>Nom du film deja existant: </label>";
                                    echo "<input type='text' name='film_name' class='form-control input_change'>";
                                    if(isset($_POST["film_name"]) && !empty($_POST["film_name"]))
                                    {
                                        echo $fileName = $_POST['film_name'];
                                        $id = $_GET['id'];
                                        $sql = "INSERT INTO historique_membre (id_membre, id_film, date) VALUES ((SELECT id_membre FROM membre WHERE id_fiche_perso = '$id'),(SELECT id_film from film WHERE titre = '$fileName' limit 1), Now())";
                                        $resquestAddFile = $db_connect-> prepare($sql);
                                        $resquestAddFile -> execute();
                                    }
                                ?>
                                    <button class="btn btn-add btn-lg btn-success btn-block text-uppercase review_change" type="submit">ADD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/info.js"></script>
    </body>
</html>

<?php
    if(isset($_POST["textReview"]) && !empty($_POST["textReview"]) && isset($_POST["nameIdFilm"]) && !empty($_POST["nameIdFilm"]))
    {
        $textarea = $_POST["textReview"];
        $id_film = $_POST["nameIdFilm"];
        $id = $_GET["id"];
        $reviewUpdate = $db_connect -> prepare("UPDATE historique_membre INNER JOIN membre ON historique_membre.id_membre = membre.id_membre SET avis = '$textarea' WHERE id_film = '$id_film' AND membre.id_fiche_perso = $id");
        $reviewUpdate -> execute();
    }
?>