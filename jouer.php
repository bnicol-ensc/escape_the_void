<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<body>
    <div class="background">
        <div class="container-fluid">
        <?php       
                require_once("includes/nav.php");
                require_once("includes/connect.php");
        ?>
            
        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>
    </div>
</body>

</html>