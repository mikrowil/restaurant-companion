<?php

require_once('inc/Entities/Employee.php');
require_once('inc/Utilities/PDOService.class.php');
require_once('inc/Utilities/Page.php');
require_once('inc/Config.php');
require_once('inc/Utilities/LoginUtilities.php');
require_once('inc/Utilities/RestClient.class.php');


Page::$title = "Register";
Page::header();

if(isset($_POST["action"]) && $_POST["action"] == "add"){




    //encrypt password
    $hashedPass = password_hash($_POST["password"],PASSWORD_DEFAULT);

    try {
        RestClient::call("POST",array("username"=>$_POST["username"],
            "password"=>$hashedPass,
            "firstName"=>$_POST["firstName"],
            "lastName"=>$_POST["lastName"],
            "age"=>$_POST["age"],
            "email"=>$_POST["email"]));

        if(RestClient::call("POST",array("vPassword"=>$_POST["password"],
        "vId"=>$_POST["username"])) == "true"){
            session_start();

            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $_POST["username"];
            header("Location: index.php");
        }else{
            $message = "That username is taken";
            echo "<script type='text/javascript'>alert('$message');</script>";
            Page::AddEmployee();
        }

    }catch (Exception $exception){
        echo "Sorry that username has been taken";

    }
}else{
    Page::AddEmployee();
}



Page::footer();
