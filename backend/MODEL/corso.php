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
        $sql = "INSERT INTO corso(tipologia, id_quadrimestre, id_docente, id_tutor, materia, data_inizio, data_fine, nome_corso, sede)
        VALUES ('" . $tipologia . "', '" . $id_quadrimestre . "', '" . $id_docente . "', " . $id_tutor . ", '" . $materia . "', '" . $data_inizio . "', '" . $data_fine . "', '" . $nome_corso . "', '" . $sede . "');";
        return $sql;
    }

    function getArchiveCorso()
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,if(c.id_docente = null, 'NULL', concat(d.nome, ' ' ,d.cognome)) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from corso c        
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
                left JOIN docente d ON d.CF = c.id_docente
                left JOIN docente d2 ON d2.CF = c.id_tutor;";
        return $sql;
    }

    function getCorsoById($id_corso)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizo, '-',q.data_fine) as 'id_quadrimestre', concat(d.nome, d.cognome) as 'id_docente', concat(d2.nome, d2.cognome) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        FROM corso c
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
        INNER JOIN docente d ON d.CF = c.id_docente
        LEFT JOIN docente d2 ON d2.CF = c.id_tutor
        WHERE c.id = '" . $id_corso . "'; ";
        return $sql;
    }

    function getCorsiByType($type)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,concat(d.nome, ' ' ,d.cognome) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from corso c        
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
        INNER JOIN docente d ON d.CF = c.id_docente
        LEFT JOIN docente d2 ON d2.CF = c.id_tutor
        WHERE c.tipologia = '" . $type . "'
        order by c.nome_corso desc;";
        return $sql;
    }

    function CountCorsiByType($type)
    {
        $sql = "select count(c.id) as 'count'
        from corso c 
        where c.tipologia = '" . $type . "';";
        return $sql;
    }
    function getCorsoByNomeCorso($nome_corso)
    {
        $sql = "SELECT c.id
        FROM corso c
        WHERE c.nome_corso = '" . $nome_corso . "';";
        return $sql;
    }

    function getInfoCorsoDate($id)
    {
        $sql = "SELECT i.data_inizio, i.note, a.nome, i.id
        FROM  corso c
        inner join incontro i on c.id = i.id_corso
        inner join aula a on a.id = i.id_aula
        WHERE c.id = '" . $id . "';";
        return $sql;
    }

    function getInfoCorsoStudent($id)
    {
        $sql = " SELECT a.nome, a.cognome, a.CF
        FROM corso c
        inner join iscrizione i2 on c.id = i2.id_corso
        inner join alunno a on i2.id_alunno = a.CF
        WHERE c.id = '" . $id . "';";
        return $sql;
    }
}