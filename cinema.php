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
                                            <input type="text" name="search_bar" class="form-control" value="Pretty Woman"></input>
                                        </div>
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