<?php

class BlogController extends Admin {

    private $conn;
    private $db;
    private $session;

    private $posts; # All blog posts
    private $articles;
    private $notes;

    public function __construct(Connection $conn, Crud $db, SessionsHandler $session){
        $this->conn    = $conn;
        $this->db      = $db;
        $this->session = $session;

        $this->articles = array();
        $this->notes    = array();
        self::setPosts();
    }

    private function setPosts() {
        $select      = ['blog.*, categories.category' => 'blog'];
        $order       = ['blog.cid' => 'desc'];
        $clause      = ['blog.cid' => 'categories.id', 'categories.blog' => 1];
        $join        = ['left' => 'categories', $clause];
        $this->posts = $this->db->read($select, null, null, null, $join);
        self::orderPosts();
    }

    /**
     * Orders the results from the db to their rightful category
     * @return     Sorts blog posts to $notes[] and $articles[]
     */
    private function orderPosts() {
        foreach ($this->posts as $key) {
            if (strtolower($key['category']) == "notater")
                $this->notes[] = $key;
            else
                $this->articles[] = $key;
        }
    }

    /**
     * Returns all notes to the view
     * @return array blog (notes) from the db
     */
    public function getNotes() {
        return $this->notes;
    }

    /**
     * Return all articles for the view
     * @return array blog (articles) from the db
     */
    public function getArticles() {
        return $this->articles;
    }

    public function getPosts() {
        return $this->posts;
    }
}

?>