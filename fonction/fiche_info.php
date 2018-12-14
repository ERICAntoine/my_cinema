<?php
    include("fonction/connect.php");
    include("fonction/select.php");

    $id = $_GET["id"];
    $searchColumn = $db_connect -> query("SHOW COLUMNS FROM historique_membre like 'avis'");
    $exist = $searchColumn -> fetch(PDO::FETCH_ASSOC);

    if(!$exist)
    {
        $alterTable = "ALTER TABLE historique_membre ADD avis varchar(255) after date";
        $createColumns = $db_connect -> query($alterTable);
    }

    $selectName = $db_connect -> prepare("SELECT nom, prenom FROM fiche_personne WHERE id_perso = $id");
    $selectName -> execute();
    while($array = $selectName->fetch(PDO::FETCH_ASSOC))
    {
        echo "Nom: " . $array["nom"] . "<br/>";
        echo "Prenom: " .$array["prenom"] . "<br/><br/>";
    }

    $selectInfoFilm = $db_connect -> prepare("SELECT membre.id_fiche_perso, historique_membre.id_membre, historique_membre.id_film, film.titre, historique_membre.date, membre.id_dernier_film, membre.date_inscription FROM historique_membre INNER JOIN membre ON historique_membre.id_membre = membre.id_membre INNER JOIN film ON film.id_film = historique_membre.id_film WHERE membre.id_fiche_perso = $id");
    $selectInfoFilm -> execute();
    $array2 = $selectInfoFilm->fetch(PDO::FETCH_ASSOC);

    echo "<form method='post'name='form' action='./info.php?id=". $_GET["id"] ."'". ">";
    echo "<div class='all_info'>";
    echo "<input value = ' ". $array2["id_membre"] . "'" . " type='hidden' name'id_membre'>";

    while($array = $selectInfoFilm->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div class='film_vu list'><strong>Film vu: </strong> " .$array['titre'] . " le " .$array["date"] .'<span value= ' . $array["id_film"] .' class="badge badge-pill badge-primary review review_change"> Add review </span>'. "</div>";
    }
    echo "</div>";
?>