<?php
class Quadrimestre
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>