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
    function updatePresenze($id, $status)
    {
        $sql = "UPDATE diario.presenze SET status = '" . $status . "' WHERE id = '" . $id . "';";
        return $sql;
    }
    function incrementPresenza($id_alunno, $id_incontro)
    {
        $sql = "update diario.iscrizione set numero_presenze = numero_presenze + 1 where id_alunno = '" . $id_alunno . "' and id_corso = (select i.id_corso 
        from incontro i 
        where i.id = '" . $id_incontro . "'
        ) ;";
        return $sql;
    }
    function decrementPresenza($id_alunno, $id_incontro)
    {
        $sql = "update iscrizione set numero_presenze = numero_presenze - 1
        where id_alunno = '" . $id_alunno . "' and numero_presenze != '0' and id_corso = (select i.id_corso 
        from incontro i 
        where i.id = '" . $id_incontro . "'
        );";
        return $sql;
    }
    function getPresenzeByIncontro($id_incontro)
    {
        $sql = " SELECT p.id, a.nome, a.cognome, if(p.status = 0, 'Presente', 'Assente') as 'status'
        FROM  diario.presenze  p
        Inner JOIN diario.alunno a on p.id_alunno = a.CF
        WHERE p.id_incontro = '" . $id_incontro . "';";
        return $sql;
    }
    function checkRegistro($id_incontro)
    {
        $sql = " SELECT * FROM diario.presenze WHERE id_incontro = '" . $id_incontro . "';";
        return $sql;
    }
    function getPresenzeById($id)
    {
        $sql = "SELECT a.nome, a.cognome, a.CF
        FROM diario.presenze p
        INNER JOIN diario.alunno a ON p.id_alunno = a.CF
        where p.id = " . $id . ";";
        return $sql;
    }
}
