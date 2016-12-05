<?php

session_start();

function isLoggedUser()
{
	if (isset($_SESSION['loggedUser']) && !is_null($_SESSION["loggedUser"]))
	{
		return true;
	}
	return false;
}

function getLoggedUserId()
{
	return $_SESSION["loggedUser"];
}

if (isLoggedUser())
{
	echo getLoggedUserId();
}
else
{
	echo 0;
}

?>
