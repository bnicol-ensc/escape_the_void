<?php
session_start();
//Destruction de session
session_unset();
//Redirection sur la page d'accueil après deconnexion
header('Location:index.php');