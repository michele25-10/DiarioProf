<?php
class Alunno
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchieveAlunni()
    {
        $sql = "SELECT * from diario.alunno";
        return $sql;
    }
    function getStudentByCorsoName($nome_corso)
    {
        $sql = "SELECT a.CF, a.nome, a.cognome
        from diario.alunno a
        inner join diario.iscrizione i on i.id_alunno = a.CF
        inner join diario.corso c on c.id = i.id_corso
        where c.nome_corso = '" . $nome_corso . "';";
        return $sql;
    }
}
