<?php

include ($_SERVER["DOCUMENT_ROOT"]."/connect.php");
include ($_SERVER["DOCUMENT_ROOT"]."/common.php");
include ($_SERVER["DOCUMENT_ROOT"]."/../function/printServiceTable.php");



printHeader("Jetstream");
?>
    <h1>Willkomen bei der Projektarbeit Jetstream</h1>

<?php
echo print_r($DB->getServiceDataFromDB());
echoHello();
printServiceTable($DB->getServiceDataFromDB());

printFooter();
