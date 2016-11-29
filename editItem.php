<?php
require_once(dirname(__FILE__)."/functions.php");

session_start();

if (isset($_POST['type']) && isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value']))
{
	$conn = db_connect();
	
	if (editItem($conn, $_POST['type'], $_POST['id'], $_POST['column'], $_POST['value']))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
	
	mysqli_close($conn);
}

?>