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
    
    if($data['temps'] != 0) {
        if($i!=0) $MaRequete2 .=",";
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
    $STH2 = $BDD -> prepare( $MaRequete2 );
    $STH2 -> execute();
    $STH2 = NULL;
     
$_SESSION['eng_time'] = NULL;

?>

<body>
    <div class="background">
        <?php
            require_once("includes/nav.php");
            require_once("includes/connect.php");
        ?>

        <div class="container_login_register">
        
        <?php
            if($BDD){
                $MaRequete_stats = "Select * From statistiqueenigme WHERE equipe ='".$_SESSION['login']."';";

                $sth_stats = $BDD -> prepare($MaRequete_stats);
                $sth_stats -> execute();

                $result_contenu_stats = $sth_stats -> fetchAll();
            }
        ?>
       
        <div class="d-flex justify-content-center h-100">
            <div class="card_login">
                
                <div class="card-header">
                    <h3>Partie Terminée</h3>
                </div>
                
                <div class="card-body bg-warning rounded">
                    <?php
                        if(count($result_contenu_stats) != 0){
                            $somme = 0;
                            for($it=0;$it<count($result_contenu_stats);$it++){
                                $somme += $result_contenu_stats[$it]['temps'];
                            }
                            $moyenne = $somme / count($result_contenu_stats);
                            echo "<p>Moyenne totale des énigmes : " . $moyenne . " secondes.</p>";
                            echo "Bravo à l'équipe de ".$_SESSION['login'].",</br> voici vos scores sauvegardés :</br></br>";
                            foreach($result_contenu_stats as $result) {
                                if ($result['equipe'] == $_SESSION['login']) {
                                    echo "Enigme ".$result['eng_id']." : ".$result['temps']." secondes </br>";
                                }
                            }

                        }else{
                            echo "<p>Aucune donnée n'est stockée, les statistiques ne sont donc pas disponibles.</p>";
                        }
                    ?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center ">
                        Merci d'avoir participé !
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary" href="index.php">Terminé</a>
                    </div>
                </div>
                
            </div>
        </div>
        </div>

    </div>
    <?php
            $_SESSION['eng_id'] = NULL;
            $_SESSION['eg_id'] = NULL;
        require_once("includes/footer.php");
        require_once("includes/script.php");

    ?>
</body>
</html>



