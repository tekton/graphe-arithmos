<?php

require_once 'db.php';

/**
 * base is just that, the base class for all other functional classes
 *
 * @author tekton
 */
class base extends db {

    /**
     * 
     * @var int $id The entry ID for the item at hand
     */
    public $id;
    public $verses;
    public $body;
    public $notes;
    public $status;
    public $title;
    

}

?>
