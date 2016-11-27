<?php
require_once(dirname(__FILE__)."/functions.php");

function echoMessage($param)
{
	if ($param)
	{
		echo "OK";
	}
	else
	{
		echo "FAILURE";
	}
}

$_SESSION['loggedUser'] = 1;

if (isset($_POST['type']))
{
	$conn = db_connect();
	
	if ($_POST['type'] == 'forum')
	{
		echoMessage(checkUserAndAddForum($conn, $_POST['name']));
	}
	else if ($_POST['type'] == 'topic')
	{
		if ($topic_id = checkUserAndAddTopic($conn, $_POST['forum'], $_POST['name'], $_POST['moderator']))
		{
			echoMessage(checkUserAndAddComment($conn, $topic_id, $_POST['desc'], $_POST['user']));
		}		
	}
	else if ($_POST['type'] == 'comment')
	{
		echoMessage(checkUserAndAddComment($conn, $_POST['topic'], $_POST['desc'], $_POST['user']));
	}
	
	mysqli_close($conn);
}
?>