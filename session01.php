<?php

session_start();

$sid = session_id();

echo $sid;

$_SESSION["name"] ="吉井";
$_SESSION["age"]=29;

?>

