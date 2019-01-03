<?php
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../database/connect.php";
include DOCUMENT_ROOT . "/../common/common.php";
include DOCUMENT_ROOT . "/../function/printServiceTable.php";
include DOCUMENT_ROOT . "/../function/printMessage.php";

printHeader("Jetstream");
printMessage();
?>
    <h1>Willkomen bei Jetstream</h1>
    <p><button><a href="/serviceauftrag/erfassen/">Neuer Service erfassen</a></button></p>

<?php

printServiceTable($DB->getServiceDataFromDB());

printFooter();
