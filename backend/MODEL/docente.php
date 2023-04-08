<?php
class Docente
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getArchieveDocente()
    {
        $sql = "select * from docente d;";
        return $sql;
    }
}
