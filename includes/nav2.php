<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="images/ApertureLogo2.jpg" width="30" height="30" class="d-inline-block align-top" alt="">  
      Escape Game
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <?php if(isset($_SESSION['login'])) echo "<a class='nav-item nav-link' href='movie_add.php'>Add Movie</a>";?>
        </li>
      </ul>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="images/login.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <?php 
                if(isset($_SESSION['login'])) echo 'Bonjour, '.$_SESSION['login'];
                else echo 'Non Connecté';
            ?>
        </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href=
          <?php 
            if(isset($_SESSION['login'])) echo "'logout.php'";
            else echo "'login.php'";?>>
          <?php 
            if(isset($_SESSION['login'])) echo 'Se Déconnecter';
            else echo 'Se Connecter';
          ?>
        </a>
  </div>
</div>
    </div>
  </div>
</nav>