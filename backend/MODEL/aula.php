<?php
class Alunno
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchieveAule()
    {
        $sql = "SELECT * from aula";
        return $sql;
    }
}
