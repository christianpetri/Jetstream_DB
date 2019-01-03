<?php
include($_SERVER["DOCUMENT_ROOT"] . "/../database/connect.php");


if (
    isset($_POST['serviceauftragId']) &&
    isset($_POST['serviceauftragKundenname']) &&
    isset($_POST['serviceauftragEmail']) &&
    isset($_POST['serviceauftragTelefon']) &&
    isset($_POST['statusId'])
) {
    $DB->updateServiceDataForServiceIdInDB(
        $_POST['serviceauftragId'],
        $_POST['serviceauftragKundenname'],
        $_POST['serviceauftragEmail'],
        $_POST['serviceauftragTelefon'],
        $_POST['statusId']
    );
    header("Location: https://www.jetstream.christianpetri.ch/?update=1"); /* Redirect browser */

} else {
    if (isset($_POST['updateService'])) {
        header("Location: https://www.jetstream.christianpetri.ch/?update=0"); /* Redirect browser */
    } else {
        header("Location: https://www.jetstream.christianpetri.ch/"); /* Redirect browser */
    }
}
/* Make sure that code below does not get executed when we redirect. */
exit;
