<?php

require_once 'base.php';
require_once 'body.php';
require_once 'notes.php';
require_once 'verses.php';

/**
 * Something of the functional implementation of the base class
 *
 * @author tekton
 */
class entry extends base {
    
    //See base.php for basic variables!!!
    
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
        //connect to the database and get basic entry data
    }
}

?>
