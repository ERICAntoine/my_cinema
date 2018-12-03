<?php
    include("fonction/connect.php");
    $search_bar = $_GET["search_bar"];
    $query = $db_connect->prepare("SELECT titre FROM film WHERE titre LIKE '%". $search_bar ."%'");
    $query->execute();
    $array = $query -> fetchAll(PDO::FETCH_COLUMN);
    //echo $array[0];

    for($i  = 0; $i < count($array); $i++)
    {
        echo "<div class='search'>$array[$i]</div><br/>";
    }

?>


<html>
    <head></head>
    <body>
        <form method="get" name="form" action="">
            <input type="text" name="search_bar" value="Pretty Woman"></input>
            <input type="submit">
        </form>
</body>
</html>
