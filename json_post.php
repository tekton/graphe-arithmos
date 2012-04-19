<?php
/**
 *
 * JSON posting logic; consolidating for hacky testing hacks
 *  
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
    case "verse":
        require_once("verse.php");
        $verse = new verse();
        $verse->id = $_GET["id"];
        $verse->start_book = $_POST["book"];
        $verse->start_chapter = $_POST["chapter"];
        $verse->start_verse = $_POST["v_start"];
        $verse->end_verse = $_POST["v_end"];
        $verse->putVerseInDB();
        break;
}

?>
