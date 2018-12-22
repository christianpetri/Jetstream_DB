<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/common.php");
printHeader("Test");
?>
    <p> If you see Array ( [0] => Array ( [@@version] => ... ) ) below that means the db connection is working</p>
<?php
$result = $DB->getHelloWorld();
echo print_r($result);
?>
    <br/>
<?php
echo print_r($DB->getServiceDataFromDB());
?>
    <br/>
<?php
$result = $DB->select("select * from prioritaet");
echo print_r($result);
?>
    <br/>
<?php
$result = $DB->select("select * from serviceauftrag");
echo print_r($result);

?>
    <br/>
<?php
$result = $DB->select("select * from status");
echo print_r($result);
?><br/>
<?php
echo print_r($DB->getServiceDataForServiceIdFromDB($_GET['id']));

?>

<?php
printFooter();
/*
serviceauftrag_id
serviceauftrag_kundenname
serviceauftrag_email
serviceauftrag_telefon

dienstleistung_id
dienstleistung_name

prioritaet_id
prioritaet_name
prioritaet_zusaetzliche_tage
prioritaet_tage_bis_zur_fertigstellung

status_id
status_name
*/
