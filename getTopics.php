<?php
require_once(dirname(__FILE__)."/functions.php");

session_start();

$con = db_connect();

if (isLoggedUser())
{
	if (isset($_POST['filter']) && !is_null($_POST['filter']) && $_POST['filter'] == 1)
	{
		$sql = getSqlTopicsFilter($_POST['id']);
	}
	else
	{
		$sql = getSqlTopicsLogged($_POST['id']);
	}
}
else
{
	$sql = getSqlTopicsUnlogged($_POST['id']);
}

echo getTopics($con, $sql);

?>
