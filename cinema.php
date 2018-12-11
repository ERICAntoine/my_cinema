<!Doctype html>
<html>
    <head>
        <link href="css/login.css" rel="stylesheet">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
    include("fonction/connect.php");

    function resquestFetch($resquest, $nbrLimit)
    {
        global $db_connect;

        if(isset($_GET["page"]))
        {
            $page = $_GET["page"];
        }
        else
        {
            $page = 1;
        }

        $query = $db_connect->prepare($resquest. ' limit ' .($page -1)*$nbrLimit ."," . $nbrLimit);
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);
        $countCol = $db_connect -> prepare($resquest);
        $countCol -> execute();
        $totalMovies = $countCol-> rowCount();
        $nbrPage = ceil($totalMovies / $nbrLimit);
        $bar = $_GET["search_bar"];
        $genre = $_GET["genre"];
        $distrib = $_GET["distrib"];
        $date_bar = $_GET["date_bar"];

        if(isset($_GET["page"]))
        {
            $page = $_GET["page"];
        }
        else
        {
            $page = 1;
        }

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
                echo "<strong>Date d'affiche : </strong>" . $array[$i]["date_debut_affiche"] . "<br/>";
                echo "<strong>Duree en Minutes : </strong>" . $array[$i]["duree_min"] . " min<br/>";
                echo "<strong>Resum : </strong>" . $array[$i]["resum"] . "<br/>";
                echo "</div><br/>";
            } 
            echo "</div>";
            echo "<ul class='pagination pagi'>";
            for($i = 1; $i < $nbrPage + 1; $i++)
            {
                echo "<li class='page-item'><a class='page-link' href='cinema.php?search_bar=$bar&genre=$genre&distrib=$distrib&date_bar=$date_bar&page=$i'>$i</a></li>";
            }
            echo '</ul>';
        }
    }
    
    if(isset($_GET["limit"]) && !empty($_GET["limit"]))
    {
        $limit = $_GET["limit"];
    }
    else
    {
        $limit = 12;
    }

    if(isset($_GET['genre']) && !empty($_GET['genre']))
    {
        $genre = $_GET["genre"];
    }
    else
    {
        $genre = "All";
    }

    if($genre != "All" && isset($_GET["search_bar"]) && !empty($_GET["search_bar"]))
    {
        $search_bar = $_GET["search_bar"];
        resquestFetch("SELECT * from film WHERE titre LIKE '%". $search_bar ."%' AND id_genre LIKE '" . $genre . "%'", $limit);
    }
    elseif(isset($_GET["search_bar"]) && !empty($_GET['search_bar']))
    {
        $search_bar = $_GET["search_bar"];
        $numberMovie = 10;
        resquestFetch("SELECT * from film WHERE titre LIKE '". $search_bar ."%'", $limit);
    }
    elseif($genre != "All")
    {
        resquestFetch("SELECT * from film WHERE id_genre = '" . $genre . "'", $limit);
    }
    elseif(isset($_GET["date_bar"]) && !empty($_GET["date_bar"]))
    {
        $date = $_GET["date_bar"];
        echo resquestFetch("SELECT * FROM film WHERE date_debut_affiche <= '$date' AND date_fin_affiche >= '$date'", $limit);
    }
    elseif(isset($_GET["distrib"]) && !empty($_GET["distrib"]))
    {
        $distrib = $_GET["distrib"];
        resquestFetch("SELECT * FROM film WHERE id_distrib = '$distrib'", $limit);
    }
?>