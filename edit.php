<?php
    session_start();
?>

<html>
    <head>
    <link href="css/login.css" rel="stylesheet">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
        <?php
            include ("component/Header/header.php");
        ?>
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
                            <?php
                                include("fonction/fiche_edit.php");
                            ?>
                                <a href="cinema.php">Search Cinema</a>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Confirm</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/edit.js"></script>
    </body>
</html>