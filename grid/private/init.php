<?php
//PATH DEFINE
define("WWW_ROOT", "..");
define("WWW_PRIVATE", WWW_ROOT."/private");
define("WWW_PUBLIC", WWW_ROOT."/public");
//DATABASE DEFINE
define("DB_SER", "localhost");
define("DB_PORT", "3306");
define("DB_USR", "root");
define("DB_PASS", "");
define("DB_NAME", "dev");

require "database/functions.php";
require "functions/todo.php";
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
global $USER;
global $DB;
global $TOKEN;

$DB=DBConnect(DB_SER, DB_PORT, DB_USR, DB_PASS, DB_NAME);
if (strpos($url, 'Login') !== false ||strpos($url, 'Register') !== false) {
} else {
    isLoggedIn();
   
    $TOKEN= getToken();
    $USER=getUserInfo($DB, $TOKEN);
}
