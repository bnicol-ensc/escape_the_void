<?php

//Fonction modifiant la valeur d'entrée afin d'éviter les injections de code
function escape($valeur)
{
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
}

//Fonction permettant la redirection sur une page données en paramètre
function redirect($url)
{
    header("Location: $url.php");
}

?>