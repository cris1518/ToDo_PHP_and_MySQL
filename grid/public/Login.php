<?php require "../private/init.php";?>

<!DOCTYPE html>
<html lang="en">
<?php  require WWW_PRIVATE."/include/head.php"; ?>

<body>






  <div class="login">
    <div class="login-triangle"></div>

    <h2 class="login-header">Log in</h2>
    <form class="login-container" method='post'
      action='<?php $_SERVER['PHP_SELF'] ?>Login.php'
      id='form1'>
      <p><input name='Username' type="text" placeholder="Username"></p>
      <p><input name='Password' type="password" placeholder="Password"></p>
      <p><input type="submit" value="ACCEDI"></p>
      <p><a href='Register.php' style='text-decoration:none;'><input type="button" onclick='location.href="" '
            value="REGISTRATI"></a></p>
    </form>
  </div>









  <?php

if (isset($_POST['Username']) & !empty($_POST['Username'])) {
    $username=$_POST['Username'];
    $password=$_POST['Password'];
    //CHECK DATA
    $vcheck=checkPassword($DB, $username, $password);
 
    if ($vcheck) {
        genToken($DB, $username);
        echo '<script>location.href="'.WWW_PUBLIC.'/index.php"</script>';
    } else {
    }
} else {
}

?>
</body>

</html>