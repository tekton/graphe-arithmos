<?php
require_once 'entry.php';
/**
 * Basic communication class
 *
 * @author tekton
 */
class json extends entry {
    public $type;
    public $entry_id;
    public $title;
    
    public function getType($json) {
        return;
    }
    
    public function sendJson() {
        
        //eventually will check for type and send back accordingly, but since it's still test time...
        $db = $this->ConnectDB();
        
        $q = "select entry.id, entry.title, body.body, notes.notes from entry 
        LEFT JOIN (body, notes) on (body.entry_id = entry.id AND notes.entry_id = entry.id) 
        where entry.id = '".$this->entry_id."'";
        
        $s = mysql_query($q);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $this->id = $result["id"];
            $this->body = $result["body"];
            $this->notes = $result["notes"];
            $this->title = $result["title"];
        }
        $json = '{
            "x": [
                {
                    "id":"'.json_encode($this->id).'",
                    "body":"'.json_encode($this->body).'",
                    "notes":"'.json_encode($this->notes).'",
                    "title":"'.json_encode($this->title).'"
                }
            ]
        }';
     
        $json = array("id" =>$this->id, "body" => $this->body, "notes" => $this->notes, "title" => $this->title);
        return json_encode($json);
    }
}

$json = new json();
$json->entry_id = $_GET["id"];
echo $json->sendJson();

?>
