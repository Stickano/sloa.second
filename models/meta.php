<?php

class PageMeta {

    private $title       = "sloa.dk";
    private $description = "Privat Portfolio";
    private $keywords    = "Web, Datamatiker, Udvikling, Portfolio";
    private $follow      = "index, follow";
    private $author      = "Henrik Jeppesen";

    private $address     = null;
    private $bcAddress   = null;
    private $mail        = null;
    private $phone       = null;
    private $name        = null;
    private $socialMedia = array();

    private $conn;
    private $db;
    private $page;

    public function __construct(connection $conn, crud $db, string $page){

        $this->conn = $conn;
        $this->db   = $db;
        $this->page = $page;

        if (substr($this->page, 0, 5) == "admin")
            $this->page = "godmode";

        self::setMeta();
        self::setContact();
        self::setSocialMedia();
    }

    /**
     * Fetch and sets the meta data for the provided page from the db.
     */
    private function setMeta(){

        # Select the page to fetch meta for
        $files = scandir('controllers');
        $check = strtolower($this->page.".php");

        if(in_array($check, $files))
            $where = [substr($check, 0, -4) => 1];

        # The naming in the db is a bit off (EN/DA)
        if(key($where) == 'index')
            $where = ['main' => 1];
        if(key($where) == 'kontakt')
            $where = ['contact' => 1];

        # Set the variables
        try{
            $select            = ['*' => 'meta'];
            $where             = ['main' => 1];
            $result            = $this->db->read($select, $where);

            $this->title       = $result[0]['title'];
            $this->description = $result[0]['description'];
            $this->keywords    = $result[0]['keywords'];
            $this->follow      = $result[0]['follow'];

            $where             = ['author' => 1];
            $result            = $this->db->read($select, $where);
            $this->author      = $result[0]['description'];
        }catch(Exception $e){ }
    }

    /**
     * Sets the contact information for the sidebar. Fetched from the db.
     */
    private function setContact(){

        try{
            $select            = ['*' => 'footer'];
            $order             = ['id' => 'DESC'];
            $limit             = 1;
            $result            = $this->db->read($select, null, $order, $limit);

            $this->address     = $result[0]['adress'];
            $this->bcAddress   = $result[0]['bitcoin'];
            $this->mail        = $result[0]['mail'];
            $this->phone       = $result[0]['phone'];
            $this->name        = $result[0]['name'];
        }catch(Exception $e){ }
    }

    /**
     * Fetch all the social medias from the database
     */
    private function setSocialMedia(){
        $select = ['*' => 'socialmedia'];
        $order  = ['id' => 'desc'];
        $this->socialMedia = $this->db->read($select, null, $order);
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

    # Get method for the sidebar contact info
    public function getAddress(){
        return $this->address;
    }
    public function getBcAddress(){
        return $this->bcAddress;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getName(){
        return $this->name;
    }

    # Sidebar social media
    public function getSocialMedia(){
        return $this->socialMedia;
    }
}

?>