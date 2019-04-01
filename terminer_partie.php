<?php
    session_start();
    require_once("includes/fonction.php");
?>
<!doctype html>
<html>

<?php
    $pageTitle = "Connexion";
    require_once("includes/head.php");

include_once('includes/connect.php');
$MaRequete = "SELECT * FROM enigmecours WHERE equipe='".$_SESSION['login']."' ORDER BY eng_id";
    $STH = $BDD -> prepare( $MaRequete );
    $STH -> execute();
    $i = 0;
    $val = TRUE;
    


$MaRequete2 = "INSERT INTO `statistiqueenigme` (`eng_id`, `temps`, `equipe`) VALUES";
$i = 0;
while($data = $STH->fetch()) {
    if($i!=0) $MaRequete2 .=",";
    if($data['temps'] != 0) {
        $MaRequete2 .="('".$data['eng_id']."','".$data['temps']."','".$_SESSION['login']."')";
        $i++;
    }
}
if ($i != 0) {
    $MaRequete2 .="; DELETE FROM `escapegamecours` WHERE `eng_cours`= '".$_SESSION['login']."'; DELETE FROM `enigmecours` WHERE `equipe`= '".$_SESSION['login']."';";
}
else {
    $MaRequete2 ="DELETE FROM `escapegamecours` WHERE `eng_cours`= '".$_SESSION['login']."'; DELETE FROM `enigmecours` WHERE `equipe`= '".$_SESSION['login']."';";
}
echo $MaRequete2."</br>";
    $STH2 = $BDD -> prepare( $MaRequete2 );
    $STH2 -> execute();

     
$_SESSION['eng_id'] = NULL;
$_SESSION['eg_id'] = NULL;
$_SESSION['eng_time'] = NULL;

?>

<body>
    <div class="background">
    <?php
        require_once("includes/nav.php");
        require_once("includes/connect.php");
    ?>

    <div class="container_login_register">
        <div class="d-flex justify-content-center h-100">
        <?php if(!isset($_SESSION['login'])){ ?>
            <div class="card_login">
                <div class="card-header">
                    <h3>Partie Terminée</h3>
                </div>
                <div class="card-body">
                
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center ">
                        Merci d'avoir participé !
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn-primary" href="index.php">Terminé</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
        require_once("includes/footer.php");
        require_once("includes/script.php");
    ?>
</body>




