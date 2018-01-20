<?php

class MetaController extends Admin {

    private $conn;
    private $db;
    private $session;

    public function __construct(Connection $conn, Crud $db, SessionsHandler $session){
        $this->conn    = $conn;
        $this->db      = $db;
        $this->session = $session;
    }
}

?>