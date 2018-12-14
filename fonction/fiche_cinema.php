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
             echo "<li class='page-item'><a class='page-link' href='cinema.php?search_bar=$bar&genre=$genre&distrib=$distrib&date_bar=$date_bar&page=$i&limit=$nbrLimit'>$i</a></li>";
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

 if(isset($_GET['genre']))
 {
     $genre = $_GET["genre"];
 }
 else
 {
     $genre = "All";
 }

 if(isset($_GET['distrib']))
 {
     $distrib = $_GET["distrib"];
 }
 else
 {
     $distrib = "All";
 }

 if($genre != "All" && isset($_GET["search_bar"]) && !empty($_GET["search_bar"]))
 {
     $search_bar = $_GET["search_bar"];
     resquestFetch("SELECT * from film WHERE titre LIKE '". $search_bar ."%' AND id_genre LIKE '" . $genre . "%'", $limit);
 }
 elseif(isset($_GET["search_bar"]) && !empty($_GET['search_bar']) && $distrib != "All")
 {
     $search_bar = $_GET["search_bar"];
     resquestFetch("SELECT * from film WHERE titre LIKE '". $search_bar ."%' AND id_distrib LIKE '" . $distrib . "%'", $limit);
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
     resquestFetch("SELECT * FROM film WHERE date_debut_affiche <= '$date' AND date_fin_affiche >= '$date'", $limit);
 }
 elseif($distrib != "All")
 {
     $distrib = $_GET["distrib"];
     resquestFetch("SELECT * FROM film WHERE id_distrib = '$distrib'", $limit);
 }
?>

?>