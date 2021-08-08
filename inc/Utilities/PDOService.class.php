<?php

class PDOService    {

    //Pull in the attributes from the config file
    //Make sure you set all the things!
    private $_host = DB_HOST;
    private $_user = DB_USER;
    private $_pass = DB_PASS;
    private $_dbname = DB_NAME;

    //Store our PDO object
    private $_dbh;
    private $_error;

    //Store the class name
    private $_className;

    //Story the Query statement;
    private $_pstmt;

    //Constructor
    public function __construct(string $className) {

        //Record the Class Name
        $this->_className = $className;

        //Assemble DSN (Data Source Name)
        $dsn = 'mysql:host=' . $this->_host . ';dbname=' .$this->_dbname;

        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

        try {
            //Create an instance of PDO, assign the new instnace to the internal variable of this PDO Service.
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass,  $options);

        } catch (PDOException $pe) {
            $this->_error = $pe->getMessage();
        }
    }

    //This function  prepares a query that has to be passed
    public function query(string $query)    {
        $this->_pstmt = $this->_dbh->prepare($query);
    }

    public function bind($param, $value, $type=null)    {
        //Automatically detect the type
        if (is_null($type)) {

            switch (true)   {

                //If the value is an integer
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                    //If the value is a boolean
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                    //If the value is null
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                //If it is not any of the above then it must be a string
                default:
                $type = PDO::PARAM_STR;
            }
        }

        //Finally bind the parameters
        $this->_pstmt->bindValue($param, $value, $type);

    }

    //Execute the query
    public function execute()   {
        return $this->_pstmt->execute();
    }

    //Return the result set, with all our classes of a certian type.
    public function resultSet() {
        //Return all the classes
        return $this->_pstmt->fetchAll(PDO::FETCH_CLASS, $this->_className);
    }

    //this function will return a single row
    public function singleResult() {
        //Set the fetch mode
        $this->_pstmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        return $this->_pstmt->fetch(PDO::FETCH_CLASS);
    }


    //Gets us a count of the rows that were affected.
    public function rowCount() : int {
        return $this->_pstmt->rowCount();
    }

    //Gets us the id of the last record we inserted
    public function lastInsertedId() {
        return $this->_dbh->lastInsertId();
    }



}

?>
