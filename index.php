<?php

session_start();

require 'lib/Moderator.php';

$moderator = new Moderator();

if (isset($_POST["name"])){
	$moderator->loggIn($_POST["name"], $_POST["pass"]);
}else if(isset($_POST["logout"])){
	$moderator->logOut();
}

require 'pages/header.phtml';
require 'pages/mainPage.php';
require 'pages/team.php';
require 'pages/forum.php';
require "pages/footer.php"

?>