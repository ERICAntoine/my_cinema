<?php
    include("fonction/connect.php");
    $search_bar = $_GET["search_bar"];
    $query = $db_connect->prepare("SELECT nom FROM fiche_personne WHERE nom LIKE '%". $search_bar ."%'");
    $query->execute();
    $array = $query -> fetchAll(PDO::FETCH_COLUMN);

    if(isset($_GET["search_bar"]))
    {
        for($i  = 0; $i < count($array); $i++)
        {
            echo "<div class='search'>$array[$i]</div><br/>";
        }
    }


    $search_bar = $_GET["prenom"];
    $prenom = $db_connect->prepare("SELECT prenom FROM fiche_personne WHERE nom LIKE '%". $prenom ."%'");
    $prenom->execute();
    $array2 = $prenom -> fetchAll(PDO::FETCH_COLUMN);

    if(isset($_GET["prenom"]))
    {
        for($i  = 0; $i < count($array2); $i++)
        {
            echo "<div class='search'>$array2[$i]</div><br/>";
        }
    }
?>


<html>
    <head></head>
    <body>
        <form method="get" name="form" action="">
            <label>Nom :</label>
            <input type="text" name="search_bar" value=""></input>
            <input type="submit">
            <label>Prenom :</label>
            <input type="text" name="prenom" value=""></input>
            <input type="submit">
        </form>
</body>
</html>
