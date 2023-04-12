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
        LEFT JOIN diario.docente d2 ON d2.CF = c.id_tutor
        WHERE c.id = '" . $id_corso . "'; ";
        return $sql;
    }

    function getCorsiByType($type)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,concat(d.nome, ' ' ,d.cognome) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from diario.corso c        
        INNER JOIN diario.quadrimestre q ON q.id = c.id_quadrimestre
        INNER JOIN diario.docente d ON d.CF = c.id_docente
        LEFT JOIN diario.docente d2 ON d2.CF = c.id_tutor
        WHERE c.tipologia = '" . $type . "'
        order by c.nome_corso desc;";
        return $sql;
    }

    function CountCorsiByType($type)
    {
        $sql = "select count(c.id) as 'count'
        from diario.corso c 
        where c.tipologia = '" . $type . "';";
        return $sql;
    }
    function getCorsoByNomeCorso($nome_corso)
    {
        $sql = "SELECT c.id
        FROM diario.corso c
        WHERE c.nome_corso = '" . $nome_corso . "';";
        return $sql;
    }

    function getInfoCorsoDate($id){
        $sql = "SELECT i.data_inizio, i.note
        FROM  diario.corso c
        inner join diario.incontro i on c.id = i.id_corso
        WHERE c.id = '" . $id . "';";
        return $sql;
    }

    function getInfoCorsoStudent($id){
        $sql = " SELECT a.nome, a.cognome, a.CF
        FROM diario.corso c
        inner join diario.iscrizione i2 on c.id = i2.id_corso
        inner join diario.alunno a on i2.id_alunno = a.CF
        WHERE c.id = '" . $id . "';";
        return $sql;
    }
}

