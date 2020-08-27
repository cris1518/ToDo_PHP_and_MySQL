<?php
require "../init.php";
    $title = str_replace("'", "`", $_GET["Name"]);
    $descr = str_replace("'", "`", $_GET["Descr"]);
    $errors=[];
    if ($title=="") {
        $errors[]="title*Campo Titolo Vuoto";
    }

       if (strlen($title)<5 & strlen($title)>0) {
           $errors[]="title*Campo Titolo Troppo Corto";
       }


    if ($descr=="") {
        $errors[]="descr*Campo Descrizione Vuoto";
    }

        if (strlen($descr)<10 & strlen($descr)>0) {
            $errors[]="descr*Campo Descrizione Troppo Corto";
        }



    if (count($errors)>0) {
    } else {
        DBCreateToDo($DB, $title, $descr, $USER);
    }
        echo json_encode(["errors"=>$errors]);
