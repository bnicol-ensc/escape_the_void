<?php
try
{
    $BDD = new PDO(
        "mysql:host=localhost;dbname=mymovies_bn;charset=utf8", "mymovies_user", "secret",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
}
catch (Exception $e)
{
    die('Erreur fatale : ' . $e->getMessage());
}
?>