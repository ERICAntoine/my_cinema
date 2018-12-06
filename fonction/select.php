<?php

    include("connect.php");

    function createSelect($resquest, $name , $id)
    {
            global $db_connect;

            $query = $db_connect->prepare($resquest);
            $query->execute();
            $array = $query->fetchAll(PDO::FETCH_ASSOC);
            $doc = new DOMDocument;
            $select = $doc -> createElement("select");

            echo "<select class='form-control' id='sel1' name=" . $name . " size='1'>";
            echo "<option>All</option>";
            for($i = 0; $i < count($array); $i++)
            {
                echo "<option value= " . $array[$i][$id] . ">" . $array[$i]["nom"] . "</option>";
            }
            echo "</select>";
    }
?>