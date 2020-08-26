<?php
require "../init.php";
    $title = str_replace("'", "`", $_GET["Name"]);
    $descr = str_replace("'", "`", $_GET["Descr"]);
    DBCreateToDo($DB, $title, $descr, $USER);
    echo $title." ".$descr;
