<?php

    include("connect.php");

    function createSelect($resquest, $name , $id, $idSelect = "sel1", $className = 'selectClass')
    {
            global $db_connect;

            $query = $db_connect->prepare($resquest);
            $query->execute();
            $array = $query->fetchAll(PDO::FETCH_ASSOC);

            echo "<select class='form-control' id='$idSelect' name=" . $name . " size='1'>";
            echo "<option>All</option>";
            for($i = 0; $i < count($array); $i++)
            {
                echo "<option class= '$className' value= " . $array[$i][$id] . ">" . $array[$i]["nom"] . "</option>";
            }
            echo "</select>";
    }
?>