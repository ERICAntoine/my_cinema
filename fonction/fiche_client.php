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
                echo "<li class='page-item'col-sm-4'><a class='page-link' href='client.php?lastname=$lastname&firstname=$firstname&page=$i&limit=$nbrLimit'>$i</a></li>";
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