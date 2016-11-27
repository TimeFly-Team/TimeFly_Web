<?php

//require 'lib/User.php';

//$user = new User();

//Pripojenie databázy
function db_connect() {
	//$conn = mysqli_connect('localhost', 'sktimefly', 'timefly12345');
	$conn = mysqli_connect("localhost","root","","sktimefly");
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
	if (isset($_SESSION['loggedUser']) && !is_null($_SESSION["loggedUser"]))
	{
		return true;
	}
	return false;
}

function addForum($conn, $name, $access = 0)
{
	if (mysqli_query($conn, getSqlInsertForum($name, $access)))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

function getSqlInsertForum($name, $access)
{
	return "INSERT INTO forums (name, access) VALUES (\"".$name."\",".$access.")";
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
	if ($forum != false)
	{
		return canUserAddTopic($forum);
	}
	return false;
}

function getForumById($conn, $forum_id)
{
	$result = mysqli_query($conn, "SELECT * FROM forums f WHERE f.forum_id = ".$forum_id);
	if (mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_array($result);
	}
	return false;
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
	if (mysqli_query($conn, getSqlInsertTopic($forum_id, $name, $user_id)))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

function getSqlInsertTopic($forum_id, $name, $user_id)
{
	if (is_null($user_id))
	{
		return "INSERT INTO topics (forum_id, name) VALUES (".$forum_id.",\"".$name."\")";
	}
	return "INSERT INTO topics (forum_id, name, user_id) VALUES (".$forum_id.",\"".$name."\",".$user_id.")";
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
	if (mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_array($result);
	}
	return false;
}

function canUserAddComment($conn, $topic)
{
	if (isLoggedUser() || (is_null($topic['user_id']) && getForumById($conn, $topic['forum_id'])['access'] < 2))
	{
		return true;
	}
	return false;
}

function addComment($conn, $topic_id, $text, $user_name = NULL)
{
	$user_id = isLoggedUser() ? getLoggedUserId() : getUserIdByNameOrCreateNewUser($conn, $user_name);
	if ($user_id && mysqli_query($conn, getSqlInsertComment($topic_id, $user_id, $text)))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

function getLoggedUserId()
{
	return $_SESSION["loggedUser"];
}

function getUserIdByNameOrCreateNewUser($conn, $user_name)
{
	if (!is_null($user_name))
	{
		$user_id = getUserIdByName($conn, $user_name);
		return  $user_id ? $user_id : createNewUser($conn, $user_name);
	}
	return false;
}

function getUserIdByName($conn, $user_name)
{
	$result = mysqli_query($conn, "SELECT u.user_id FROM users u WHERE u.name = \"".$user_name."\"");
	if (mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_array($result)['user_id'];
	}
	return false;
}

function createNewUser($conn, $user_name)
{
	if (mysqli_query($conn, "INSERT INTO users (name) VALUES (\"".$user_name."\")"))
	{
		return mysqli_insert_id($conn);
	}
	return false;
}

function getSqlInsertComment($topic_id, $user_id, $text)
{
	return "INSERT INTO comments (topic_id, user_id, text) VALUES (".$topic_id.",".$user_id.",\"".$text."\")";
}

function getForums($conn)
{
 $result = array();
 $sql = mysql_query($conn,"SELECT * FROM forums ORDER BY forum_id;"));
 while ($row = mysql_fetch_alias_array($sql))
 {
    $pom = array();
    array_push($pom, $row['forum_id']);
    array_push($pom, $row['name']);
    array_push($result, $pom);
 }
 echo json_encode($result);
}

function getTopic($conn,$forumId)
{
 $result = array();
 $sql = mysql_query($conn,"SELECT * FROM topics WHERE forum_id="+$forumId+" ORDER BY topic_id;"));
 while ($row = mysql_fetch_alias_array($sql))
 {
    $pom = array();
    array_push($pom, $row['topic_id']);
    array_push($pom, $row['name']);
    array_push($pom, $row['lock']);
    array_push($result, $pom);
 }
 echo json_encode($result);
}

function getComments($conn,$topicId)
{
 $result = array();
 $sql = mysql_query($conn,"SELECT * FROM comments WHERE topic_id="+$topicId+" ORDER BY timestamp ASC;"));
 while ($row = mysql_fetch_alias_array($sql))
 {
    $pom = array();
    array_push($pom, $row['comment_id']);
    array_push($pom, $row['text']);
    array_push($pom, $row['timestamp']);
    array_push($result, $pom);
 }
 echo json_encode($result);
}

function getUsers($conn)
{
 $result = array();
 $sql = mysql_query($conn,"SELECT * FROM users ORDER BY user_id;"));
 while ($row = mysql_fetch_alias_array($sql))
 {
    $pom = array();
    array_push($pom, $row['user_id']);
    array_push($pom, $row['name']);
    array_push($result, $pom);
 }
 echo json_encode($result);
}

function getInfoUserById($conn,$id)
{
 $result = array();
 $sql = mysql_query($conn,"SELECT * FROM moderators WHERE user_id="+$id+" ;"));
 while ($row = mysql_fetch_alias_array($sql))
 {
    $pom = array();
    array_push($pom, 'E-mail');
    array_push($pom, $row['email']);
    array_push($pom, 'property1');
    array_push($pom, $row['property1']);
    array_push($pom, 'property2');
    array_push($pom, $row['property2']);
    array_push($pom, 'property3');
    array_push($pom, $row['property3']);
    array_push($result, $pom);
 }
 echo json_encode($result);
}
?>

