<?php require "../private/init.php";?>

<!DOCTYPE html>
<html lang="en">
<?php  require WWW_PRIVATE."/include/head.php"; ?>

<body class='bd-reg'>




  <div class="login regcont">
    <div class="login-triangle"></div>

    <h2 class="login-header ">Registrazione Account</h2>
    <form class="login-container login-grid" method='post'
      action='<?php $_SERVER['PHP_SELF'] ?>Register.php'
      id='form1'>
      <p><input name='Nome' type="text" placeholder="Nome"></p>
      <p><input name='Cognome' type="text" placeholder="Cognome"></p>
      <p><input name='Email' type="text" placeholder="Email"></p>
      <p><input name='Username' type="text" placeholder="Username"></p>
      <p><input name='Password' type="password" placeholder="Password"></p>
      <p><input name='ConfPassword' type="password" placeholder="Conferma Password"></p>
      <p><input type="submit" value="SALVA"></p>

    </form>
  </div>



  <?php

if (isset($_POST['Nome']) & !empty($_POST['Nome'])) {
    $firstname=$_POST['Nome'];
    $lastname=$_POST['Cognome'];
    $email=$_POST['Email'];
    $username=$_POST['Username'];
    $password=password_hash($_POST['Password'], PASSWORD_BCRYPT);
    $confpassword=password_hash($_POST['ConfPassword'], PASSWORD_BCRYPT);
    //CHECK DATA
    $valMail=isValidEmail($email);
    $valUsername=isValidUsername($DB, $username);
    $valPassword=isValidPassword($password, $confpassword);
    if ($valMail & $valUsername & $valPassword) {
        RegUser($DB, $firstname, $lastname, $email, $username, $password);
    } else {
    }
} else {
}

?>
</body>

</html>