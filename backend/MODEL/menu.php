<?php
class Menu
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchieveMenu()
    {
        $sql = "Select id, tipologia, descrizione from menu where 1=1";
        return $sql;
    }
}
