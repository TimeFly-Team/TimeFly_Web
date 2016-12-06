<?php

//Pripojenie databázy
function db_connect() {
	//$conn = mysqli_connect('localhost', 'sktimefly', 'timefly12345');
	$conn = mysqli_connect("localhost","root","");
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
	return "INSERT INTO forums (text, access) VALUES (\"".$name."\",".$access.")";
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
		return "INSERT INTO topics (forum_id, text) VALUES (".$forum_id.",\"".$name."\")";
	}
	return "INSERT INTO topics (forum_id, text, user_id, visible) VALUES (".$forum_id.",\"".$name."\",".$user_id.", 1)";
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
	if (isLoggedUser() || getForumById($conn, $topic['forum_id'])['access'] < 2)
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
	$sql = mysqli_query($conn, "SELECT * FROM forums WHERE visible < ".(isLoggedUser() ? "2" : "1")." ORDER BY forum_id");
	while ($row = mysqli_fetch_array($sql))
	{
	 	$result[] = array("forum_id" => $row['forum_id'], "forum_name" => $row['text'], "forum_access" => $row['access'], "visible" => $row['visible']);
	}
	echo json_encode($result);
}

function getTopics($conn, $sql)
{
 $result = array();
 if ($res = mysqli_query($conn, $sql))
 {
	while ($row = mysqli_fetch_array($res))
	{
		if (isLoggedUser() && !is_null($row['name']))
		{
			$result[] = array("forum_id" => $row['forum_id'], "topic_id" => $row['topic_id'], "topic_name" => "(".$row['name'].")   ".$row['text'], "topic_lock" => $row['lock'], "visible" => $row['visible']);
		}
		else
		{
			$result[] = array("forum_id" => $row['forum_id'], "topic_id" => $row['topic_id'], "topic_name" => $row['text'], "topic_lock" => $row['lock'], "visible" => $row['visible']);
		}
	} 
 }
 echo json_encode($result);
}

function getSqlTopicsFilter($forum_id)
{
	return "SELECT * FROM topics t, users u WHERE t.user_id = ".getLoggedUserId()." AND u.user_id = t.user_id AND forum_id=".$forum_id." AND visible < 2 ORDER BY topic_id";
}

function getSqlTopicsLogged($forum_id)
{
	return "SELECT * FROM topics t LEFT JOIN users u ON u.user_id = t.user_id WHERE forum_id=".$forum_id." AND visible < 2 ORDER BY topic_id";
}

function getSqlTopicsUnlogged($forum_id)
{
	return "SELECT * FROM topics WHERE user_id IS NULL AND forum_id=".$forum_id." AND visible < 1 ORDER BY topic_id"; 
}

function getComments($conn,$topic_id)
{
 $result = array();
 $sql = mysqli_query($conn,"SELECT * FROM comments c, users u WHERE u.user_id=c.user_id AND c.topic_id=".$topic_id." AND c.visible < ".(isLoggedUser() ? "2" : "1")." ORDER BY c.timestamp ASC");
 while ($row = mysqli_fetch_array($sql))
 {
	 $result[] = array("comment_id" => $row['comment_id'], "user_name" => $row['name'], "text" => $row['text'], "time" => $row['timestamp'], "visible" => $row['visible']);
 }
 echo json_encode($result);
}

function getModerators($conn)
{
	$result = mysqli_query($conn, "SELECT * FROM moderators m, users u WHERE u.user_id = m.user_id");
	if (mysqli_num_rows($result) > 0)
	{
		return $result;
	}
	return false;	
}

function getCommentById($conn, $comment_id)
{
	$result = mysqli_query($conn,"SELECT * FROM comments c, users u WHERE u.user_id=c.user_id AND c.comment_id=".$comment_id); 
	if ($result)
	{
		return mysqli_fetch_array($result);
	}
	return false;
}

function createAndGetNewForum($conn, $name)
{
	if ($id = checkUserAndAddForum($conn, $name))
	{
		$result = array();
		$forum = getForumById($conn, $id); 
		$result[] = array("forum_id" => $forum['forum_id'], "forum_name" => $forum['text'], "visible" => $forum['visible']);
		return json_encode($result);
	}
	return false;
}

