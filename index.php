<?php

session_start();

require_once(dirname(__FILE__).'/lib/Moderator.php');

$moderator = new Moderator();

if (isset($_POST["name"])){
	$moderator->loggIn($_POST["name"], $_POST["pass"]);
}else if(isset($_POST["logout"])){
	$moderator->logOut();
}

require(dirname(__FILE__).'/pages/header.phtml');
require(dirname(__FILE__).'/pages/mainPage.php');
require(dirname(__FILE__).'/pages/team.php');
require(dirname(__FILE__).'/pages/forum.php');
require(dirname(__FILE__)."/pages/footer.php");

?>
<script>
initialize();
var question_formulars = document.getElementsByClassName("send_message");
for (var i = 0 ; i < question_formulars.length ; i++)
{
	var id = question_formulars[i].children[9].id.split("_")[3];
	setAddQuestionSubmit(id);			
}
</script>