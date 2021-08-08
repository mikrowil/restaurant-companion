<?php


class EmployeeConverter
{
    public static function convertToStd($employees){
        $std = array();

        foreach ($employees as $emp){
            $obj = new stdClass();
            $obj->username=$emp->getUsername();
            $obj->password="NA";
            $obj->firstName = $emp->getFirstName();
            $obj->lastName=$emp->getLastName();
            $obj->age=$emp->getAge();
            $obj->email=$emp->getEmail();

            $std[] = $obj;
        }


        return $std;
    }

    public static function convertToEmployee($std){
        $employees = array();

        foreach ($std as $s){
            $emp = new Employee();
            $emp->setUsername($s->username);
            $emp->setPassword($s->password);
            $emp->setFirstName($s->firstName);
            $emp->setLastName($s->lastName);
            $emp->setAge($s->age);
            $emp->setEmail($s->email);

            $employees[] = $emp;
        }

        return $employees;
    }
}
