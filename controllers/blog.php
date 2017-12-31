<?php

include_once('models/base64.php');
include_once('models/validators.php');

class BlogController{

    private $conn;
    private $db;
    private $b64;
    private $val;

    # View values
    private $posts         = array();
    private $forwardButton = array();
    private $lessButton    = array();
    private $categories    = array();
    private $jumpTo        = 1;
    private $pageAmount    = 6;
    private $category;     # Current category

    public function __construct(Connection $conn, Crud $db){
        $this->conn = $conn;
        $this->db   = $db;
        $this->b64  = new Base64();
        $this->val  = new Validators();

        self::setCategories();
        self::checkPageAmount();
        self::setPosts();
        self::checkId();
    }

    /**
     * Collect all the blog-posts from the database
     */
    private function setPosts() {
        $page        = self::checkPage();
        $posts       = $this->pageAmount * $page;

        $select      = ['blog.*, media.file, media.thumb, media.txt AS imageAlt' => 'blog'];
        $order       = ['blog.id' => 'desc'];
        $limit       = $posts;
        $clause      = ['blog.id' => 'media.mid', 'media.blog' => 1];
        $join        = ['left' => 'media', $clause];
        $where       = ['cid' => $this->category];

        $result      = $this->db->read($select, $where, $order, $limit, $join);
        $this->posts = $result;

    }

    /**
     * Collect the categories from the database
     */
    private function setCategories(){
        $select           = ['id, category' => 'categories'];
        $where            = ['blog' => 1];
        $order            = ['category' => 'asc'];
        $result           = $this->db->read($select, $where, $order);
        $this->categories = $result;
    }

    /**
     * Return the categories for the view
     * @return array All the categories for the blog page
     */
    public function getCategories(){
        return $this->categories;
    }

    /**
     * Check if there's articles to show on next page
     * @return int page number (1 if not valid)
     */
    private function checkPage(){
        $select = ['COUNT(*)' => 'blog'];
        $where  = ['cid' => $this->category];
        $amount = $this->db->read($select, $where);
        $page   = 1;

        if(isset($_GET['side']) && $this->val->valInt($_GET['side']) && $_GET['side'] > 0)
            $page = $_GET['side'];

        # Check availability for NEXT page
        $dbAmount      = $amount[0]['COUNT(*)'];
        $currentAmount = $page * $this->pageAmount;
        $nextAmount    = ($page+1) * $this->pageAmount;

        if (!(($dbAmount-$currentAmount) > -$this->pageAmount)){
            $page          = 1;
            $currentAmount = $page * $this->pageAmount;
            $nextAmount    = ($page+1) * $this->pageAmount;
        }

        # So we can jump to the appropriate place on the view page
        $this->jumpTo = $currentAmount;

        # Values for the forward button
        if (($dbAmount-$nextAmount) > -$this->pageAmount)
            $this->forwardButton = ['forward' => true, 'page' => $page+1];
        else
            $this->forwardButton = ['forward' => false];

        # Values for the less button
        if ($page != 1)
            $this->lessButton = ['less' => true, 'page' => $page-1];
        else
            $this->lessButton = ['less' => false];

        return $page;
    }

    /**
     * Returns the view values to the more (articles) button
     * @return array If available (forward=>true) and next (page)
     */
    public function getMore(){
        return $this->forwardButton;
    }

    /**
     * Return the view values for the less (articles) button
     * @return array If available (less=>true) and previous (page)
     */
    public function getLess(){
        return $this->lessButton;
    }

    /**
     * When we fetch more/less articles, this will make sure
     * that the page will jump to a resonable place of the page
     * @return int The article to jump to
     */
    public function getJump(){
        return $this->jumpTo;
    }

    /**
     * Returns the array with the blog posts
     * @return array The amount of posts defined by setPosts()
     */
    public function getPosts() {
        return $this->posts;
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
     * Validates the id and matches it to the post array
     * @return bool TRUE/FALSE if found in posts)
     */
    public function checkId(){

        # Looks for GET[id]
        if(!isset($_GET['id']))
            return false;

        # Converts (b64) and confirm id is an integer
        $id = self::decodeId($_GET['id']);
        if (!$this->val->valInt($id))
            return false;

        # Return post result if found
        $search = array_search($id, array_column($this->posts, 'id'));
        if ($search || $search === 0) {
            $result   = $this->posts[$search];
            $imageAlt = "Blog Billede";
            if(!empty($result['imageAlt']))
                $imageAlt = $result['imageAlt'];
            $result['imageAlt'] = $imageAlt;
            return $result;
        }

        return false;
    }

    /**
     * Gets, and sets, the chosen articles per page amount
     * @return bool         Returns false if invalid number, else
     *                      it just sets the value.
     */
    private function checkPageAmount(){
        $values           = [6, 12, 25, 50];
        $this->pageAmount = $values[0];
        $this->category   = $this->categories[0]['id'];

        if (isset($_GET['kategori'])){
            foreach ($this->categories as $key) {
                if (strtolower($_GET['kategori']) == strtolower($key['category']))
                    $this->category = strtolower($key['id']);
            }
        }

        if (!isset($_GET['antal']) || $_GET['antal'] == 6 || !in_array($_GET['antal'], $values))
            return;

        $this->pageAmount = $_GET['antal'];
    }
}
?>