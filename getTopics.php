<?php
require_once(dirname(__FILE__)."/functions.php");

$con = db_connect();

echo getTopics($con, $_POST['id']);

?>
