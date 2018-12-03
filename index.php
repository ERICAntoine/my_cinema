<?php
    include("fonction/connect.php");
    $search_bar = $_GET["search_bar"];
    //$query = $db_connect->query("Select titre from film");
    $query = $db_connect->prepare("Select titre from film");
    $query->execute();
    $array = $query -> fetchAll(PDO::FETCH_COLUMN);
    //echo $array[0];

    for($i  = 0; $i < count($array); $i++)
    {
        if(strstr($search_bar, $array[$i]))
        {
            echo "$array[$i] \n";
            //echo $search_bar;
        }
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
