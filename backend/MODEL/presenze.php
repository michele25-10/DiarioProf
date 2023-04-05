<?php
class Presenze
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>