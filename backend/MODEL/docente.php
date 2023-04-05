<?php
class Docente
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>