<?php
class Database {
    private $host;
    private $user;
    private $pass;
    private $database;
    private $conn;

    function __construct($host, $user, $pass, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        $this->conn = new mysql($this->host, $this->user, $this->pass, $this->database) or die (mysql_error());
        if(!$this->conn;) {
            return false;
        } else {
            return true;
        }
    }
}
?>