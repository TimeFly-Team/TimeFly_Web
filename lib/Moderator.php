<?php

require 'functions.php';

class Moderator
{
    public function loggIn($name, $password)
    {
        if($this->verifyUser($name, $password)){
            $_SESSION["name"] = $name;
        }
    }

    public function logOut()
    {
        session_unset();    
        session_destroy();
    }

    public function isLogged()
    {
    	return (isset($_SESSION['name']) && !is_null($_SESSION["name"]));
    }

    public function getName()
    {
        return $_SESSION['name'];
    }

    private function verifyUser($name, $password)
    {
        if ($con = db_connect()) { /* global function is used db_connect()*/
            $sql = "SELECT * FROM moderators WHERE user_id='" .$name. "' and password='". $password ."' LIMIT 1";
            $result = mysqli_query($con, $sql); 
            if ($result && (mysqli_num_rows($result) > 0) ) {
                mysqli_close($con);
                return true;
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