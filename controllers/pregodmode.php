<?php

require_once 'models/login.php';

class PregodmodeController{

    private $conn;
    private $db;
    private $session;
    private $login;

    public function __construct(connection $conn, crud $db, SessionsHandler $session){

        $this->conn    = $conn;
        $this->db      = $db;
        $this->session = $session;

        # Initialize our Login model
        $this->login = new Login($this->conn);
        $this->login->defineDb('users', 'mail', 'upass');
        $this->login->setFailed('Login Mislykket');
    }

    /**
     * Takes the values and passes em' along to the login model
     * @return redirect CMS if pass, else same page
     */
    public function login(){
        $uname = $_POST['uname'];
        $upass = $_POST['upass'];

        try {
            $this->login->login($uname, $upass);
            header("location:?godmode");
        } catch(Exception $e) {
            $this->session->set('error', $e->getMessage());
            header("location:?pregodmode");
        }
    }
}

?>