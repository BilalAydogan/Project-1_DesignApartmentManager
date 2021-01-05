<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Bilal');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'test_db');
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>