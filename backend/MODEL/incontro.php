<?php
class Incontro
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function addIncontro($id_corso, $data_inizio, $id_aula)
    {
        $sql = "INSERT INTO diario.incontro(id_corso, data_inizio, id_aula)
        VALUES ('" . $id_corso . "', '" . $data_inizio . "', '" . $id_aula . "'); ";
        return $sql;
    }
    function getArchieveIncontri()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        INNER JOIN diario.aula a ON a.id = i.id_aula
        WHERE i.data_inizio > now() 
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriToday()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        INNER JOIN diario.aula a on i.id_aula = a.id
        WHERE date(i.data_inizio) = date(now()) 
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriTomorrow()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        INNER JOIN diario.aula a on i.id_aula = a.id
        WHERE date(i.data_inizio) = date(now() + interval 1 day)
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriNext15Days()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        INNER JOIN diario.aula a on i.id_aula = a.id
        where (i.data_inizio between date(now()) and date(now())+ interval 16 day)
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriById($id)
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, i.id_aula, a.nome
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        INNER JOIN diario.aula a ON i.id_aula = a.id
        WHERE i.id = '" . $id . "';";
        return $sql;
    }
    function updateIncontro($id, $data_inizio, $note, $id_aula)
    {
        $sql = "UPDATE diario.incontro SET data_inizio = '" . $data_inizio . "', note = '" . $note . "', id_aula = '" . $id_aula . "' WHERE id = '" . $id . "'; ";
        return $sql;
    }


    function countIncontro()
    {
        $sql = " SELECT count(a.CF) as 'partecipanti', i2.data_inizio as 'data', c.nome_corso
       FROM alunno a 
       inner join iscrizione i on a.CF = i.id_alunno 
       inner join corso c on i.id_corso = c.id 
       inner join incontro i2 on c.id = i2.id_corso 
       where (i2.data_inizio between date(now()) and date(now())+ interval 16 day)
       group by i2.data_inizio;";
        return $sql;
    }

    function getStudentsIncontro($date, $ora)
    {
        $sql = " SELECT a.nome, a.cognome 
       FROM alunno a 
       inner join iscrizione i on a.CF = i.id_alunno 
       inner join corso c on i.id_corso = c.id 
       inner join incontro i2 on c.id = i2.id_corso 
    where (i2.data_inizio ='" . $date . "-" . $ora . "');";
        return $sql;
    }
}
