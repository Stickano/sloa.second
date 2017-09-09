<?php

@session_start();
require_once('models/connection.php');
require_once('models/database.php');
require_once('models/time.php');
require_once('models/meta.php');
require_once('models/security.php');
require_once('resources/sessionHandler.php');
require_once('resources/credentials.php');

final class Singleton {

    private static $instance;

    # database connection
    private static $conn;  
    private static $crud;
    private static $security;

    # Some typical classes
    public static $time;
    public static $meta;
    public static $session;

    # View and Controller
    public static $page;
    public static $controller;

    # Private constructor to ensure it won't be initialized
    private function __construct(){}

    /**
     * This is the initializer for this object
     * It will initialize a Connection and CRUD class
     * It will determine which View to load and its apropriate Controller
     * It will store the page you hit (nowPage), along with storing the previous page (prePage)
     * And it will initialize a couple of typical classes, like meta and time (used in footer) 
     * @return object This (only) instance 
     */
    public static function init(){
        if(!isset(self::$instance)){

            self::$instance = new self();
            
            self::setConn();
            self::setDb();
            self::getPage();

            self::$time = new time();
            self::$security = new security();
            self::$meta = new PageMeta(self::conn(), self::db(), self::$page);
            self::$session = SessionsHandler::init();
            
            self::setHttps();
            self::setPage();
            self::pageController();
        }

        return self::$instance;
    }

    /**
     * This will determine which page(view) to load
     */
    private static function getPage(){
        $pages = ['index','blog','info','portfolio','services','kontakt'];
        $search = array_intersect($pages, array_keys($_GET));
        self::$page = $pages[0];

        if($search){
            $search = array_values($search);
            self::$page = $search[0];
        }
    }

    /**
     * This will use the HTTPS (Re)connect method in the security class
     */
    private static function setHttps(){
        self::$security->SecureConnect();
    }

    /**
     * This will load the appropriate controller
     */
    public static function pageController(){
        require_once('controllers/'.self::$page.'.php');
        $controller = ucfirst(self::$page).'Controller';
        self::$controller = new $controller(self::conn(), self::db(), self::$session); 
    }

    /**
     * Creates a connection object
     */
    private static function setConn(){
        // self::$conn = new connection(self::host, self::user, self::pass, self::db); 
        $credentials = new Credentials();
        $val = $credentials->get();
        self::$conn = new connection($val['host'], $val['user'], $val['pass'], $val['db']); 
    }

    /**
     * Creates a CRUD object
     */
    private static function setDb(){
        self::$crud = new crud(self::conn());
    }

    /**
     * Returns the connection
     * @return object Connection class
     */
    public static function conn(){
        return self::$conn;
    }

    /**
     * Return the CRUD methods
     * @return object Class holding the CRUD methods
     */
    public static function db(){
        return self::$crud;
    }

    /**
     * Will generate '&nbsp;'  
     * @param  int    $count The amount of spaces 
     * @return string        The spaces
     */
    public function spaces($count){
        $spaces = '';
        for($i=0; $i<$count; $i++){
            $spaces .= '&nbsp;';
        }
        return $spaces;
    }

    /**
     * Returns the current URL address
     * @return string URL
     */
    public function getUrl(){
        $qs = null;
        if(!empty($_SERVER['QUERY_STRING']))
            $qs = "?".$_SERVER['QUERY_STRING'];
        $url = $_SERVER['PHP_SELF'].$qs;
        return $url;
    }

    /**
     * Sets the current and previous page for navigation purposes
     */
    private static function setPage() {
        if (self::$session->isset("nowPage") && self::$session->get("nowPage") != self::$instance->getUrl())
            self::$session->set("prePage", self::$session->get("nowPage"));
        self::$session->set("nowPage", self::$instance->getUrl());
    }
}

?>