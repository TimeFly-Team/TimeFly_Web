<?php
require_once(dirname(__FILE__)."/functions.php");

session_start();

$con = db_connect();
$sql = "";

if($_GET["value"] == "0")
{
  $sql = getSqlSearchInTopics($_GET["text"]);
}
else if ($_GET["value"] == "1")
{
	$sql = getSqlSearchInTopicsAndComments($_GET["text"]);
}
else if ($_GET["value"] == "2")
{
	$sql = getSqlSearchInComments($_GET["text"]);
}
echo getTopicsForSearch($con, $sql);


?>