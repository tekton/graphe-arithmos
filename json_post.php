<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


switch($_GET["slot"]) {
    case "body":
        require_once('body.php');
        $body = new body();
        $body->id = $_GET["id"];
        $body->body = $_POST["body"];
        $body->putBodyInDB();
        break;
    case "notes":
        require_once('notes.php');
        $note = new notes();
        $note->id = $_GET["id"];
        $note->notes = $_POST["notes"];
        $note->putNotesInDB();  
        break;
    case "title":
        require_once('entry.php');
        $title = new entry();
        $title->id = $_GET["id"];
        $title->title = $_POST["title"];
        $title->updateTitle();    
        break;
}

?>
