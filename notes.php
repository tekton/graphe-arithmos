<?php

require_once 'base.php';

/**
 * Description of notes
 *
 * @author tekton
 */
class notes extends base {
    public $notes_id;
    
    public function getNotesFromDB() {
        $db = $this->ConnectDB();
        $q = "SELECT * from notes where entry_id = '".$this->id."'";
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, $result_type)) {
            $this->notes_id = $result["id"];
            $this->notes = $result["notes"];
        }
    }
    
    public function putNotesInDB() {
        //try to insert, if that doesn't work, update!

        //hack test
        $db = $this->ConnectDB();
        $q = "UPDATE notes set notes='".mysql_real_escape_string($this->notes)."' where entry_id='".$this->id."'";
        error_log($q);
        mysql_query($q, $db);
    }
}

?>
