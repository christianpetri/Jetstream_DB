<?php
include($_SERVER["DOCUMENT_ROOT"] . "/../database/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/../common/common.php");

printHeader("Serviceauftrag");

$status = $DB->getStatusDataFormDB();
$statusOptions = '';
define('STATUS_NAME','status_name');
$result = $DB->getServiceDataForServiceIdFromDB(htmlspecialchars($_GET['id']));

foreach ($status as $key => $value) {
    $statusOptions .= '<option value="' . htmlspecialchars($status[$key]['status_id']) . '"';
    if( htmlspecialchars($status[$key][STATUS_NAME]) ==  htmlspecialchars($result[0][STATUS_NAME])){
        $statusOptions .= ' selected';
    }
    $statusOptions .= '>' . ($status[$key][STATUS_NAME]) . '</option>';
}

?>
    <form method="post" action="/serviceauftrag/bearbeiten/controller.php">
        <input type="hidden" name="updateService"
               value="1"/>
        <input type="hidden"
               name="serviceauftragId"
               value="<?PHP ECHO htmlspecialchars($result[0]['serviceauftrag_id']) ?>"
        />
        <input name="serviceauftragKundenname"
               type="text"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_kundenname']) ?>"
               required
        />
        <input name="serviceauftragEmail"
               type="email"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_email']) ?>"
               required
        />
        <input name="serviceauftragTelefon"
               type="tel"
               value="<?php echo htmlspecialchars($result[0]['serviceauftrag_telefon']) ?>"
        />
        <select name="statusId">
            <?php echo $statusOptions ?>
        </select>
        <input type="button" onclick="history.back();" value="Zurück">
        <input type="submit" value="Abschicken"/>
    </form>

<?php
printFooter();

