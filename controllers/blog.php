<?php

class BlogController{

    private $conn;
    private $db;
    public function __construct(connection $conn, crud $db){
        $this->conn = $conn;
        $this->db = $db;
    }

    public function getPosts() {
        $result = $this->db->recieve("*", "blog", null, "id", "DESC");
        return $result;
    }

    public function getImages(int $mid) {
        $result = $this->db->recieve("*", "media", "blog=1 AND mid=".$mid);
        return $result;
    }

}

?>