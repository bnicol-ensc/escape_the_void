<?php
    session_start();
?>

<!doctype html>
<html>

<?php
    require_once("includes/head.php");
?>

<body>
    <div class="container col-12">
        <?php
            require_once("includes/nav2.php");
            require_once("includes/connect.php");


            require_once("includes/footer.php");
        ?>
    </div>
    
    <?php require_once("includes/script.php"); ?>
</body>

</html>