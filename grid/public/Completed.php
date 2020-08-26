<?php
require "../private/init.php";
$tdhtml=PrepareToDo($DB, $USER, 1);
$nav=PrepareNavToDo($DB, $USER, 1);
 
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
                        <h1><i class="fas fa-clipboard-list"></i> ToDo Archiviate</h1>
                    </td>
                    <td class="td-add"> </td>
                </tr>
            </table>
            <div class="grid" id="grid">

                <?php echo $tdhtml ?>

            </div>



        </div>

    </section>




    <?php

require WWW_PRIVATE . "/include/footer.php"
?>
</body>


</html>