<?php

include_once('models/base64.php');
include_once('models/validators.php');

class PortfolioController{

    private $conn;
    private $db;
    private $b64;
    private $val;

    private $allProjects;
    private $allCategories;
    private $category;

    public function __construct(connection $conn, crud $db){
        $this->conn = $conn;
        $this->db = $db;
        $this->b64  = new Base64();
        $this->val  = new Validators();

        self::getAllCategories();
        self::getAllProjects();
    }

    /**
     * Gets, and sets, all and current category
     * @return    Sets $allCategories and $category (current)
     */
    private function getAllCategories(){
        $select = ['id,category' => 'categories'];
        $where  = ['portfolio' => 1];

        $this->allCategories = $this->db->read($select, $where);

        # Set the current category, if found in our array of categories
        if (isset($_GET['kategori'])){
            foreach ($this->allCategories as $key) {
                if (strtolower($_GET['kategori']) == strtolower($key['category']))
                    $this->category = strtolower($key['id']);
            }
        }
    }

    /**
     * Fetches all the project, according to chosen category, from the database
     * @return array All related portfolio projects from the database
     */
    private function getAllProjects(){
        $select = ['portfolio.*, media.file, media.thumb, media.txt AS imageAlt' => 'portfolio'];
        $order  = ['portfolio.id' => 'DESC'];
        $clause = ['portfolio.id' => 'media.mid', 'media.portfolio' => 1, 'media.preview' => 1];
        $join   = ['left' => 'media', $clause];
        $where  = null;
        if ($this->category != null)
            $where  = ['category' => $this->category];

        $this->allProjects = $this->db->read($select, $where, $order, null, $join);
    }

    /**
     * Returns all the categories for the view
     * @return array All portfolio related categories from the database
     */
    public function getCategories(){
        return $this->allCategories;
    }

    /**
     * Returns all the projects, according to category, for the view
     * @return array Portfolio projects from the db
     */
    public function getProjects(){
        return $this->allProjects;
    }

    /**
     * Encode the ID for URL usage
     * @param  int    $id The id of the blog post
     * @return string     The encoded id
     */
    public function encodeId (int $id) {
        return $this->b64->encode($id);
    }

    /**
     * Decodes the ID passed by the URL
     * @param  string $id The encoded string
     * @return int        The decoded id
     */
    public function decodeId (string $id) {
        return $this->b64->decode($id);
    }

    /**
     * Validates the id and matches it to the project array
     * @return bool TRUE/FALSE if found in projects)
     */
    public function checkId(){

        # Looks for GET[id]
        if(!isset($_GET['id']))
            return false;

        # Converts (b64) and confirm id is an integer
        $id = self::decodeId($_GET['id']);
        if (!$this->val->valInt($id))
            return false;

        # Return project result if found
        $search = array_search($id, array_column($this->allProjects, 'id'));
        if ($search || $search === 0) {
            $result   = $this->allProjects[$search];
            $imageAlt = "Preview Billede";
            if(!empty($result['imageAlt']))
                $imageAlt = $result['imageAlt'];
            $result['imageAlt'] = $imageAlt;
            return $result;
        }

        return false;
    }
}

?>