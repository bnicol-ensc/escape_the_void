<?php
try
{
    $BDD = new PDO(
        "mysql:host=localhost;dbname=escape_the_void;charset=utf8", "escape_the_void_user", "secret",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
}
catch (Exception $e)
{
    die('Erreur fatale : ' . $e->getMessage());
}
?>