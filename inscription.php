<?php
    session_start();
    include("fonction/connect.php");

    if(isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["mdp"]) && !empty($_POST["mdp"]))
    {
        $pseudo = $_POST["pseudo"];
        $email = $_POST["email"];
        $password = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
        $verif = $db_connect -> prepare("SELECT pseudo FROM users WHERE pseudo = '$pseudo' OR email = '$email'");
        $verif -> execute();
        $countVerif = $verif -> rowCount();
        echo $countVerif;

        if($countVerif != 0)
        {
            echo "<div class='error'>Error: Le pseudo ou l'email exist deja</div>";
        }
        else
        {
            $addUser = $db_connect -> prepare("INSERT INTO users (pseudo, email, password) VALUES ('$pseudo', '$email', '$password')");
            $addUser -> execute();
        }
    }
?>

<html>
    <?php
        include("component/Head/head2.php"); 
    ?>
    <body style=
    "background: url('images/login-fond.png'); 
    background-position: center; 
    background-size: cover;">
        <header class="header-login">
            <div class="container-fluid row-header">
                <ul>
                    <a href="inscription.php"><li>S'inscrire</li></a>
                    <a href="connexion.php"><li>Connexion</li></a>
                </ul>
            </div>
        </header>
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
                                    <form method="post">
                                        <div class="form-label-group">
                                                <input minlength= "4" maxlength="16" type="text" name="pseudo" id="inputEmail" class="form-control" placeholder="Nom d'utilisateur" required>
                                        </div>
                                        <div class="form-label-group">
                                            <input name = "email" type="email" id="inputEmail" class="form-control" placeholder="Adresse Email" required>
                                        </div>

                                        <div class="form-label-group">
                                            <input name="mdp" type="password" id="inputPassword" class="form-control" placeholder="Mot de Passe" minlength="6" maxlength="25" required>
                                        </div>
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </body>
</html>