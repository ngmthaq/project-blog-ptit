<?php

require_once('./configs/config.php');

class Model
{
    protected $hostName = HOST_NAME;
    protected $userName = USER_NAME;
    protected $password = PASSWORD;
    protected $dbName = DB_NAME;
    protected $conn;
    protected $table;

    public function __construct() {
        $this->conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
    }

    public function all()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
