<?php

//Utilities
require_once('inc/Utilities/Page.php');
require_once('inc/Utilities/RestClient.class.php');
require_once('inc/Utilities/LoginUtilities.php');

//Config
require_once('inc/Config.php');

/*
 * Verify if a user is already logged into a session.
 * If so, the user is redirected to the home page.
 */
if (LoginUtilities::verifyLogin()) {
    header("Location: Index.php");
}

//Checks the action for when a user enters login details.
if (isset($_POST["action"]) && $_POST["action"] == "login") {

    //RestAPI call to verify login details
    //Returns boolean
    $res = json_decode(RestClient::call("POST", array("vPassword" => $_POST["password"],
        "vId" => $_POST["username"])));


    if ($res) {
        session_start();
        //Setting session data for logged in user
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $_POST["username"];

        //Open home for user
        header("Location: index.php");
    } else {
        $message = "Could not login";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
Page::$title = "Login";
Page::header();
Page::login();
Page::footer();


