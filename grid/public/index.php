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
                <img src="<?php echo WWW_PUBLIC; ?>/img/user.png"
                    class="usr-img">
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
                    <td class="td-add"><label class="btn-add" for="modal-2"><i class="fas fa-plus"></i></label></td>
                </tr>
            </table>
            <div class="grid">

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
                action="<?=$_SERVER['PHP_SELF']; ?>">
                <table>
                    <tr>
                        <td>

                            ToDo Name:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="ToDoName" type="text" id="NewTodo" class="inpt" style="width:100%;"
                                maxlength='20'></input>
                        </td>
                    </tr>


                    <tr>
                        <td>

                            Description:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="ToDoDescr" type="text" id="TodoDescr" class="inpt" style="width:100%;"
                                maxlength='100'></input>
                        </td>
                    </tr>


                </table>




                <div class="modal__save" for="modal-2">

                    <button type="submit" class="empty-btn"> <i class="mdsave fas fa-save"></i> </button>
            </form>
        </div>





    </div>

    </div>
    </div>


    <?php
if ($_GET) {
} elseif ($_POST) {
    $title = str_replace("'", "`", $_POST["ToDoName"]);
    $descr = str_replace("'", "`", $_POST["ToDoDescr"]);
    DBCreateToDo($DB, $title, $descr, $USER);
    '<script>location.reload</script>';
}
?>


    <?php

require WWW_PRIVATE . "/include/footer.php"
?>
</body>


</html>