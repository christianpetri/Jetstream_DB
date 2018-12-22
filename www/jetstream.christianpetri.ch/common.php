<?php
date_default_timezone_set('Europe/London');
function printHeader($title){
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <style type="text/css">
        html {
            background-color: black;
        }

        body {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
            background-color: white;
        }

        table.result {
            border-collapse: collapse;
        }

        table.result th {
            border: 1px solid black;
            padding: 5px;
        }

        table.result td {
            border: 1px solid black;
            padding: 5px;
        }

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

