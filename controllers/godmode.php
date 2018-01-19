<?php

class GodmodeController{

    private $conn;
    private $db;
    private $session;

    private $user;
    private $lastLogged;

    public function __construct(connection $conn, crud $db, SessionsHandler $session){
        $this->conn = $conn;
        $this->db = $db;
        $this->session = $session;

        # Make sure our user is logged in
        self::checkLoggedIn();
        self::setLastLoggedIn();
    }

    /**
     * Confirms that the user is logged in
     * @return    Sets the $user variable, which holds
     *            the logged in persons information
     */
    private function checkLoggedIn(){

        # Throw away if not logged in
        if (!$this->session->isset('sloaLogged'))
            header("location:index.php");

        # Fetch the user information
        $select = ['*' => 'users'];
        $where  = ['id' => $this->session->get('sloaLogged')];
        if (!$result = $this->db->read($select, $where))
            header("locaton:index.php");

        $this->user = $result;
    }

    /**
     * Return the username for the view
     * @return string The username from the db
     */
    public function getUsername(){
        return $this->user[0]['uname'];
    }

    /**
     * Fetch, from the db, when the last login was
     */
    private function setLastLoggedIn(){
        $select = ['time' => 'events'];
        $user   = $this->user[0]['id'];
        $where  = ['uid' => $user, 'event' => 'Succesfuldt login']; # TODO: Might change logging at a later point
        $order  = ['id' => 'desc'];
        $limit  = 1;

        if (!$result = $this->db->read($select, $where, $order, $limit))
            $result = 'Første login - Velkommen.';

        $this->lastLogged = $result;
    }

    /**
     * Returns the last logged in value for the view
     * @return string The data and time for last login
     */
    public function getLastLoggedIn(){
        return $this->lastLogged[0]['time'];
    }
}

?>