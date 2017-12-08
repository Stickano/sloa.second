<?php

class IndexController{

    private $conn;
    private $db;
    public function __construct(connection $conn, crud $db){
        $this->conn = $conn;
        $this->db = $db;
    }

    /**
     * Will return the welcome message
     * @return string Frontpage-message
     */
    public function getMessage(){
        $result = $this->db->receive('txt','main','id=1');
        return $result['txt'];
    }
    
}

?>