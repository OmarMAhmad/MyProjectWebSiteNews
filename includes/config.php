<?php
session_start();
define('SITEURL', "http://localhost:63342/Project/");
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','newsdb');

// Connection DataBase
$CONN = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
?>
