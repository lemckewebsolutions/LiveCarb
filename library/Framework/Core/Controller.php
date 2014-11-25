<?php
class Framework_Core_Controller
{
    private $database;
    private $basepath;

    public static $instance = null;

    function __construct()
    {
        $this->setDatabase(new Framework_Database());
        if (strtolower(php_uname('n')) == 'lwsvm'){
            error_reporting(E_ALL);
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors',1);
            $this->basepath = 'http://192.168.1.39/';
        } else {
            $this->basepath = 'http://cgk-ridderkerk.nl';
        }
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Gets the database object.
     * @return Framework_Database
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Sets the database object.
     * @param Framework_Database $db
     */
    public function setDatabase($db)
    {
        $this->database = $db;
    }

    public function getBasePath()
    {
        return $this->basepath;
    }
}
?>
