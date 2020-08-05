<?php

function SelectedMenu($string)
{
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if ($string=="index.php" & $_SERVER['REQUEST_URI']==="/grid/public/") {
        return "selected";
    } else {
        if (strpos($url, $string) !== false) {
            return "selected";
        } else {
            return "" ;
        }
    }
}

function DBConnect($ser, $port, $user, $pass, $dbname)
{
    $connection=mysqli_connect($ser.":".$port, $user, $pass, $dbname);
    return $connection;
}

function DBDisconnect($connection)
{
    mysqli_close($connection);
}


function DBGetToDo($DB, $USER, $compl)
{
    $qry='SELECT * FROM todo WHERE User='.$USER["id"].' AND Completed='.$compl.';';
    $result=mysqli_query($DB, $qry);
    if (mysqli_num_rows($result)>0) {
        return $result;
    } else {
        return false;
    }
}

function DBCreateToDoSeq($DB)
{
    $qry='INSERT INTO todo_seq (id,Last) VALUES (1,NOW())';
    $result=mysqli_query($DB, $qry);
}


  function DBIncrementToDoSeq($DB, $seq)
  {
      $oldseq=DBGetToDoSeq($DB);
      $qry="UPDATE todo_seq SET id=$seq, Last=NOW() WHERE id=$oldseq; ";
      $result=mysqli_query($DB, $qry);
  }


function DBGetToDoSeq($DB)
{
    $qry='SELECT * FROM todo_seq';
    $result=mysqli_query($DB, $qry);
 
    if (mysqli_num_rows($result)>0) {
        $id=0;
        while ($row = $result->fetch_assoc()) {
            $id=$row["id"];
        }
        return $id;
    } else {
        DBCreateToDoSeq($DB);
        return 1;
    }
}



  function DBCreateRowSeq($DB)
  {
      $qry='INSERT INTO rows_seq (id,Last) VALUES (1,NOW())';
      $result=mysqli_query($DB, $qry);
  }
  
  
    function DBIncrementRowSeq($DB, $seq)
    {
        $oldseq=DBGetRowSeq($DB);
        $qry="UPDATE rows_seq SET id=$seq, Last=NOW() WHERE id=$oldseq; ";
        $result=mysqli_query($DB, $qry);
    }
  
  
  function DBGetRowSeq($DB)
  {
      $qry='SELECT * FROM rows_seq';
      $result=mysqli_query($DB, $qry);
   
      if (mysqli_num_rows($result)>0) {
          $id=0;
          while ($row = $result->fetch_assoc()) {
              $id=$row["id"];
          }
          return $id;
      } else {
          DBCreateRowSeq($DB);
          return 1;
      }
  }


function DBCreateToDo($DB, $title, $descr, $USER)
{
    $seq=intval(DBGetToDoSeq($DB));
    $nseq=$seq+1;
    $qry="INSERT INTO todo (id,Title,ShDescr,Completed,User,Background) VALUES ($nseq,'$title','$descr',0,".$USER["id"].",' '); ";
    echo $qry;
    $result=mysqli_query($DB, $qry);
    echo "<h1>".$nseq."</h1>";
    DBIncrementToDoSeq($DB, $nseq);
    echo '<script>location.href="'.WWW_PUBLIC.'"</script>';
}

function DBDeleteToDo($DB, $id)
{
    $qry="DELETE FROM todo  WHERE id=$id; ";
    $result=mysqli_query($DB, $qry);
}


function DBSearchToDo($DB, $id)
{
    $qry="SELECT * FROM todo WHERE id=$id; ";
    $result=mysqli_query($DB, $qry);
    return $result;
}


function DBUpdateToDo($DB, $title, $descr, $todo)
{
    $seq=intval(DBGetToDoSeq($DB));
    $nseq=$seq+1;
    $qry="UPDATE todo SET Title='$title',ShDescr='$descr'   WHERE   id=$todo ; ";
  
    $result=mysqli_query($DB, $qry);
}

function DBSGetToDoVoices($DB, $id)
{
    $qry="SELECT * FROM todo_rows WHERE Todo_id=$id; ";
    $result=mysqli_query($DB, $qry);
    return $result;
}


function DBCompletedToDo($DB, $todo)
{
    $qry="UPDATE todo SET Completed=1   WHERE   id=$todo ; ";
    $result=mysqli_query($DB, $qry);
}




function DBCreateRow($DB, $title, $checked, $todo)
{
    $seq=intval(DBGetRowSeq($DB));
    $nseq=$seq+1;
    $qry="INSERT INTO todo_rows(id,Title,Todo_id,Checked) VALUES ($nseq,'$title',$todo,$checked); ";
    $result=mysqli_query($DB, $qry);
   
    DBIncrementRowSeq($DB, $nseq);
}


function DBUpdateRow($DB, $title, $checked, $row)
{
    $seq=intval(DBGetToDoSeq($DB));
    $nseq=$seq+1;
    $qry="UPDATE todo_rows SET Title='$title',Checked=$checked   WHERE   id=$row ; ";
    echo $qry;
    $result=mysqli_query($DB, $qry);
}

function DBDeleteRow($DB, $id)
{
    $qry="DELETE FROM todo_rows WHERE id=$id; ";
    $result=mysqli_query($DB, $qry);
}


