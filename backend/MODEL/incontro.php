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
    function getIncontriToday()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note 
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        WHERE date(i.data_inizio) = date(now()) 
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriTomorrow()
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note 
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        WHERE date(i.data_inizio) = date(now() + interval 1 day)
        order by i.data_inizio desc;";
        return $sql;
    }
    function getIncontriById($id)
    {
        $sql = "SELECT i.id, c.nome_corso as 'id_corso', i.data_inizio, i.note 
        FROM diario.incontro i
        INNER JOIN diario.corso c ON c.id = i.id_corso
        WHERE i.id = '" . $id . "';";
        return $sql;
    }
    function updateIncontro($id, $data_inizio, $note)
    {
        $sql = "UPDATE diario.incontro 
                SET data_inizio = '" . $data_inizio . "', note = '" . $note . "'
                WHERE id = '" . $id . "'; ";
        return $sql;
    }

    function countIncontro(){
        $sql = " SELECT count(a.CF) as 'partecipanti', i2.data_inizio as 'data'
       FROM alunno a 
       inner join iscrizione i on a.CF = i.id_alunno 
       inner join corso c on i.id_corso = c.id 
       inner join incontro i2 on c.id = i2.id_corso 
       where (i2.data_inizio between date(now()) and date(now())+ interval 16 day)
       group by i2.data_inizio;";
       return $sql;
    }
}
