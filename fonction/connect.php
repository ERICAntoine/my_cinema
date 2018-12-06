<?php
    $server = "localhost";
    $dbname= "wac_exam";
    $username = "eric";
    $password= "159100";

    try{
        $db_connect = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
        //echo "Success";
    }
    catch (PDOException $error)
    {
        echo "Connection failure";
    }
?>