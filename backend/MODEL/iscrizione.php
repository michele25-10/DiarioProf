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
        $sql = "INSERT INTO iscrizione(id_alunno, id_corso)
        VALUES ('" . $id_alunno . "', '" . $id_corso . "')";
        return $sql;
    }
    function getNumeroPresenze($id_corso)
    {
        $sql = "select a.nome, a.cognome, i.numero_presenze 
        from iscrizione i
        inner join alunno a on a.CF = i.id_alunno 
        where id_corso = '" . $id_corso . "'";
        return $sql;
    }
}
