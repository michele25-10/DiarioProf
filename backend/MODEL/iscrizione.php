<?php
class Iscrizione
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function addAlunnoToCorso($id_corso, $id_alunno)
    {
        $sql = "INSERT INTO diario.iscrizione(id_alunno, id_corso)
        VALUES ('" . $id_alunno . "', '" . $id_corso . "')";
        return $sql;
    }
}