function createAndGetNewTopic($conn, $forum, $name, $moderator, $text, $user)
{
	if ($topic_id = checkUserAndAddTopic($conn, $forum, $name, $moderator))
	{
		if ($id = checkUserAndAddComment($conn, $topic_id, $text, $user))
		{
			$result = array();
			$topic = getTopicById($conn, $topic_id);
			$result[] = array("forum_id" => $forum ,"topic_id" => $topic['topic_id'], "topic_name" => $topic['text'], "topic_lock" => $topic['lock'], "visible" => $topic['visible']);
			return json_encode($result);
		}
	}
	return false;
}

function createAndGetNewComment($conn, $topic, $text, $user)
{
	if ($id = checkUserAndAddComment($conn, $topic, $text, $user))
	{
		$result = array();
		$comment = getCommentById($conn, $id); 
		$result[] = array("comment_id" => $comment['comment_id'], "user_name" => $comment['name'], "text" => $comment['text'], "time" => $comment['timestamp'], "visible" => $comment['visible']);
		return json_encode($result);
	}
	return false;
}

function editItem($conn, $type, $id, $column, $value)
{
	if ($value[0] == '!')
	{
		$value = '!t.'.substr($value,1);
	}
	if ($type == "Topic" && $column == "visible")
	{
		$sql = 'UPDATE '.strtolower($type).'s t SET t.'.strtolower($column).' = '.$value.', user_id = NULL WHERE t.'.strtolower($type).'_id='.$id;
	}
	else
	{
		$sql = 'UPDATE '.strtolower($type).'s t SET t.'.strtolower($column).' = '.$value.' WHERE t.'.strtolower($type).'_id='.$id;
	}
	return isLoggedUser() && mysqli_query($conn, $sql);
}

//vyhladavanie

function getSqlSearchInTopics($text)
{
	return "SELECT t.topic_id as topic_id, t.text as topic_name, t.lock as topic_lock FROM topics t WHERE t.text LIKE '%".$text."%' AND t.visible < ".(isLoggedUser() ? "2" : "1")." ORDER BY t.topic_id";
}

function getSqlSearchInTopicsAndComments($text)
{
	return "SELECT t.topic_id as topic_id, t.text as topic_name, t.lock as topic_lock FROM topics t LEFT JOIN comments c on t.topic_id = c.topic_id AND t.visible < ".(isLoggedUser() ? "2" : "1")." WHERE c.visible < ".(isLoggedUser() ? "2" : "1")." AND (t.text LIKE '%".$text."%' OR  c.text LIKE '%".$text."%') GROUP BY t.topic_id ORDER BY t.topic_id";
}

function getSqlSearchInComments($text)
{
	return "SELECT t.topic_id as topic_id, t.text as topic_name, t.lock as topic_lock FROM topics t JOIN comments c on c.topic_id=t.topic_id AND t.visible < ".(isLoggedUser() ? "2" : "1")." WHERE c.text LIKE '%".$text."%' AND c.visible < ".(isLoggedUser() ? "2" : "1")." GROUP BY t.topic_id ORDER BY t.topic_id";
}

function getTopicsForSearch($conn, $sql)
{
    $result = array();
    $sql_result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($sql_result))
    {  
         $result[] = array("topic_id" => $row['topic_id'], "text" => $row['topic_name'], "lock" => $row['topic_lock']);
    }     
    echo json_encode($result);    
}

function getCommentForSearchTopic($conn,$text,$topic_id)
{
    $result = array();
    $sql = mysqli_query($conn,"SELECT c.comment_id id, c.text text, c.timestamp date, u.name name FROM topics t, users u JOIN comments c on c.topic_id=t.topic_id WHERE u.user_id=c.user_id AND t.topic_id=".$topic_id." AND c.text LIKE '%".$text."%' AND c.visible < ".(isLoggedUser() ? "2" : "1"));
    while ($row = mysqli_fetch_array($sql))
    {  
         $result[] = array("id"=>$row['id'], "text" => $row['text'], "time" => $row['date'], "name" => $row['name']);
    }     
    echo json_encode($result);    
}

?>

