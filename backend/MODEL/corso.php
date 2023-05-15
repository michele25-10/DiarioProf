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
                left JOIN docente d2 ON d2.CF = c.id_tutor
                where c.status = '0'
                order by c.nome_corso ASC;";
        return $sql;
    }

    function getArchiveCorsoStorico()
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,if(c.id_docente = null, 'NULL', concat(d.nome, ' ' ,d.cognome)) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from corso c        
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
                left JOIN docente d ON d.CF = c.id_docente
                left JOIN docente d2 ON d2.CF = c.id_tutor
                where c.status = '1' order by c.nome_corso ASC;";
        return $sql;
    }

    function getCorsoById($id_corso)
    {
        $sql = "SELECT c.id, c.tipologia, c.id_quadrimestre,  c.id_docente, c.id_tutor, c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        FROM corso c
        left JOIN docente d ON d.CF = c.id_docente
        LEFT JOIN docente d2 ON d2.CF = c.id_tutor
        WHERE c.id = '" . $id_corso . "'; ";
        return $sql;
    }

    function getCorsiByType($type)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' ,c.id_docente, c.id_tutor, c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from corso c        
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
        INNER JOIN docente d ON d.CF = c.id_docente
        LEFT JOIN docente d2 ON d2.CF = c.id_tutor
        WHERE c.tipologia = '" . $type . "' and c.status = '0'
        order by c.nome_corso desc;";
        return $sql;
    }

    function CountCorsiByType($type)
    {
        $sql = "select count(c.id) as 'count'
        from corso c 
        where c.tipologia = '" . $type . "' AND c.status != '2';";
        return $sql;
    }
    function getCorsoByNomeCorso($nome_corso)
    {
        $sql = "SELECT c.id
        FROM corso c
        WHERE c.nome_corso = '" . $nome_corso . "' and c.status !='2';";
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

    function updateCorso($id, $id_quadrimestre, $id_docente, $id_tutor, $data_inizio, $data_fine, $materia, $sede)
    {
        $sql = "UPDATE corso
        SET id_quadrimestre = '" . $id_quadrimestre . "', id_docente = '" . $id_docente . "',id_tutor = '" . $id_tutor . "', data_inizio = '" . $data_inizio . "', data_fine = '" . $data_fine . "', materia = '" . $materia . "', sede = '" . $sede . "'
        WHERE id='" . $id . "'; ";
        return $sql;
    }
    function terminaCorso($id_corso)
    {
        $sql = "update corso set status='1' where id='" . $id_corso . "';";
        return $sql;
    }

    function eliminaCorso($id_corso)
    {
        $sql = "update corso set status='2' where id='" . $id_corso . "';";
        return $sql;
    }
    function getStudentPresenze($id)
    {
        $sql = " SELECT a.nome, a.cognome, a.CF, i2.numero_presenze
        FROM corso c
        inner join iscrizione i2 on c.id = i2.id_corso
        inner join alunno a on i2.id_alunno = a.CF
        WHERE c.id = '" . $id . "';";
        return $sql;
    }

    function getCorsiByTipologia($type)
    {
        $sql = "SELECT c.id, c.tipologia, concat(q.data_inizio, ' ',q.data_fine) as 'id_quadrimestre' , if(c.id_docente = null, 'NULL', concat(d.nome, ' ' ,d.cognome)) as 'id_docente', if (c.id_tutor = NULL, 'NULL', concat(d2.nome, ' ' ,d2.cognome)) as 'id_tutor', c.materia, c.data_inizio, c.data_fine, c.nome_corso, c.sede
        from corso c        
        INNER JOIN quadrimestre q ON q.id = c.id_quadrimestre
        left JOIN docente d ON d.CF = c.id_docente
        LEFT JOIN docente d2 ON d2.CF = c.id_tutor
        WHERE c.tipologia = '" . $type . "' and c.status = '0'
        order by c.nome_corso desc;";
        return $sql;
    }
    function getNomeCorsoMax($type)
    {
        $sql = "select max(c.nome_corso) as 'nome_corso'
        from corso c 
        where c.tipologia = '" . $type . "';";
        return $sql;
    }
}
