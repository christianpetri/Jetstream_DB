<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/common.php");

printHeader("Serviceauftrag");

$status = $DB->getStatusDataFormDB();
$statusOptions = '';

$result = $DB->getServiceDataForServiceIdFromDB(htmlspecialchars($_GET['id']));

foreach ($status as $key => $value) {
    $statusOptions .= '<option value="' . htmlspecialchars($status[$key]['status_id']) . '"';
    if( htmlspecialchars($status[$key]['status_name']) ==  htmlspecialchars($result[0]['status_name'])){
        $statusOptions .= ' selected';
    }
    $statusOptions .= '>' . ($status[$key]['status_name']) . '</option>';
}

?>
    <form method="post" action="/serviceauftrag/controller.php">
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
        <input type="submit" value="Abschicken"/>
    </form>

<?php
printFooter();

