<?php

session_start();

require_once(dirname(__FILE__).'/lib/Moderator.php');

$moderator = new Moderator();

if (isset($_POST["name"])){
	$moderator->loggIn($_POST["name"], $_POST["pass"]);
}else if(isset($_POST["logout"])){
	$moderator->logOut();
}
require_once(dirname(__FILE__).'/pages/header.phtml');
require_once(dirname(__FILE__).'/pages/mainPage.php');
require_once(dirname(__FILE__).'/pages/team.php');
require_once(dirname(__FILE__).'/pages/forum.php');
require_once(dirname(__FILE__)."/pages/footer.php");

?>