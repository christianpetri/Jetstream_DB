<?php
 	 date_default_timezone_set('Europe/London');
    include("connect.php");
?>
<html lang="en">
   <head>
      <title>Jetstream</title>
       <style type="text/css">
           html{
               background-color:black;
           }
           body{
               padding: 20px;
               max-width: 1000px;
               margin:auto;
               background-color: white;
           }

            table.result {
                border-collapse: collapse;
            }

            table.result th {
                border: 1px solid black;
                padding: 5px;
            }
           table.result td{
                border: 1px solid black;
                padding: 5px;
            }

       </style>
   </head>
<body>
      <h1>Jetstream</h1>
      <p> if you see Array ( [0] => Array ( [@@version] => ... ) ) below that means the db connection is working</p>
<?php
    $result = $DB->getHelloWorld();
   echo print_r($result);
?>
<p>Version 1</p>
</body>
</html>