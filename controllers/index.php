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
        $select = ['txt' => 'main'];
        $where  = ['id' => 1];
        $result = $this->db->read($select, $where);
        return $result['txt'];
    }
    
}

?>