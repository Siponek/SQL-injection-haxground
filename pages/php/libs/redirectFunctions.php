<?php
function redirectToLogin(string $var): void
{
    header("refresh:2;url=../../index.html");
    echo $var;
    echo '
    <link rel="stylesheet" type="text/css" href="../../css/dimming.css">
    ';
// redirect to index.php after 5 seconds
    exit();}

?>