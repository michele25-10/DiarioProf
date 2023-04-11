<?php
class Incontro
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function addIncontro($id_corso, $data_inizio)
    {
        $sql = "INSERT INTO diario.incontro(id_corso, data_inizio)
        VALUES ('" . $id_corso . "', '" . $data_inizio . "'); ";
        return $sql;
    }
    function getArchieveIncontri()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note 
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        order by i.data_inizio desc;";
        return $sql;
    }
}
