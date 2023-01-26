<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "paspartoo";
        try {
            $con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $con;
    }
}
