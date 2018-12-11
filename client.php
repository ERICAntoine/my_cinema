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
                                    <label>Search Client LastName:</label>
                                    <input type="text" name="lastname" class="form-control"></input>
                                </div>
                                <div name = "select" class="form-label-group">
                                    <label>Search Client FirstName:</label>
                                    <input type="text" name="firstname" class="form-control"></input>
                                </div>
                                <div class="form-label-group" id= "dateClass">
                                    <label>Limit:</label>
                                    <input type="number" name="limit" id='date' class="form-control"></input>
                                </div>
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Search</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/client.js"></script>   
    </body>
</html>

<?php
    include("fonction/connect.php");
    include("fonction/select.php");

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
        $lastname = $_GET["lastname"];
        $firstname = $_GET["firstname"];

        if(isset($_GET["page"]))
        {
            $page = $_GET["page"];
        }
        else
        {
            $page = 1;
        }

        if(isset($_GET["lastname"]))
        {
            echo "<div class='all_search row'>";
            for($i = 0; $i < count($array); $i++)
            {
                echo "<div class='search' >";
                echo "<div class='search_client'>" .  "<strong>Nom: </strong>". $array[$i]["nom"] . "</div>";
                echo "<div class='search_client'>" . "<strong>Prenom:</strong> " . $array[$i]["prenom"] . "</div>";
                echo "<div class='search_client'>" . "<strong id='abo'>Abonnement: </strong> " ."<span class='abo_id'>" .$array[$i]["id_abo"] ."</span>" . "</div>";
                echo "<div class='search_client'>" . "<input id='abo' type = 'hidden' value = " . $array[$i]['id_abo'] . ">".  "</div>";
                echo "<div class='search_client'>" . "<strong>Email:</strong> " . $array[$i]["email"] . "</div>";
                echo "<div class='search_client'>" . "<strong>Adresse:</strong> " . $array[$i]["ville"] . " ". $array[$i]["cpostal"] .  "</div>";
                echo "<a " . "href ='./edit.php?id=". $array[$i]['id_perso'] . "'" .  "value='Edit' class='btn btn-success edit'>Edit</a>";
                echo "<a " . "href ='./info.php?id=". $array[$i]['id_perso'] . "'" .  "value='Info' class='btn btn-primary'>Info</a><br/>";
                echo "</div><br/>";
            } 
            echo "</div>";
            echo "<ul class='pagination pagi'>";
            for($i = 1; $i < $nbrPage; $i++)
            {
                echo "<li class='page-item'col-sm-4'><a class='page-link' href='client.php?lastname=$lastname&firstname=$firstname&page=$i'>$i</a></li>";
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

    if(!empty($_GET["lastname"]))
    {
        $lastname = $_GET["lastname"];
        resquestFetch("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE fiche_personne.nom LIKE '". $lastname ."%'", $limit);
    }

    if(!empty($_GET["firstname"]))
    {
        $prenom = $_GET["firstname"];
        resquestFetch("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE prenom LIKE '". $prenom ."%'", $limit);
    }

?>