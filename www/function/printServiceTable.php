<?php
function printServiceTable($data)
{
    $html = '<table class="result">';
    // header row
    $html .= '<tr>';
    $html .= '<th> Kundenname </th> <th> E-Mail </th> <th> Telefon </th> <th> Dienstleistung </th><th>Priorit&aumlt</th><th>Status</th><th></th>';
    $html .= '</tr>';
    // data rows
    foreach ($data as $key => $value) {
        $html .= '<tr>'.
            addTableData($data[$key]['serviceauftrag_kundenname']).
            addTableData($data[$key]['serviceauftrag_email']).
            addTableData($data[$key]['serviceauftrag_telefon']).
            addTableData($data[$key]['dienstleistung_name']).
            addTableData($data[$key]['prioritaet_name']).
            addTableData($data[$key]['status_name']);
        $html .= '<td>' . '<a href="/serviceauftrag/bearbeiten?id=' . htmlspecialchars($data[$key]['serviceauftrag_id']) . '">bearbeiten</td>';
        $html .= '</tr>';
    }
    // finish table and return it
    $html .= '</table>';
    echo $html;

}

function addTableData($value)
{
    return '<td>' . htmlspecialchars($value) . '</td>';
}