<?php

class Admin {

    private $conn;
    private $db;
    private $session;

    public $user;
    public $lastLogged;

    public function __construct(Connection $conn, Crud $db, SessionsHandler $session){
        $this->conn = $conn;
        $this->db = $db;
        $this->session = $session;

        self::userInfo();
    }

    /**
     * Confirms that the user is logged in
     * @return    Sets the $user variable, which holds
     *            the logged in persons information
     */
    private function userInfo(){

        # Throw away if logged-in session is not set
        if (!$this->session->isset("sloaLogged"))
            header("location:index.php");

        # Fetch the user information
        $select = ['*' => 'users'];
        $where  = ['peper' => $this->session->get('sloaLogged')];
        if (!$result = $this->db->read($select, $where)){
            var_dump($result);
            $this->session->destroy();
            header("locaton:index.php");
        }

        $this->user = $result;
        self::setLastLoggedIn();
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
                            # TODO: will cause error when being read as array later
        if (!$result = $this->db->read($select, $where, $order, $limit))
            $result = 'Første login - Velkommen.';

        $this->lastLogged = $result;
    }
}

?>