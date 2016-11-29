<?php
require_once(dirname(__FILE__)."/functions.php");

session_start();

$con = db_connect();

echo getForums($con);

?>
