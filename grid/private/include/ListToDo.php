<?php
require "../init.php";
$todo=DBGetToDo($DB, $USER, 0);
$array=[];
     while ($row = $todo->fetch_assoc()) {
         $array[]=$row;
     }
     echo json_encode($array);
