<?php
require "../init.php";
if (isset($_GET)) {
    $id=$_GET["todo"];
    DBDeleteToDo($DB, $id);
    echo 'SI';
} else {
    echo 'NO';
}

?> 