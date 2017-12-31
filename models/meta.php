<?php

class PageMeta {

    private $title       = "sloa.dk";
    private $description = "Privat Portfolio";
    private $keywords    = "Web, Datamatiker, Udvikling, Portfolio";
    private $follow      = "index, follow";
    private $author      = "Henrik Jeppesen";

    private $select      = ['*' => 'meta'];
    private $where       = ['main' => 1];

    private $conn;
    private $db;

    public function __construct(connection $conn, crud $db, string $page){

        $this->conn = $conn;
        $this->db   = $db;

        # Select the page to fetch meta for
        $files = scandir('controllers');
        $check = strtolower($page.".php");
        if(in_array($check, $files))
            $this->where = [substr($check, 0, -4) => 1];

        # The naming in the db is a bit off (EN/DA)
        if(key($this->where) == 'index')
            $this->where = ['main' => 1];
        if(key($this->where) == 'kontakt')
            $this->where = ['contact' => 1];

        # Set the variables
        try{
            $result            = $this->db->read($this->select, $this->where);
            $this->title       = $result[0]['title'];
            $this->description = $result[0]['description'];
            $this->keywords    = $result[0]['keywords'];
            $this->follow      = $result[0]['follow'];

            $where             = ['author' => 1];
            $result            = $this->db->read($this->select, $where);
            $this->author      = $result[0]['description'];
        }catch(Exception $e){ }
    }

    # Get methods for our data
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getKeywords(){
        return $this->keywords;
    }
    public function getFollow(){
        return $this->follow;
    }
    public function getAuthor(){
        return $this->author;
    }
}

?>