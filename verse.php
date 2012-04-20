<?php

require_once("base.php");

/**
 * Description of verse
 *
 * @author tekton
 */
class verse extends base {
    public $verse_id;
    
    public $start_book;
    public $start_chapter;
    public $start_verse;
    public $end_book;
    public $end_chapter;
    public $end_verse;
    
    public $verse_array;
    public $json_array;
    
    public $db;
    
    function __construct() {
        $this->verse_array = array();
        $this->json_array = array();
    }
    
    public function getVerseFromDB() {
        $db = $this->ConnectDB();
        $q = "SELECT * from verses as v
        LEFT JOIN books as b on v.start_book = b.id
        where v.id = '".$this->verse_id."'";
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $this->verse_array["id"] = $result["id"];
            $this->verse_array["entry_id"] = $result["entry_id"];
            $this->verse_array["book"] = $result["name"];
            $this->verse_array["chapter"] = $result["start_chapter"];
            $this->verse_array["v_start"] = $result["start_verse"];
            $this->verse_array["v_end"] = $result["end_verse"];
        }
        $this->json_array = json_encode($this->verse_array);
    }
    
    public function getAllVersesFromDB() {
        $db = $this->ConnectDB();
        $q = "SELECT v.id, v.start_book, v.start_chapter, v.start_verse, v.end_verse, b.name from verses as v
            LEFT JOIN books as b on v.start_book = b.id
            where v.entry_id = '".$this->id."' order by v.id asc";
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            //echo "<pre>"; print_r($result); echo "</pre>";
            $this->verse_array[$result["id"]] = array(
                "book" => $result["name"],
                "chapter" => $result["start_chapter"],
                "v_start" => $result["start_verse"],
                "v_end" => $result["end_verse"]
            );
        }
        
        $this->json_array = json_encode($this->verse_array);
    }
    
    public function putVerseInDB() {
        //try to insert, if that doesn't work, update!
        //hack test
        $this->db = $this->ConnectDB();
        $this->add_escape_to_all();
        $q = "INSERT INTO verses (`entry_id`,`start_book`,`start_chapter`, `start_verse`, `end_verse`) 
            VALUES (
                '".$this->id."',
                '".$this->start_book."',
                '".$this->start_chapter."',
                '".$this->start_verse."',
                '".$this->end_verse."'
            )";
        error_log($q);
        mysql_query($q, $this->db);
        $this->verse_id = mysql_insert_id();
    }
    
    public function single_verse_json() {
        $this->json_array = json_encode($this->verse_array);
    }
    
    function add_escape_to_all() {
        $this->start_book = mysql_real_escape_string($this->start_book, $this->db);
        $this->start_chapter = mysql_real_escape_string($this->start_chapter, $this->db);
        $this->start_verse = mysql_real_escape_string($this->start_verse, $this->db);
        $this->end_verse = mysql_real_escape_string($this->end_verse, $this->db);
    }
}

?>
