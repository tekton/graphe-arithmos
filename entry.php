<?php

require_once 'base.php';
require_once 'body.php';
require_once 'notes.php';
require_once 'verse.php';

/**
 * Something of the functional implementation of the base class
 *
 * @author tekton
 */
class entry extends base {
    
    //See base.php for basic variables!!!
    
    public $json_array;
    
    public function create_new_entry() {
        //connect to the database
        $db = $this->ConnectDB();
        //create new entry, get the ID
        $title = "Untitled Entry ".gettimeofday(true);
        $q = "INSERT INTO entry (`title`) VALUES ('$title')";
        mysql_query($q, $db);
        $this->id = mysql_insert_id();
        //create empty body and notes
        $q = "INSERT INTO body (`body`, `entry_id`) VALUES ('', '".$this->id."')";
        mysql_query($q, $db);
        $q = "INSERT INTO notes (`notes`, `entry_id`) VALUES ('', '".$this->id."')";
        mysql_query($q, $db);
    }
    
    public function get_entry_data() {
        $db = $this->ConnectDB();
        
        $q = "select entry.id, entry.title, body.body, notes.notes from entry 
        LEFT JOIN (body, notes) on (body.entry_id = entry.id AND notes.entry_id = entry.id) 
        where entry.id = '".$this->id."'";
        
        $s = mysql_query($q);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $this->id = $result["id"];
            $this->body = $result["body"];
            $this->notes = $result["notes"];
            $this->title = $result["title"];
        }
     
        $this->json_array = json_encode(array("id" =>$this->id, "body" => $this->body, "notes" => $this->notes, "title" => $this->title));
    }
    
    public function updateTitle() {
        //hack test
        $db = $this->ConnectDB();
        $q = "UPDATE entry set title='".mysql_real_escape_string($this->title)."' where id='".$this->id."'";
        error_log($q);
        mysql_query($q, $db);
    }
}

?>
