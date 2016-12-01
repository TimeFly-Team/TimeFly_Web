<?php

require_once(dirname(__FILE__).'/../functions.php');

class Moderator
{
    public function loggIn($name, $password)
    {
        if($id = $this->verifyUser($name, $password)){
            $_SESSION["loggedUser"] = $id;
        }
    }

    public function logOut()
    {
        session_unset();    
        session_destroy();
    }

    public function isLogged()
    {
		return (isset($_SESSION['loggedUser']) && !is_null($_SESSION["loggedUser"]));
    }

    public function getName()
    {
		if (isLogged())
		{
			return $_SESSION['loggedUser'];
		}
        return false;
    }

    private function verifyUser($name, $password)
    {
        if ($con = db_connect()) { /* global function is used db_connect()*/
            $sql = "SELECT * FROM moderators WHERE mail='" .$name. "' and password='". $password ."' LIMIT 1";
            $result = mysqli_query($con, $sql); 
            if ($result && (mysqli_num_rows($result) > 0) ) {
                mysqli_close($con);
                return mysqli_fetch_array($result)['user_id'];
            } else {
                 mysqli_close($con);
                return false;
            }
        } else {
            echo "Problem with connection2.";
            return false;
        }

    }
}
?>