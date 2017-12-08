<?php

class PageMeta {

    private $title = "sloa.dk";
    private $description = "Privat Portfolio";
    private $keywords = "Web, Datamatiker, Udvikling, Portfolio";
    private $follow = "index, follow";
    private $author = "Henrik Jeppesen";

    private $data = "*";
    private $from = "meta";
    private $where = "main=1";

    private $conn;
    private $db;

    public function __construct(connection $conn, crud $db, string $page){

        $this->conn = $conn;
        $this->db = $db;
        
        # Select the page to fetch meta for
        $files = scandir('controllers');
        $check = strtolower($page.".php");
        if(in_array($check, $files))
            $this->where = substr($check, 0, -4)."=1";

        # The naming in the db is a bit off (EN/DA)
        if($this->where == 'index=1')
            $this->where = 'main=1';
        if($this->where == 'kontakt=1')
            $this->where = 'contact=1';
        

        # Set the variables
        $result = $this->db->receive($this->data, $this->from, $this->where);
        $this->title = $result['title'];
        $this->description = $result['description'];
        $this->keywords = $result['keywords'];
        $this->follow = $result['follow'];
    
        $result = $this->db->receive($this->data, $this->from, 'author=1');
        $this->author = $result['description'];

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