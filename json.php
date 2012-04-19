<?php
require_once 'entry.php';
/**
 * Basic communication class
 *
 * @author tekton
 */
class json {
    public $type;
    public $entry_id;
    public $title;
    
    public function sendJson($type) {
        switch($type) {
            case "verses":
                require_once("verse.php");
                $verse = new verse();
                $verse->id = $this->entry_id;
                $verse->getAllVersesFromDB();
                return $verse->json_array;
                break;
            case "verse":
                require_once("verse.php");
                $verse = new verse();
                $verse->id = $this->entry_id;
                $verse->verse_id = $_GET["v_id"];
                $verse->getVerseFromDB();
                return $verse->json_array;
                break;
            case "entry":
                require_once("entry.php");
                $entry = new entry();
                $entry->id = $this->entry_id;
                $entry->get_entry_data();
                return $entry->json_array;
                break;
        }
    }
}

$json = new json();
$json->entry_id = $_GET["id"];
$type = (isset($_GET["type"])) ? $_GET["type"] : "entry";
echo $json->sendJson($type);

?>
