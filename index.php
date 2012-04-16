<?php

require_once 'entry.php';

/**
 * graphe-arithmos is a work in progress for collecting Bible study notes in one place for future sharing
 * 
 * @author tekton 
 */


/* FUNCTIONS */
function redirect($page) {
    echo "<html><META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=$page\"></html>";
}

function head() {
    //create the html for the basic header to include javascript and css files
}
/* /FUNCTIONS */
////////////////
/* Load Logic */

if($_GET) {
    //only using if/thens for prototyping and testing jquery ajax-y calls
    if($_GET["action"]) {
        if($_GET["action"] == "new") {
            $entry = new entry();
            $entry->create_new_entry();
            redirect("?id=".$entry->id);
        }
    }
    
    if($_GET["id"]) {
        $entry = new entry();
        $entry = $_GET["id"];
    }
} else if($_POST) {
    
} else {
    //wtf?!
}

?>
