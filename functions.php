<?php
//Pripojenie databázy
function db_connect() {
	$conn = mysqli_connect('localhost', 'sktimefly', 'timefly12345');
	if ($conn) {
		return db_select($conn);
	}
	return false;
}

function db_select($conn)
{
	if (mysqli_select_db($conn, 'sktimefly'))
	{
		mysqli_query($conn, "SET CHARACTER SET 'utf8'");
		return $conn;
	}
	return false;	
}

//Pridanie fóra
function checkUserAndAddForum($conn, $name, $access = 0)
{
	if (isLoggedUser())
	{
		return addForum($conn, $name, $access);
	}
	return false;
}

function isLoggedUser()
{
	if ($_SESSION["loggedUser"] != NULL)
	{
		return true;
	}
	return false;
}

function addForum($conn, $name, $access = 0)
{
	if (mysqli_query($conn, "INSERT INTO forums (name, access) VALUES (\"".$name."\",".$access.")"))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

//Pridanie témy
function checkUserAndAddTopic($conn, $forum_id, $name, $user_id = NULL)
{
	if (existForumAndCanUserAddTopic($conn, $forum_id))
	{
		return addTopic($conn, $forum_id, $name, $user_id);
	}
	return false;	
}

function existForumAndCanUserAddTopic($conn, $forum_id)
{
	$forum = getForumById($conn, $forum_id);
	if ($forum == false)
	{
		return false;
	}
	return canUserAddTopic($forum);
}

function getForumById($conn, $forum_id)
{
	$result = mysqli_query($conn, "SELECT * FROM forums f WHERE f.forum_id = ".$forum_id);
	if (mysqli_num_rows($result) < 1)
	{
		return false;
	}
	return mysqli_fetch_array($result);
}

function canUserAddTopic($forum)
{
	if (isLoggedUser() || $forum['access'] < 1)
	{
		return true;
	}
	return false;
}

function addTopic($conn, $forum_id, $name, $user_id = NULL)
{
	$sql_query = "INSERT INTO topics (forum_id, name) VALUES (".$forum_id.",\"".$name."\")";
	if ($user_id != NULL)
	{
		$sql_query = "INSERT INTO topics (forum_id, name, user_id) VALUES (".$forum_id.",\"".$name."\",".$user_id.")";
	}
	if (mysqli_query($conn, $sql_query))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

//Pridanie komentára
function checkUserAndAddComment($conn, $topic_id, $text, $user_name = NULL)
{
	if (existTopicAndCanUserAddComment($conn, $topic_id))
	{
		return addComment($conn, $topic_id, $text, $user_name);
	}
	return false;
}

function existTopicAndCanUserAddComment($conn, $topic_id)
{
	$topic = getTopicById($conn, $topic_id);
	if ($topic != false)
	{
		return canUserAddComment($conn, $topic);
	}
	return false;
}

function getTopicById($conn, $topic_id)
{
	$result = mysqli_query($conn, "SELECT * FROM topics t WHERE t.topic_id = ".$topic_id);
	if (mysqli_num_rows($result) != 0)
	{
		return mysqli_fetch_array($result);
	}
	return false;
}

function canUserAddComment($conn, $topic)
{
	if (isLoggedUser() || ($topic['user_id'] == NULL && getForumById($conn, $topic['forum_id'])['access'] < 2))
	{
		return true;
	}
	return false;
}

function addComment($conn, $topic_id, $text, $user_name = NULL)
{
	$user_id = getUserByNameOrCreateNewUser($conn, $user_name);
	if ($user_id == false)
	{
		return false;
	}	
	if (mysqli_query($conn, "INSERT INTO comments (topic_id, user_id, text) VALUES (".$topic_id.",".$user_id.",\"".$text."\")"))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

function getUserByNameOrCreateNewUser($conn, $user_name)
{
	if (isLoggedUser())
	{
		return getLoggedUserId();
	}
	$user_id = createNewUser($conn, $user_name);
	if ($user_id != false)
	{
		return $user_id;
	}
	return false;
}

function getLoggedUserId()
{
	return $_SESSION["loggedUser"];
}

function createNewUser($conn, $user_name)
{
	if ($user_name == NULL)
	{
		return false;
	}
	if (mysqli_query($conn, "INSERT INTO users (name) VALUES (\"".$user_name."\")"))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

?>

