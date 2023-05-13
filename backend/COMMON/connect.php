<?php
class Database
{

    //credentials localhost
    private $server_local = "dispersione.violamarchesini.it";
    private $user_local = "ugqjtwt4xzhta";
    private $passwd_local = "oshw6uz1pyfn";
    private $db_local = "dbsgn9iqrgbhey";

    //common credentials
    private $port = "3306";
    public $conn;

    public function connect() //effettua la connessione al server

    {
        try {
            $this->conn = new mysqli($this->server_local, $this->user_local, $this->passwd_local, $this->db_local, $this->port);
        }
        //la classe mysqli non estende l'interfaccia Throwable e non può essere usata come un'eccezione. 
        catch (Exception $ex) {
            die("Error connecting to database $ex\n\n");
        }
        return $this->conn;
    }
}

?>