<?php
function printStyle()
{
    echo file_get_contents(DOCUMENT_ROOT . '/../css/main.css');
    echo file_get_contents(DOCUMENT_ROOT . '/../css/form.css');
    echo file_get_contents(DOCUMENT_ROOT . '/../css/message.css');
}

