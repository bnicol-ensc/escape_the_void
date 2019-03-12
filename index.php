<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<body>

    <div class="container-fluid">
    <?php       
            require_once("includes/nav.php");
            require_once("includes/connect.php");
    ?>
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/Command.jpg" class="d-block w-100" alt="A dark corridor in a spaceship leading to a door">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Escape the VOID</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/asteroid.jpg" class="d-block w-100" alt="Asteroids in front of a huge planet">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Finding Home</h5>
                        <p>Work in progress, part II of Escape the VOID</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/lostlights.jpg" class="d-block w-100" alt="Blue lights">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>It stares back</h5>
                        <p>Work in progress, part III of Escape the VOID</p>
                    </div>
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
</br>
            </div>
            <div class="row">
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images/command.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Escape the void</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images/lostlights.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Escape the void Part three</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>       
            </div>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images/stmpnk.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">The Byron Mansion</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>        
            </div>
        </div>

    </div>

    <?php require_once("includes/footer.php");?>
    <?php require_once("includes/script.php"); ?>
</body>

</html>