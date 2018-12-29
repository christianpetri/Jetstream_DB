<?php
include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/common.php");

printHeader("Serviceauftrag erfassen");

$status = $DB->getStatusDataFormDB();
$statusOptions = '';

foreach ($status as $key => $value) {
    $statusOptions .= '<option value="' . htmlspecialchars($status[$key]['status_id']) . '">' . ($status[$key]['status_name']) . '</option>';
}

$dienstleistung = $DB->getDienstleistungDataFromDB();
$dienstleistungOptions = '';

foreach ($dienstleistung as $key => $value) {
    $dienstleistungOptions .= '<option value="' . htmlspecialchars($dienstleistung[$key]['dienstleistung_id']) . '">' . ($dienstleistung[$key]['dienstleistung_name']) . '</option>';
}

$prioritaet = $DB->getPrioritaetDataFormDB();
$prioritaetOptions = '';

foreach ($prioritaet as $key => $value) {
    $prioritaetOptions .= '<option value="' . htmlspecialchars($prioritaet[$key]['prioritaet_id']) . '">' . ($prioritaet[$key]['prioritaet_name']) . '</option>';
}


?>
    <form method="post" action="/serviceauftrag/controller.php">
        <input type="hidden" name="createNewService" value="1"/>
        <label>Kundenname</label>
        <input name="serviceauftragKundenname" type="text" value="" required/>
        <label>E-Mail</label>
        <input name="serviceauftragEmail" type="email" required/>
        <label>Telefon</label>
        <input name="serviceauftragTelefon" type="text"/>
        <label>Status</label>
        <select required name="statusId">
            <option value=""/>
            <?php echo $statusOptions ?>
        </select>
        <label>Dienstleistung</label>
        <select required name="dienstleistungId" value="">
            <option value=""/>
            <?php echo $dienstleistungOptions ?>
        </select>
        <label>Prioritaet</label>
        <select required name="prioritaetId" value="">
            <option value=""/>
            <?php echo $prioritaetOptions ?>
        </select>
        <input type="submit" value="Abschicken"/>
    </form>

<?php


printFooter();

/*Die Mitarbeiter sollen die Möglichkeit haben einen neuen Serviceauftrag über ein Formular zu
erfassen. Ein Serviceauftrag muss folgende Informationen beinhalten:
- Kundenname .
- Email .
- Telefon .
- Priorität .
- Status .
- Dienstleistung . (Angebot), siehe nachfolgende Auflistung. Pro Serviceauftrag kann immer nur
eine Dienstleistung zugeordnet werden.


Die Priorität bestimmt die Anzahl der Tage der Servicearbeit, bis die Skis zur Abholung wieder
bereitgestellt werden.
Priorität Zusätzliche Tage Total Tage bis zur Fertigstellung
Tief +5 12
Standard 0 7
Express -3 4
Das Startdatum eines Auftrags ist immer das aktuelle Datum der Serviceerfassung. Das Datum der
Fertigstellung soll bei der Auftragserfassung angezeigt, aber nicht verändert werden.


*/