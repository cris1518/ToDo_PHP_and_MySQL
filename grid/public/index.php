<?php
require "../private/init.php";
$tdhtml=PrepareToDo($DB, $USER, 0);
$nav=PrepareNavToDo($DB, $USER, 0);
  
?>
<!DOCTYPE html>

<html class="no-js">

<?php require WWW_PRIVATE."/include/head.php" ?>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php
require WWW_PRIVATE . "/include/header.php"
?>






    <section class="el-container">

        <nav class="cont-left">
            <div class="user-container">

                <img src="<?php  echo GetUsrImg($DB, $USER['id']); ?>"
                    class="usr-img">
                <div class="usr-img-up">
                    <label for="modal-1">
                        <div class="usr-img-cont" for="modal-1">
                            CARICA&nbsp;&nbsp;<i class='fas fa-upload'> </i></div>
                    </label>
                </div>
                <h4 class="user-name"><?php echo $USER['Username']; ?>
                </h4>


            </div>

            <?php echo $nav ?>
            <ul>





            </ul>

        </nav>


        <div class="cont-right">



            <table style="width:100%;">
                <tr>
                    <td class="td-title">
                        <h1><i class="fas fa-clipboard-list"></i> Elenco ToDo</h1>
                    </td>
                    <td class="td-add"><label onclick="ClearAlert('TDForm')" class="btn-add" for="modal-2"><i
                                class="fas fa-plus"></i></label></td>
                </tr>
            </table>
            <div class="grid" id="grid">

                <?php echo $tdhtml ?>

            </div>



        </div>

    </section>


    <input class="modal-state" id="modal-2" type="checkbox" />




    <div class="modal">
        <label class="modal__bg" for="modal-2"></label>
        <div class="modal__inner">
            <header class="modal__header">
                <label class="modal__close" for="modal-2"></label>
                <h2> New ToDo</h2>
            </header>
            <form method="post"
                action="<?=$_SERVER['PHP_SELF']; ?>"
                id='TDForm'>
                <table>
                    <tr>
                        <td>
                            Nome ToDo:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id='title'></span>
                            <input name="ToDoName" type="text" id="NewTodo" class="inpt" style="width:90% !important;"
                                maxlength='20'></input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Descrizione:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id='descr'></span>

                            <input name="ToDoDescr" type="text" id="TodoDescr" class="inpt"
                                style="width:90% !important;" maxlength='100'></input>
                        </td>
                    </tr>
                </table>
                <div class="modal__save" for="modal-2">
                    <button type="button" onclick="CreateToDo() " class="empty-btn"> <i class="mdsave fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <input class="modal-state" id="modal-1" type="checkbox" />
    <div class="modal   modal_img">
        <label class="modal__bg" for="modal-1"></label>
        <div class="modal__inner">
            <header class="modal__header">
                <label class="modal__close" for="modal-1"></label>
                <h2>CARICA IMMAGINE PROFILO</h2>
            </header>
            <form method="POST" action="Upload.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            Carica File:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="userfile" id="userfile" class="inpt" type="file" value="" style="width:100%;"
                                maxlength='20'></input>
                        </td>
                    </tr>
                </table>
                <div class="modal__save" for="modal-1">
                    <button type="submit" class="empty-btn"> <i class="mdsave fas fa-upload"></i> </button>
            </form>
        </div>
    </div>





    <?php
 print_r($_FILES['userfile']);
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    echo 'Non hai inviato nessun file...';
    exit;
}

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'C:/xampp2/usrimg/';

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
    //Se l'operazione è andata a buon fine...
    echo 'File inviato con successo.';
} else {
    //Se l'operazione è fallta...
    echo 'Upload NON valido!';
}

?>

    <?php

if ($_GET) {
} elseif ($_POST) {
    $title = str_replace("'", "`", $_POST["ToDoName"]);
    $descr = str_replace("'", "`", $_POST["ToDoDescr"]);
    DBCreateToDo($DB, $title, $descr, $USER);
}
?>


    <?php

require WWW_PRIVATE . "/include/footer.php"
?>
</body>


</html>