function PrepareToDo($DB, $USER, $compl)
{
    $todo=DBGetToDo($DB, $USER, $compl);
    $html="";
    $empty3='<div style="width:80%;padding:30px;background:#064786;color:#fff;border-radius:5px;">
<img src="img/nodata.png" style="width:130px;float:right;"> 
<h1>Lista ToDo Vuota</h1>
<h4>Crea una nuova lista <label class="empty-add" for="modal-2"><i class="fas fa-plus"></i></label>  </h4>  
</div>';
    $empty2='<div style="width:300px;padding:30px;background:#064786;color:#fff;border-radius:5px;text-align:center">

<h1 style="font-size: 1.2em;">Nessuna ToDo Archiviata</h1> <br>
<img src="img/nodata.png" style="width:130px; "> 
</div>';
    $empty='<div style="width:300px;padding:30px;background:#064786;color:#fff;border-radius:5px;text-align:center">

<h1 style="font-size: 1.2em;">Elenco ToDo Vuoto</h1> <br>
<img src="img/nodata.png" style="width:130px; "> 
<h4>Crea una nuova lista <label class="empty-add" for="modal-2"><i class="fas fa-plus"></i></label>  </h4>  

</div>';
 
    if ($todo==false & $compl==0) {
        return $empty;
    } elseif ($todo==false & $compl==1) {
        return $empty2;
    } else {
        while ($row = $todo->fetch_assoc()) {
            $id=$row["id"];
            $title=$row["Title"];
            $descr=$row["ShDescr"];
            $html.= "<div  class='box'>
 <div class='ToDo-Del-Cont'> <i class='fas fa-minus' onclick='jsDelToDo($id)'></i></div>
 ";
            if ($compl==0) {
                $html.="<div class='ToDo-Del-Cont'>  <i class='fas fa-archive' onclick='jsComplToDo($id)'></i> </div>";
            }
            $html.="
  <h2 style='display:inline-block;'><a style='text-decoration:none;color:#fff;' href='./todo.php?todo=$id'>&nbsp;$title</a></h2>
   <br>
  <span class='shdescr'>$descr</span>
  </div>";
        }
  
        $html=trim(preg_replace('/\s+/', ' ', $html));
        //echo '<script>reloadToDo("'.$html.'")</script>';
        return $html;
    }
}


function PrepareNavToDo($DB, $USER, $compl)
{
    $todo=DBGetToDo($DB, $USER, $compl);
    $html="<ul>";
    if ($todo==false) {
        return "";
    } else {
        while ($row = $todo->fetch_assoc()) {
            $id=$row["id"];
            $title=$row["Title"];
            //<i class='cont'>$cont</i> &nbsp;
            $html.= "<li class='nav-item'>  &nbsp;<a href='Todo.php?todo=$id'> $title</a></li>";
        }
        $html.='</ul>';
        $html=trim(preg_replace('/\s+/', ' ', $html));
        //echo '<script>reloadToDo("'.$html.'")</script>';
        return $html;
    }
}
  
function isValidEmail($email)
{

// Remove all illegal characters from email
    $email2 = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate email
    if (filter_var($email2, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function isValidUsername($DB, $username)
{
    $qry="SELECT COUNT(id) FROM users WHERE Username='$username'; ";
    $result=mysqli_query($DB, $qry);
    $count=$result->fetch_row();
 
    if (intval($count[0])>0) {
        return false;
    } else {
        return true;
    }
}

function isValidPassword($password, $confpassword)
{
    return strcmp($password, $confpassword);
}

function checkPassword($DB, $username, $password)
{
    $qry="SELECT Password FROM users WHERE Username='$username' ; ";
    $result=mysqli_query($DB, $qry);
    $count=$result->fetch_row();
    $psstor=$count[0];
    $check=password_verify($password, $psstor);
    if ($check) {
        return true;
    } else {
        return false;
    }
}


function isLoggedIn()
{
    if (isset($_COOKIE['SesToken']) & !empty($_COOKIE['SesToken'])) {
    } else {
        echo '<script>location.href="'.WWW_PUBLIC.'/Login.php"</script>';
    }
}

function LogOut()
{
    setcookie("SesToken", false);
    echo '<script>location.href="'.WWW_PUBLIC.'/Login.php"</script>';
}

function getUserInfo($DB, $token)
{
    $qry="SELECT * FROM users WHERE SesToken='$token'; ";
    $result=mysqli_query($DB, $qry);
    $array=$result->fetch_assoc();
    return $array;
}

 
function getToken()
{
    return $_COOKIE['SesToken'];
}

function genToken($DB, $username)
{
    $string = bin2hex(random_bytes(10));
    $qry="UPDATE users SET SesToken='$string' WHERE   Username='$username' ; ";
    $result=mysqli_query($DB, $qry);
    setcookie("SesToken", $string, time() +2592000);
}


function RegUser($DB, $firstname, $lastname, $email, $username, $password)
{
    $seq=intval(DBGetRowSeq($DB));
    $nseq=$seq+1;
    $qry="INSERT INTO users(FirstName,LastName,Email,Username,Password) VALUES ('$firstname','$lastname','$email','$username','$password'); ";
    $result=mysqli_query($DB, $qry);
    echo '<script>location.href="'.WWW_PUBLIC.'"</script>';
}
