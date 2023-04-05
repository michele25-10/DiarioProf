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
        VALUES ('" . $tipologia . "', '" . $id_quadrimestre . "', '" . $id_docente . "', '" . $id_tutor . "', '" . $materia . "', '" . $data_inizio . "', '" . $data_fine . "', '" . $nome_corso . "', '" . $sede . "');";
        return $sql;
    }
}
