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
                <div class="col-md-7 d-flex">
                    <div class="console">
                        >>This is a test console message
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <input type="checkbox" disabled data-toggle="toggle" data-onstyle="warning">
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="warning">
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="warning">
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="danger">
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