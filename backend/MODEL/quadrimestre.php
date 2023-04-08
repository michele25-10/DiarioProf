<?php
class Quadrimestre
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchiveQuadrimestre()
    {
        $sql = "select * from quadrimestre q ;";
        return $sql;
    }
}
