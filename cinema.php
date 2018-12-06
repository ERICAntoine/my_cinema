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
                                               createSelect("SELECT id_genre, nom FROM genre", "genre", "id_genre");
                                           ?>
                                        </div>
                                        <div class="form-label-group">
                                            <label>Search Distributeur :</label>
                                            <?php
                                               createSelect("SELECT id_distrib, nom FROM distrib", "distrib", "id_genre");
                                           ?>
                                           <br/>
                                           <a href="client.php">Search Client</a>
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
            echo "<div class='all_search'>";
            for($i = 0; $i < count($array); $i++)
            {
                echo "<div class='search'>";
                echo "<strong>Titre : </strong>" .$array[$i]["titre"] . "<br/>";
                echo "<strong>Genre : </strong>" . $array[$i]["id_genre"] . "<br/>";
                echo "<strong>Annee de Production : </strong>" . $array[$i]["annee_prod"] . "<br/>";
                echo "<strong> Duree en Minutes : </strong>" . $array[$i]["duree_min"] . " min<br/>";
                echo "<strong>Resum : </strong>" . $array[$i]["resum"] . "<br/>";
                echo "</div><br/>";
            } 
            echo "</div>";
        }
    }

    function fetchPerso($resquest)
    {

    }
  
    if($_GET["genre"] != "All" && !empty($_GET["search_bar"]))
    {
        echo "hello";
        $search_bar = $_GET["search_bar"];
        $genre = $_GET["genre"];
        resquestFetch("SELECT titre, id_genre, resum, annee_prod,duree_min from film WHERE titre LIKE '%". $search_bar ."%' AND id_genre LIKE '%" . $genre . "%'");
    }
    elseif($genre != "All")
    {
        resquestFetch("SELECT titre, id_genre, resum, annee_prod,duree_min from film WHERE id_genre = '" . $genre . "'");
    }

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