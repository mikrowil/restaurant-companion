<?php

require_once('inc/Entities/Employee.php');
require_once('inc/Utilities/PDOService.class.php');
require_once('inc/Utilities/Page.php');
require_once('inc/Utilities/DAO.php');
require_once('inc/Utilities/LoginUtilities.php');
require_once('inc/Config.php');
require_once('inc/Utilities/RestClient.class.php');
require_once('inc/Utilities/EmployeeConverter.php');
require_once('inc/Utilities/ShiftsDao.php');

DAO::init();
ShiftsDao::init();

$requestData = json_decode(file_get_contents('php://input'));

switch ($_SERVER['REQUEST_METHOD']){
    case "GET":
        $employees = EmployeeConverter::convertToStd(DAO::getEmployees());

        header("Content-Type: application/json");
        echo json_encode($employees);

        break;

    case "DELETE":
        DAO::deleteEmployee($requestData->user);
        break;

    case "DELSHIFT":
        ShiftsDao::deleteShift($requestData->id);
        break;

    case "POST":
        if(isset($requestData->username,
        $requestData->password,
        $requestData->firstName,
        $requestData->lastName,
        $requestData->age,
        $requestData->email)){
            $employeeToAdd = new Employee();

            $employeeToAdd->setUsername($requestData->username);
            $employeeToAdd->setPassword($requestData->password);
            $employeeToAdd->setFirstName($requestData->firstName);
            $employeeToAdd->setLastName($requestData->lastName);
            $employeeToAdd->setAge($requestData->age);
            $employeeToAdd->setEmail($requestData->email);

            $result = DAO::addEmployee($employeeToAdd);

            header("Content-Type: application/json");
            echo json_encode($result);
        }elseif (isset($requestData->vPassword,
        $requestData->vId)){

            $res = false;

            if(DAO::verifyPassword($requestData->vPassword,$requestData->vId)){
                $res = true;

            }
            header("Content-Type: application/json");
            echo json_encode($res);
        }


}
