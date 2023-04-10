<?php
class Alunno
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchieveAlunni(){
        $sql = "SELECT * from diario.alunno"; 
        return $sql;
    }
}
