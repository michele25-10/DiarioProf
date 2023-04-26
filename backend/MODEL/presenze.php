<?php
class Presenze
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function addPresenze($id_incontro, $id_alunno, $status)
    {
        $sql = "INSERT INTO diario.presenze(id_incontro,id_alunno,status) VALUES('" . $id_incontro . "', '" . $id_alunno . "', '" . $status . "')";
        return $sql;
    }
}
