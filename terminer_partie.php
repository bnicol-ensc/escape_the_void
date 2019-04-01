<?php
session_start();
$MaRequete = "SELECT * FROM enigmecours WHERE equipe=".$_SESSION['login']." ORDER BY eng_id";
    $STH = $BDD -> prepare( $MaRequete );
    $STH -> execute();
    $i = 0;
    $val = TRUE;
    


$MaRequete2 = "INSERT INTO `statisqueenigme` (`eng_id`, `temps`, `equipe`) VALUES";

while($data = $STH->fetch()) {
    $MaRequete2 +="('".$data['eng_id']."','".$data['temps']."','".$_SESSION['login']."', '1', '0')"
}
    $STH2 = $BDD -> prepare( $MaRequete );
    $STH2 -> execute();

$_SESSION['eng_id'] = NULL;
$_SESSION['eg_id'] = NULL;
$_SESSION['eng_time'] = NULL;




header('Location:index.php');