<?php
//Entities
require_once('inc/Entities/Employee.php');
require_once('inc/Entities/Shift.php');

//Utilities
require_once('inc/Utilities/PDOService.class.php');
require_once('inc/Utilities/Page.php');
require_once('inc/Utilities/DAO.php');
require_once('inc/Utilities/LoginUtilities.php');
require_once('inc/Utilities/RestClient.class.php');
require_once('inc/Utilities/EmployeeConverter.php');
require_once('inc/Utilities/ShiftsDao.php');




//Config
require_once('inc/Config.php');

//verifies if the user has already logged into a session
if(!LoginUtilities::verifyLogin()){
    header("Location: Login.php");
}

//Testing only. REMOVE AFTER
//EmailManager::sendVerificationEmail("howdy");

//DAO initialization
DAO::init();
ShiftsDao::init();

//sets tab for Page to tell which tab to highlight as activated tab
if(isset($_GET["tab"])){
    Page::$tab=$_GET["tab"];
}else{

    if(isset($_POST["tab"])){
        Page::$tab=$_POST["tab"];
    }else{
        //default value
        Page::$tab="show";
    }
}

//determines what to do in response to get requests to the server
if (isset($_GET["action"])){
    switch ($_GET["action"]){
        case "delete":
            try {
                RestClient::call("DELETE",array("user"=>$_GET["user"]));
            }catch (Exception $exception){

            }
            break;
        case"delShift":
            try {
                RestClient::call("DELSHIFT",array("id"=>$_GET["id"]));
            }catch (Exception $exception){}

    }
}

if(isset($_POST["action"]) && $_POST["action"] == "logout"){
    LoginUtilities::logout();
    header("Location: Login.php");
}

Page::$title = "Restaurant";
Page::header();
Page::tabs();

if(isset($_POST["action"])){
    switch ($_POST["action"]){
        case "add":
            //encrypt password
            $hashedPass = password_hash($_POST["password"],PASSWORD_DEFAULT);

            try {
                RestClient::call("POST",array("username"=>$_POST["username"],
                    "password"=>$hashedPass,
                    "firstName"=>$_POST["firstName"],
                    "lastName"=>$_POST["lastName"],
                    "age"=>$_POST["age"],
                    "email"=>$_POST["email"]));

            }catch (Exception $exception){
                echo "Sorry that username has been taken";
            }
            break;

        case "shift":
            try {
                $startDate = new DateTime($_POST["startDate"] . " " . $_POST["startTime"]);

                $endDate = new DateTime($_POST["endDate"]. " " .$_POST["endTime"]);


                $user = $_SESSION["username"];

                $shift = new Shift();
                $shift->setEmployee($user);
                $shift->setStartDate($startDate->format("Y-m-d H:i:s"));
                $shift->setEndDate($endDate->format("Y-m-d H:i:s"));


                ShiftsDao::addShift($shift);


            } catch (Exception $e) {

            }


            break;

    }


}


if(isset($_GET["tab"])){
    switch ($_GET["tab"]){
        case "add":

            Page::AddEmployee();

            break;

        case "show":

            $employees = EmployeeConverter::convertToEmployee(json_decode(RestClient::call("GET",array())));

            Page::showEmployees($employees);
            break;


        case "shift":

            Page::shifts(ShiftsDao::getShifts($_SESSION["username"]));

            break;
    }
}else{


    if(isset($_POST["tab"])){
        switch ($_POST["tab"]){
            case "shift":
                Page::shifts(ShiftsDao::getShifts($_SESSION["username"]));
                break;
        }
    }else{
        Page::showEmployees(DAO::getEmployees());
    }


}



Page::footer();
