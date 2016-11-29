<?php
require_once(dirname(__FILE__)."/functions.php");

if (isset($_POST['type']))
{
	$conn = db_connect();
	$result = false;
	
	if ($_POST['type'] == 'forum')
	{
		$result = createAndGetNewForum($conn, $_POST['name']);
	}
	else if ($_POST['type'] == 'topic')
	{
		$result = createAndGetNewTopic($conn, $_POST['forum'], $_POST['name'], (isset($_POST['moderator']) ? $_POST['moderator'] : NULL), $_POST['desc'], $_POST['user']);
	}
	else if ($_POST['type'] == 'comment')
	{
		$result = createAndGetNewComment($conn, $_POST['topic'], $_POST['desc'], $_POST['user']);
	}
	
	echo $result;
	
	mysqli_close($conn);
}

// echo > 0 => OK, echo == 0 => FAILURE

?>