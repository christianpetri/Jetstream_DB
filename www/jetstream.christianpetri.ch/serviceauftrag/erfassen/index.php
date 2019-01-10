<?php
include($_SERVER["DOCUMENT_ROOT"] . "/../database/connect.php");
include($_SERVER["DOCUMENT_ROOT"] . "/../common/common.php");

printHeader("Serviceauftrag erfassen");

$date = date_create('now', timezone_open('Europe/Paris'))->format('Y-m-d H:i:s');

$status = $DB->getStatusDataFormDB();
$statusOptions = '';
define('OPTION_VALUE', '<option value="');
define('OPTION', '</option>');
foreach ($status as $key => $value) {
    $statusOptions .= OPTION_VALUE . htmlspecialchars($status[$key]['status_id']) . '">' . ($status[$key]['status_name']) . OPTION;
}

$dienstleistung = $DB->getDienstleistungDataFromDB();
$dienstleistungOptions = '';

foreach ($dienstleistung as $key => $value) {
    $dienstleistungOptions .= OPTION_VALUE . htmlspecialchars($dienstleistung[$key]['dienstleistung_id']) . '">' . htmlspecialchars($dienstleistung[$key]['dienstleistung_name']) . OPTION;
}

$prioritaet = $DB->getPrioritaetDataFormDB();
$prioritaetOptions = '';

foreach ($prioritaet as $key => $value) {
    $prioritaetOptions .=
        OPTION_VALUE .
        htmlspecialchars($prioritaet[$key]['prioritaet_id']) .
        '">' .
        htmlspecialchars($prioritaet[$key]['prioritaet_name']) .
        ' bis am ' .
        date('d.m.Y', strtotime($date . ' + ' .
            htmlspecialchars($prioritaet[$key]['prioritaet_tage_bis_zur_fertigstellung']) . ' days'))
        . OPTION;
}

?>
    <form method="post" action="/serviceauftrag/erfassen/controller.php">
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
        <select required name="dienstleistungId">
            <option value=""/>
            <?php echo $dienstleistungOptions ?>
        </select>
        <label>Prioritaet</label>
        <select required name="prioritaetId" value="">
            <option value=""/>
            <?php echo $prioritaetOptions ?>
        </select>
        <input type="button" onclick="history.back();" value="Zurück">
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
Das Startdatum eines Auftrags ist immer das aktuelle Datum der Serviceerfassung.
Das Datum der Fertigstellung soll bei der Auftragserfassung angezeigt, aber nicht verändert werden.


*/