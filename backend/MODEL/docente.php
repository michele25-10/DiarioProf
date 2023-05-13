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
    function addDocente($CF, $nome, $cognome,$telefono){
        $sql ="INSERT INTO docente(CF, nome, cognome, telefono)
        VALUES ('" . $CF . "', '" . $nome . "', '" . $cognome . "', " . $telefono . ");";
        return $sql;
    }
}
