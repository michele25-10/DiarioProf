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
        $sql = "INSERT INTO incontro(id_corso, data_inizio, id_aula)
        VALUES ('" . $id_corso . "', '" . $data_inizio . "', '" . $id_aula . "'); ";
        return $sql;
    }
    function getArchieveIncontri()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM incontro i
        INNER JOIN corso c ON c.id = i.id_corso
        INNER JOIN aula a ON a.id = i.id_aula
        WHERE i.data_inizio > now() and c.status = '0'
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriToday()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM incontro i
        INNER JOIN corso c ON c.id = i.id_corso
        INNER JOIN aula a on i.id_aula = a.id
        WHERE date(i.data_inizio) = date(now()) and c.status = '0'
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriTomorrow()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM incontro i
        INNER JOIN corso c ON c.id = i.id_corso
        INNER JOIN aula a on i.id_aula = a.id
        WHERE date(i.data_inizio) = date(now() + interval 1 day) and c.status = '0'
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriNext15Days()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, a.nome
        FROM incontro i
        INNER JOIN corso c ON c.id = i.id_corso
        INNER JOIN aula a on i.id_aula = a.id
        where (i.data_inizio between date(now()) and date(now())+ interval 16 day) and c.status = '0'
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriById($id)
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note, i.id_aula, a.nome
        FROM incontro i
        INNER JOIN corso c ON c.id = i.id_corso
        INNER JOIN aula a ON i.id_aula = a.id
        WHERE i.id = '" . $id . "';";
        return $sql;
    }
    function updateIncontro($id, $data_inizio, $note, $id_aula)
    {
        $sql = "UPDATE incontro SET data_inizio = '" . $data_inizio . "', note = '" . $note . "', id_aula = '" . $id_aula . "' WHERE id = '" . $id . "'; ";
        return $sql;
    }


    function countIncontro()
    {
        $sql = " SELECT count(a.CF) as 'partecipanti', i2.data_inizio as 'data', c.nome_corso
       FROM alunno a 
       inner join iscrizione i on a.CF = i.id_alunno 
       inner join corso c on i.id_corso = c.id 
       inner join incontro i2 on c.id = i2.id_corso 
       where (i2.data_inizio between date(now()) and date(now())+ interval 16 day) and c.status = '0'
       group by i2.data_inizio;";
        return $sql;
    }

    function getStudentsIncontro($date, $ora)
    {
        $sql = " SELECT a.nome, a.cognome,if(a.id_menu is null or a.id_menu = '-1', 'Classico', m.tipologia) as 'menu'
       FROM alunno a 
       inner join iscrizione i on a.CF = i.id_alunno 
       inner join corso c on i.id_corso = c.id 
       inner join incontro i2 on c.id = i2.id_corso 
       left join menu m on m.id = a.id_menu
    where (i2.data_inizio ='" . $date . "-" . $ora . "');";
        return $sql;
    }
}
