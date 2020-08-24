<?php
require "../private/init.php";

 
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    echo '<html><body style="      font-family: \'Open Sans\', sans-serif;  background-color: #064786;"><div style="position:absolute;left:40%;top:50%;width:100%;height:100%;">
    <h2 style="color:#fff;font-size:30px;">
  <i class="fas fa-exclamation-triangle"></i>&nbsp;
    File vuoto o non valido &nbsp;<i class="fas fa-exclamation-triangle"></i></h2></div></body></html>';
    echo '<script>setTimeout(function(){location.href="index.php"},2000)</script>';

    exit;
}

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'usrimg/';

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
    //Se l'operazione è andata a buon fine...
    SetUsrImg($DB, $USER['id'], $uploaddir . $userfile_name);

    echo '<script>location.href="index.php"</script>';
} else {
    //Se l'operazione è fallta...
  

    echo '<html><body style="      font-family: \'Open Sans\', sans-serif;  background-color: #064786;"><div style="position:absolute;left:40%;top:50%;width:100%;height:100%;">
    <h2 style="color:#fff;font-size:30px;">
  <i class="fas fa-exclamation-triangle"></i>&nbsp;
    Upload NON valido! &nbsp;<i class="fas fa-exclamation-triangle"></i></h2></div></body></html>';
    echo '<script>setTimeout(function(){location.href="index.php"},2000)</script>';
}
