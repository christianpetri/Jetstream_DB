<?php

function printMessage()
{
    $message = '';
    if (isset($_GET['update'])) {
        if (htmlspecialchars($_GET['update'])) {
            $message = '<div class="alert-box success" ><span > ERFOLGREICH: </span > Service geändert</div >';
        } else {
            $message = '<div class="alert-box error"><span>FEHLER: </span>Änderung fehlgeschlagen</div>';
        }
    } elseif (isset($_GET['create'])) {
        if (htmlspecialchars($_GET['create'])) {
            $message = '<div class="alert-box success" ><span> ERFOLGREICH: </span >Service erstellt</div >';
        } else {
            $message = '<div class="alert-box error"><span>FEHLER: </span>Service konnte nicht erfasst werden!</div>';
        }
    }
    echo $message;
}
