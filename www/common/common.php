<?php
date_default_timezone_set('Europe/London');
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../css/style.php";

function printHeader($title){
?>
<!doctype html>
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title><?php echo $title; ?></title>
        <style type="text/css">
            <?php
            printStyle();
            ?>
        </style>
    </head>
    <body>
<?php
} ?>

<?php
function printFooter(){
?>
    </body>
</html>
<?php
}