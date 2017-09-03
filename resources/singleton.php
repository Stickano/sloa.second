<?php

require_once('models/connection.php');
require_once('models/database.php');
require('resources/credentials.php');
require_once('models/time.php');
require_once('models/meta.php');

final class Singleton {

    # database connection
    private static $conn;  
    private static $crud;
    // const host = '';
    // const user = '';
    // const pass = '';
    // const db = '';

    # Private constructor to ensure it won't be initialized
    private function __construct(){}

    # Return the instance
    private static $instance;
    public static function init(){
        if(!isset(self::$instance)){
            self::$instance = new self();
            self::setConn();
            self::setDb();
        }

        return self::$instance;
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
     * Method to determine which controller to load
     * @param  int    $file Passing 1 will return the filename
     * @return string       Return the controller class name or filename
     */
    public function controller($file=null){
        $page = basename($_SERVER['PHP_SELF']);
        if($file == 1)
            return $page;
        $page = ucfirst($page);
        $page = substr($page, 0, -4);
        return $page."Controller";
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

}

?>