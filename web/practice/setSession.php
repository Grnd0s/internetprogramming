<?php 
session_start();

$_SESSION['Mindset'] = "J'ai le Seum";

?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?= $_SESSION['Mindset'] ?>
    </body>
</html>