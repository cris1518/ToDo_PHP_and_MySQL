 <?php require "../private/init.php";
 
 
 ?>
 <!DOCTYPE html>
 <?php require WWW_PRIVATE."/include/head.php" ?>

 <body>

     <?php

require WWW_PRIVATE . "/include/header.php";
 
//getVoices($name);
$attr=$_GET;
$id=$attr["todo"];
$todo=DBSearchToDo($DB, $id);
while ($row = $todo->fetch_assoc()) {
    $title=$row["Title"];
    $todoid=$row["id"];
    $descr=$row["ShDescr"];



    $html="<div class='tod-cont'>" ;
    $html.="<form method='post' action='".$_SERVER['PHP_SELF']."?todo=$id' class='box' id='form1' >
        <div class='todo-info'>
        <div>
        <h2>Nome</h2>
        <input class='inp-todo inp-todo-title' name='ToDoTitle' style='display:inline-block;' value='$title' ></input>
    </div>
      <div>
        <h2>Descrizione</h2>
        <input class='inp-todo inp-todo-descr' name='ToDoDescr' style='display:inline-block;' value='$descr' ></input>
      
        </div>
        </div>
        <br>
        <h2 style='display:inline-block;margin-right:10px;'>Elenco</h2> <button type='button' class='btn btn-bl' onclick='newToDo()'>AGGIUNGI</button>
        <div class='todo-page-container'>
       
        ";

    $voices=DBSGetToDoVoices($DB, $id);
    while ($voice = $voices->fetch_assoc()) {
        $title=$voice["Title"];
        $checked=$voice["Checked"]>0 ? "checked":"";
        $checkedv=$voice["Checked"]>0 ? "1":"0";
        $row_id=$voice["id"];
        $html.=   "<div>
            
           <div class='ckcont'>
           
           <input type='hidden' name='RwIds[]' value='$row_id'>
           <input type='hidden' name='ListCheck[]' value='$checkedv'><input $checked class='ck' type='checkbox' onclick='this.previousSibling.value=1-this.previousSibling.value'>
         
            </div><div class='ckcont' >
            <input  id='RWI$row_id' class='VoiceTitle' type='text' name='ListVoice[]' value='$title' onkeypress='updateInput(this.value,\"RWI$row_id\")' ></input></div>
            
            <input type='hidden' id='RW$row_id'>
            <button style='padding-bottom: 1.8em;' class='empty-btn' type='button' onclick=jsDelToDoRow($row_id)  ><i class='fas fa-trash'></i></button>
            
            </div> 
      ";
    }
         
    $html.=" </div> 
        
        <div class='menu-action'>
        <button class='btn btn-gr' type='submit'>SALVA</button>
        <button class='btn btn-rd' type='button' onclick=jsDelToDoFPage($id)>ELIMINA</button>
        <button class='btn btn-bl' type='button' onclick=jsComplToDo($id)>ARCHIVIA</button>
       
        </div>
        
        </form>";
    $html.="</div>";
    echo $html;
}

       ?>







 </body>

 </html>
 <?php

 if (isset($_POST) & !empty($_POST)) {
     $id=$_GET["todo"];
     $title=$_POST["ToDoTitle"];//To Do Title
     $descr=$_POST["ToDoDescr"];
     $VoiceNames=$_POST["ListVoice"];
     $VoiceChecks=$_POST["ListCheck"];
     $VoiceIds=$_POST["RwIds"];
     $DeleteRows=$_POST["DelRows"];
     $NewVoiceNames=$_POST["NewListVoice"];
     $NewVoiceChecks=$_POST["NewListCheck"];

     //UPDATE TODO DATA
     DBUpdateToDo($DB, $title, $descr, $id);

     //CHECK NEW TODO ROWS
     if (isset($NewVoiceNames)) {
         for ($i=0;$i<count($NewVoiceNames);$i++) {
             $Vtitle=$NewVoiceNames[$i];
             $Vchecked=$NewVoiceChecks[$i];
             DBCreateRow($DB, $Vtitle, $Vchecked, $id);
         }
     }


     //UPDATE EXISTING ROWS
     if (isset($VoiceNames)) {
         for ($i=0;$i<count($VoiceNames);$i++) {
             $Vtitle=$VoiceNames[$i];
             $Vchecked=$VoiceChecks[$i];
             $rowcnt=$VoiceIds[$i];
             DBUpdateRow($DB, $Vtitle, $Vchecked, $rowcnt);
         }
     } else {
     }
    
  
     echo '<script>location.href ="index.php"</script>';
 }
