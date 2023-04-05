<?php
class Iscrizione
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>