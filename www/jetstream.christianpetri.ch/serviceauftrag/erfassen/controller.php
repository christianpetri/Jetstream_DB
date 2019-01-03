<?php
include($_SERVER["DOCUMENT_ROOT"] . "/../database/connect.php");

if (
    isset($_POST['serviceauftragKundenname']) &&
    isset($_POST['serviceauftragEmail']) &&
    isset($_POST['serviceauftragTelefon']) &&
    isset($_POST['statusId']) &&
    isset($_POST['dienstleistungId']) &&
    isset($_POST['prioritaetId'])
) {
    $DB->addServiceDataToTheDB(
        $_POST['serviceauftragKundenname'],
        $_POST['serviceauftragEmail'],
        $_POST['serviceauftragTelefon'],
        $_POST['statusId'],
        $_POST['dienstleistungId'],
        $_POST['prioritaetId']
    );
    header("Location: https://www.jetstream.christianpetri.ch/?create=1"); /* Redirect browser */
} else {
    if (isset($_POST['createNewService'])) {
        header("Location: https://www.jetstream.christianpetri.ch/?create=0"); /* Redirect browser */
    } else {
        header("Location: https://www.jetstream.christianpetri.ch/"); /* Redirect browser */
    }
}
/* Make sure that code below does not get executed when we redirect. */
exit;
