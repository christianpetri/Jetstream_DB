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
    <div id="widthForm">
        <h1>Serviceauftrag bearbeiten</h1>
        <form method="post" action="/serviceauftrag/bearbeiten/controller.php">
            <input type="hidden"
                   name="serviceauftragId"
                   value="<?PHP ECHO htmlspecialchars($result[0]['serviceauftrag_id']) ?>"
            />
            <label>Kundenname</label>
            <input name="serviceauftragKundenname"
                   type="text"
                   value="<?php echo htmlspecialchars($result[0]['serviceauftrag_kundenname']) ?>"
                   required
            />
            <label>E-Mail</label>
            <input name="serviceauftragEmail"
                   type="email"
                   value="<?php echo htmlspecialchars($result[0]['serviceauftrag_email']) ?>"
                   required
            />
            <label>Telefon</label>
            <input name="serviceauftragTelefon"
                   type="tel"
                   value="<?php echo htmlspecialchars($result[0]['serviceauftrag_telefon']) ?>"
            />
            <label>Status</label>
            <select name="statusId">
                <?php echo $statusOptions ?>
            </select>
            <input type="button" onclick="history.back();" value="Zurück">
            <input type="submit" value="Abschicken"/>
        </form>
    </div>
<?php
printFooter();

