<?php
class Corso
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function addCorso($tipologia, $id_quadrimestre, $id_docente, $id_tutor, $materia, $data_inizio, $data_fine, $nome_corso, $sede)
    {
        $sql = "INSERT INTO diario.corso(tipologia, id_quadrimestre, id_docente, id_tutor, materia, data_inizio, data_fine, nome_corso, sede)
        VALUES ('" . $tipologia . "', '" . $id_quadrimestre . "', '" . $id_docente . "', " . $id_tutor . ", '" . $materia . "', '" . $data_inizio . "', '" . $data_fine . "', '" . $nome_corso . "', '" . $sede . "');";
        return $sql;
    }

    function getArchiveCorso()
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,concat(d.nome, ' ' ,d.cognome) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from diario.corso c        
        INNER JOIN diario.quadrimestre q ON q.id = c.id_quadrimestre
                INNER JOIN diario.docente d ON d.CF = c.id_docente
                left JOIN diario.docente d2 ON d2.CF = c.id_tutor;";
        return $sql;
    }

    function getCorsoById($id_corso)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizo, '-',q.data_fine) as 'id_quadrimestre', concat(d.nome, d.cognome) as 'id_docente', concat(d2.nome, d2.cognome) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        FROM diario.corso c
        INNER JOIN diario.quadrimestre q ON q.id = c.id_quadrimestre
        INNER JOIN diario.docente d ON d.CF = c.id_docente
        INNER JOIN diario.docente d2 ON d2.CF = c.id_tutor
        WHERE c.id = '" . $id_corso . "'; ";
        return $sql;
    }

    function CountCorsiByType($type)
    {
        $sql = "select count(c.id) as 'count'
        from diario.corso c 
        where c.tipologia = '" . $type . "';";
        return $sql;
    }
}
