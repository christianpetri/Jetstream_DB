<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/common.php");

printHeader("Serviceauftrag");

$status = $DB->getStatusDataFormDB();
$statusOptions = '';
foreach ($status as $key => $value) {
    $statusOptions .= '<option value="'.htmlspecialchars($status[$key]['status_id']) . '">' . ($status[$key]['status_name']) . '</option>';
}
$result = $DB->getServiceDataForServiceIdFromDB($_GET['id']);

?>
    <form method="post" action="/serviceauftrag/post.php">
        <input type="hidden" name="serviceauftragId" value="<?PHP ECHO htmlspecialchars($result[0]['serviceauftrag_id'])?>"/>
        <input name="serviceauftragKundenname" type="text"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_kundenname']) ?>"/>
        <input name="serviceauftragEmail" type="text"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_email']) ?>"/>
        <input name="serviceauftragTelefon" type="text"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_telefon']) ?>"/>
        <select name="statusId" value="<?php echo htmlspecialchars($result[0]['status_name']) ?>">
            <?php echo $statusOptions ?>
        </select>
        <input type="submit" value="Abschicken"/>
    </form>

<?php
printFooter();

