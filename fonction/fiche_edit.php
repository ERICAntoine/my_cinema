<?php
     include("fonction/connect.php");
     include("fonction/select.php");
     $id = $_GET["id"];

     $query = $db_connect -> prepare("SELECT fiche_personne.id_perso, id_membre, id_abo, fiche_personne.nom, fiche_personne.prenom, fiche_personne.email, fiche_personne.ville, fiche_personne.cpostal from membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso WHERE fiche_personne.id_perso = $id");
     $query -> execute();

     echo "<form method='post'name='form' action='./edit.php?id=". $_GET["id"] ."'". ">";
     echo "<div class='all_info'>"; 
     while($array = $query->fetch(PDO::FETCH_ASSOC))
     {
         echo "<div class='nom list'>Lastname: " .$array['nom'] . "</div>";
         echo "<div class='prenom list'>Firstname: " .$array['prenom'] . "</div>";
         echo "<div class='abo list'>Subscription: " .$array['id_abo'] . $res = createSelect("SELECT id_abo, nom FROM abonnement", "select","id_abo", "abonnement"). "<button type='button' id='delete' class='delete_button btn btn-danger'>Delete</button>" . "</div>";
         echo "<div class='email list'>Email: " .$array['email'] . "</div>";
         echo "<div class='list cp'>Adress: " . $array['ville'] . " " .  $array['cpostal'] . "</div>";
         echo "<input type='checkbox' id='hidden' value='valueofcheckbox' name='check' style='position:absolute; opacity:0;'";
     }
     echo "</div>";

     if(isset($_POST["select"]) && !empty($_POST["select"]))
     {
         if($_POST["select"] != "All")
         {
             $select = $_POST["select"];
             $query2 = $db_connect -> prepare("UPDATE membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso SET id_abo = $select WHERE membre.id_fiche_perso = $id");
             $query2 -> execute();
             header('Location: edit.php?id=' . $id);
         }
     }

     if(isset($_POST["check"]))
     {
         $check = $_POST["check"];
         $query3 = $db_connect -> prepare("UPDATE membre INNER JOIN fiche_personne ON membre.id_fiche_perso = fiche_personne.id_perso SET id_abo = NULL WHERE membre.id_fiche_perso = $id");
         $query3 -> execute();
         header('Location: edit.php?id=' . $id);
     }
?>