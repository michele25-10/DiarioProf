<?php
class Incontro
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function addIncontro($id_corso, $data_inizio, $note)
    {
        $sql = "INSERT INTO diario.incontro(id_corso, data_inizio, note)
        VALUES ('" . $id_corso . "', '" . $data_inizio . "', '" . $note . "'); ";
        return $sql;
    }
}
