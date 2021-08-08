<?php


class ShiftsDao
{
    private static PDOService $db;

    public static function init(){
        self::$db = new PDOService('Shift');
    }

    public static function addShift(Shift $shift){
        $sql = "INSERT INTO Shifts(employee, startDate, endDate) VALUES (:employee, :startDate, :endDate);";

        self::$db->query($sql);

        self::$db->bind(":employee",$shift->getEmployee());
        self::$db->bind(":startDate",$shift->getStartDate());
        self::$db->bind(":endDate",$shift->getEndDate());


        self::$db->execute();
        return self::$db->lastInsertedId();
    }

    public static function getShifts($username){
        $sql = "SELECT * FROM Shifts WHERE employee = :username;";

        self::$db->query($sql);
        self::$db->bind(":username",$username);
        self::$db->execute();

        return self::$db->resultSet();
    }

    public static function deleteShift($id){
        $sql = "DELETE FROM Shifts WHERE shiftId = :id";

        self::$db->query($sql);
        self::$db->bind(":id",$id);
        self::$db->execute();
        return self::$db->rowCount();
    }
}
