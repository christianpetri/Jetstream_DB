<?php
include($_SERVER["DOCUMENT_ROOT"] . "/common.php");
printHeader("post");
echo $_POST['serviceauftragId'];
echo '<br/>';
echo $_POST['serviceauftragKundenname'];
echo '<br/>';
echo $_POST['serviceauftragEmail'];
echo '<br/>';
echo $_POST['serviceauftragTelefon'];
echo '<br/>';
echo $_POST['statusId'];


/*
update serviceauftrag
set serviceauftrag_id =1,
serviceauftrag_kundenname ='walter weiss',
serviceauftrag_email='walter@weiss.ch',
serviceauftrag_telefon='0797941234',
status_id =4
where serviceauftrag_id =1
    ";
*/
printFooter();