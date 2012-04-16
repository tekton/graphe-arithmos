<?php
require_once 'base.php';

/**
 * Description of body
 *
 * @author tekton
 */
class body extends base {
    
    public $body_id;
    
    public function getBodyFromDB() {
        $db = $this->ConnectDB();
        $q = "SELECT * from body where entry_id = '".$this->id."'";
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, $result_type)) {
            $this->body_id = $result["id"];
            $this->body = $result["body"];
        }
    }
    
    public function putBodyInDB() {
        //try to insert, if that doesn't work, update!

        //hack test
        $db = $this->ConnectDB();
        $q = "UPDATE body set body='".mysql_real_escape_string($this->body)."' where entry_id='".$this->id."'";
        error_log($q);
        mysql_query($q, $db);
    }
}

?>
