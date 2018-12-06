<!Doctype html>
<html>
    <head>
        <link href="css/login.css" rel="stylesheet">
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
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
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Search</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>    
    </body>
</html>

<?php
    include("fonction/connect.php");
    include("fonction/select.php");

    if(!empty($_GET["lastname"]))
    {
        $lastname = $_GET["lastname"];
        $query = $db_connect->prepare("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE fiche_personne.nom LIKE '%". $lastname ."%'");
        $query->execute();

        while ($array = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo "<form method='post' action='./edit.php?id=". $array['id_perso'] ."'" . " class='formClient'>";
            echo "<div class = 'client'>";
            echo "<div class='search'>" .  "<strong>Nom: </strong>". $array["nom"] . "</div>";
            echo "<div class='search'>" . "<strong>Prenom:</strong> " . $array["prenom"] . "</div>";
            echo "<div class='search'>" . "<strong id='abo'>Abonnement: </strong> " . $array["id_abo"] . $res = createSelect("SELECT id_abo, nom FROM abonnement", "select","id_abo") .  "</div>";
            echo "<div class='search'>" . "<input id='abo' type = 'hidden' value = " . $array['id_abo'] . ">".  "</div>";
            echo "<div class='search'>" . "<strong>Email:</strong> " . $array["email"] . "</div>";
            echo "<div class='search'>" . "<strong>Adresse:</strong> " . $array["ville"] . " ". $array["cpostal"] .  "</div>";
            echo "<input type= 'submit' value='Edit' class='btn btn-success'><br/>";
            echo "</div>";
            echo "</form>";
        
        }
        //var_dump($array);
    }

    if(!empty($_GET["firstname"]))
    {
        $prenom = $_GET["firstname"];
        $query2 = $db_connect->prepare("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE prenom LIKE '%". $prenom ."%'");
        $query2->execute();
        $array2 = $query2 -> fetchAll(PDO::FETCH_ASSOC);

        for($i  = 0; $i < count($array2); $i++)
        {
            echo "<form method='post' action='./edit.php?id=". $array['id_perso'] . " class='formClient'>";
            echo "<div class = 'client'>";
            echo "<div class='search'>" .  "<strong>Nom: </strong>". $array2[$i]["nom"] ."'" .  "</div>";
            echo "<div class='search'>" . "<strong>Prenom:</strong> " . $array2[$i]["prenom"] . "</div>";
            echo "<div class='search'>" . "<strong id='abo'>Abonnement: </strong> " . $array2[$i]["id_abo"] .  $res = createSelect("SELECT nom FROM abonnement", "select") . "</div>";
            echo "<div class='search'>" . "<input id='abo' type= 'hidden' value = " . $array['id_abo'] . ">".  "</div>";
            echo "<div class='search'>" . "<strong>Email:</strong> " . $array2[$i]["email"] . "</div>";
            echo "<div class='search'>" . "<strong>Adresse:</strong> " . $array2[$i]["ville"] . " ". $array2[$i]["cpostal"] .  "</div>";
            echo "<input type= 'submit' value='Edit' class='btn btn-success'><br/>";
            echo "</div>";
            echo "</form>";
        }
    }


    /*$prenom = $_GET["firstname"];
    $first = $db_connect->prepare("SELECT prenom FROM fiche_personne WHERE prenom LIKE '%". $prenom ."%'");
    $first->execute();
    $array2 = $prenom -> fetchAll(PDO::FETCH_COLUMN);

    if(isset($_GET["firstname"]))
    {
        for($i  = 0; $i < count($array2); $i++)
        {
            echo "<div class='search'>$array2[$i]</div><br/>";
        }
    }*/
?>