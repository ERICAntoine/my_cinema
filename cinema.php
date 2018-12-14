<?php
    session_start();
?>

<!Doctype html>
<html>
    <head>
        <link href="css/login.css" rel="stylesheet">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
        <?php
            include ("component/Header/header.php");
        ?>
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
                                        <div class="form-label-group">
                                            <label>Search Movies :</label>
                                            <input type="text" name="search_bar" class="form-control"></input>
                                        </div>
                                        <div name = "select" class="form-label-group">
                                            <label>Search Genre :</label>
                                           <?php include("fonction/select.php"); 
                                               createSelect("SELECT id_genre, nom FROM genre", "genre", "id_genre", "selectID", "id_genre");
                                           ?>
                                        </div>
                                        <div class="form-label-group">
                                            <label>Search Distributeur :</label>
                                            <?php
                                               createSelect("SELECT id_distrib, nom FROM distrib", "distrib", "id_distrib", "selectDistrib", "id_distrib");
                                               
                                           ?>
                                           <br/>
                                        </div>
                                        <div class="form-label-group" id= "dateClass">
                                            <label>Search Movies by date:</label>
                                            <input type="date" name="date_bar" id='date' class="form-control"></input>
                                        </div>
                                        <div class="form-label-group" id= "dateClass">
                                            <label>Limit:</label>
                                            <input type="number" name="limit" id='date' class="form-control"></input>
                                        </div>
                                           <a href="client.php">Search Client</a>
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <script src="js/cinema.js"></script>
    </body>
</html>

<?php
    include("fonction/fiche_cinema.php");
?>