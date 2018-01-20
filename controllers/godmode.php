<?php

class GodmodeController extends Admin {

    private $conn;
    private $db;
    private $session;

    private $subConroller;

    function __construct(Connection $conn, Crud $db, SessionsHandler $session) {
        $this->conn = $conn;
        $this->db = $db;
        $this->session = $session;
        parent::__construct($this->conn, $this->db, $this->session);
    }

    /**
     * Return the username for the view
     * @return string The username from the db
     */
    public function getUsername() {
        return $this->user[0]['uname'];
    }

    /**
     * Returns the last logged in value for the view
     * @return string The data and time for last login
     */
    public function getLastLoggedIn() {
        return $this->lastLogged[0]['time'];
    }
}

?>