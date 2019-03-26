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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="console w-100 mh-100">
                        Ship >> Loading Emergency Module ... </br>
                        Ship >> Do not Panic.
                    </div>
                    <div class="mh-100" style="width: 100px; height: 200px; background-color: rgba(0,0,255,0.1);">Max-height 100%</div>
                </div>
                <div class="col-md-5 d-flex">
                </div>
        </div>
        <div class="row">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 40%">
        </div>
        </div>
        <?php require_once("includes/footer.php");?>
        <?php require_once("includes/script.php"); ?>
    </div>
</body>

</html>