<?php

require_once 'db.php';

/**
 * JSON relation class to get books in list or full name form based
 *
 * @author tekton
 */
class books extends db {
    private $db;
    public $json;
    
    /**
     *
     * Create the database connection to be used 
     * 
     */
    public function __construct() {
        $this->db = $this->ConnectDB();
    }
    
    /**
     *
     * Returns a list of the books in the Bible 
     * 
     */
    public function get_books() {
        $return_array = array();
        $q = "SELECT * from books order by id asc";
        $s = mysql_query($q, $this->db);
        //$this->json = json_encode($s);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $return_array[] = $result["name"];
        }
        $this->json = json_encode($return_array);
        return $return_array;
    }
    
}

$books = new books();
$books->get_books();
echo $books->json;

?>
