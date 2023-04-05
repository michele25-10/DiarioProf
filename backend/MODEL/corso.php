<?php
class Corso
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>