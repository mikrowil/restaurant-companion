<?php


class LoginUtilities
{
    /*
     * checks if the user is already logged into a session
     * returns boolean
     */
    public static function verifyLogin(){
        //to make sure the session is started before attempting access
        if(!isset($_SESSION)) {
            session_start();

        }

        //returns true if user has already logged into a session, false otherwise
        if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true){
            return true;
        } else {

            session_destroy();

            return false;

        }
    }

    /*
     * logs out the user and terminates the session
     */
    public static function logout(){
        session_start();
        session_destroy();
    }
}
