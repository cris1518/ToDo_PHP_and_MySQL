<?php
require "../init.php";
$compl=$_GET["Compl"];
$todo=DBGetToDo($DB, $USER, $compl);
$tdhtml=PrepareToDo($DB, $USER, $compl);
echo $tdhtml;
