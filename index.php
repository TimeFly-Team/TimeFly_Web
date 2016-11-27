<?php

session_start();

require 'lib/Moderator.php';

$user = new Moderator();

if (isset($_POST["name"])){
	$user->loggIn($_POST["name"], $_POST["pass"]);
}else if(isset($_POST["logout"])){
	$user->logOut();
}

require 'pages/header.phtml';
require 'pages/mainPage.php';
require 'pages/team.php';
require 'pages/forum.php';
require "pages/footer.php"

?>