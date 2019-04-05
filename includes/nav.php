<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/stylish.png" width="30" height="30" class="d-inline-block align-top" alt="">  
      Escape Game
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      </ul>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="images/good-fox.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <?php 
                if(isset($_SESSION['login'])) echo 'Bonjour, '.$_SESSION['login'];
                else echo 'Non Connecté';
            ?>
        </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php
        if(isset($_SESSION['admin'])){
          //Affiche le lien vers la page d'administration si l'utilisateur connecté est un mj
          echo "<a class=\"dropdown-item\" href=\"admin.php\">Page d'administration</a>";
        }
        ?>
        <a class="dropdown-item" href=
          <?php 
            //Lien vers la page s'inscrire si l'utilisateur n'est pas connecté
            if(!isset($_SESSION['login'])) echo "'register.php'";?>>
          <?php 
            if(!isset($_SESSION['login'])) echo 'S\'inscrire';?>
        </a>
        <a class="dropdown-item" href=
          <?php 
            //Lien vers la page de déconnexion si l'utilisateur est connecté
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
