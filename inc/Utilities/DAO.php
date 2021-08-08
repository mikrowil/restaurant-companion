<?php


class DAO
{
    private static PDOService $db;

    public static function init(){
        self::$db = new PDOService('Employee');
    }

    public static function addEmployee(Employee $employee){
        $sql = "INSERT INTO Employees(username,password,firstName,lastName,age,email) VALUES(:username,:password,:firstName,:lastName,:age,:email) ;";

        self::$db->query($sql);
        self::$db->bind(":username",$employee->username);
        self::$db->bind(":password",$employee->password);
        self::$db->bind(":firstName",$employee->firstName);
        self::$db->bind(":lastName",$employee->lastName);
        self::$db->bind(":age",$employee->age);
        self::$db->bind(":email",$employee->email);
        self::$db->execute();
        self::$db->rowCount();

        return self::$db->lastInsertedId();

    }

    public static function getEmployees(){
        $sql = "SELECT * FROM Employees;";
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->resultSet();
    }

    public static function deleteEmployee($employee){
        $sql = "DELETE FROM Employees WHERE username = :username";

        self::$db->query($sql);
        self::$db->bind(":username",$employee);
        self::$db->execute();
        return self::$db->rowCount();
    }

    public static function verifyPassword($password,$id){
        $sql = "SELECT * FROM Employees WHERE username = :username;";

        self::$db->query($sql);
        self::$db->bind(":username",$id);
        self::$db->execute();

        $employee  = self::$db->singleResult();

        if($employee == null){

            return false;
        }



        $hash = $employee->getPassword();



        return password_verify($password,$hash);

    }
}
