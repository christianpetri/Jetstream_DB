<?php
date_default_timezone_set('Europe/London');
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
function printHeader($title){
?>
    <!doctype html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title><?php echo $title; ?></title>
    <style type="text/css">
        <?php
            echo file_get_contents(DOCUMENT_ROOT . '/../css/main.css');
            echo file_get_contents(DOCUMENT_ROOT . '/../css/form.css');
            echo file_get_contents(DOCUMENT_ROOT . '/../css/message.css');
            echo file_get_contents(DOCUMENT_ROOT . '/../css/message.css');
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
<?php } ?>

