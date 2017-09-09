<?php

include_once('models/base64.php');
include_once('models/validators.php');

class BlogController{

    private $conn;
    private $db;
    private $b64;
    private $val;

    private $posts = array();

    public function __construct(connection $conn, crud $db){
        $this->conn = $conn;
        $this->db = $db;
        $this->b64 = new base64();
        $this->val = new validators();

        $this->posts = self::getPosts();
        self::checkId();
    }

    /**
     * Returns an array of all the blog posts
     * @return array Blog posts from db
     */
    public function getPosts() {
        $result = $this->db->recieve("blog.*, media.file, media.txt AS imageAlt",
                                     "blog", 
                                     null, 
                                     "blog.id", 
                                     "DESC", 
                                     null, 
                                     "LEFT", 
                                     "media", 
                                     "blog.id=media.mid AND media.blog=1"); 
        return $result;
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
            $result = $this->posts[$search];
            $imageAlt = "Blog Billede";
            if(!empty($result['imageAlt']))
                $imageAlt = $result['imageAlt'];
            $result['imageAlt'] = $imageAlt;
            return $result;
        }

        return false;
    }
}

?>