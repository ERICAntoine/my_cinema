<!Doctype html>
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
    include("fonction/connect.php");

    /*function getText($string, $tag)
    {
        $fullTag = "/<$tag ?.*>(.*)<\/$tag>/";
        preg_match($fullTag, $string, $match);
        return $match;
    }*/

    function resquestFetch($resquest)
    {
        global $db_connect;

        $query = $db_connect->prepare($resquest);
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);

        if(isset($_GET["search_bar"]))
        {
            echo "<div class='all_search row'>";
            for($i = 0; $i < count($array); $i++)
            {
                echo "<div class='search col-sm-4'>";
                echo "<strong>Titre : </strong>" .$array[$i]["titre"] . "<br/>";
                echo "<strong>Genre : </strong>" . '<span class="genre_id">'. $array[$i]["id_genre"] .'</span>' .  "<br/>";
                echo "<strong>Distributeur: </strong>" .'<span class="distrib_id">'. $array[$i]["id_distrib"] .'</span>' . "<br/>";
                echo "<strong>Annee de Production : </strong>" . $array[$i]["annee_prod"] . "<br/>";
                echo "<strong> Duree en Minutes : </strong>" . $array[$i]["duree_min"] . " min<br/>";
                echo "<strong>Resum : </strong>" . $array[$i]["resum"] . "<br/>";
                echo "</div><br/>";
            } 
            echo "</div>";
        }
    }
    
    $genre = $_GET["genre"];

    /*if(isset($_GET["search_bar"]))
    {
        $search_bar = $_GET["search_bar"];
        resquestFetch("SELECT * from film WHERE titre LIKE '%". $search_bar ."%'");
    }*/
    if($_GET["genre"] != "All" && !empty($_GET["search_bar"]))
    {
        $search_bar = $_GET["search_bar"];
        resquestFetch("SELECT * from film WHERE titre LIKE '%". $search_bar ."%' AND id_genre LIKE '%" . $genre . "%'");
    }
    elseif($genre != "All")
    {
        resquestFetch("SELECT * from film WHERE id_genre = '" . $genre . "'");
    }

    /*if(isset($_GET["date_bar"]))
    {        
        $date = $_GET["date_bar"];        
        resquestFetch("SELECT * FROM film WHERE date_debut_affiche = '$date'");
    }
    
    if(isset($_GET["distrib"]))
    {
        $distrib = $_GET["distrib"];
        resquestFetch("SELECT * FROM film WHERE id_distrib = '$distrib'");
    }*/

    //resquestFetch("SELECT titre, id_genre, nom FROM film WHERE titre LIKE '%". $search_bar ."%'");
    /*$genre = $_GET["genre"];

    if(!empty($_GET["search_bar"]))
    {
        $search_bar = $_GET["search_bar"];
        $genre = $_GET["genre"];
        resquestFetch("SELECT film.titre, genre.nom, film.resum FROM film LEFT JOIN genre ON film.id_genre = genre.nom WHERE titre LIKE '%". $search_bar ."%'");
        if(!empty($_GET["genre"]))
        {
            resquestFetch("SELECT film.titre, genre.nom, film.resum FROM film LEFT JOIN genre ON film.id_genre = genre.nom WHERE titre LIKE '%". $search_bar ."%' AND nom LIKE '%" . $genre . "%'");
        }
    }*/
    /*elseif(!empty($_GET["genre"]))
    {
        $search_bar = $_GET["search_bar"];
        $genre = $_GET["genre"];
        resquestFetch("SELECT film.titre, genre.nom, film.resum FROM film LEFT JOIN genre ON film.id_genre = genre.nom WHERE nom LIKE '%" . $genre . "%'");
    }*/
?>