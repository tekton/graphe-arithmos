<?php

/*start global variables */
define('DB', 'ga');          // Database name -- all lower case OR uppercase, not both
define('USER', 'root');             // MySQL username
define('PASSWORD', 'Blizzard1');    // MySQL password
define('HOST', 'localhost');        // location of MySQL server
define('TBLAPREFIX', 'storms');     // In order to maintain multiple installs
/*end global variables*/

/**
 * Reusable database connection code for deloy in any application. Originally made for the 'brainstorms' and 'Storms' projects in 2002
 *
 * @author tekton
 */
class db {
   /**
     *
     * Basic database connection function; will default to global variables if nothing is assigned in the funtion call
     * 
     * @param string $db Database (or Schema) to use once connected
     * @param string $host IP, URI, or Hostname of the server to connect to
     * @param string $user The user that's connecting to the server
     * @param string $password The password to be used for the select user
     * @return type 
     */
    function ConnectDB($db="", $host="", $user="", $password="") {
	
	if($db == "")       {$db = DB;}
	if($host == "")     {$host = HOST;}
	if($user == "")     {$user = USER;}
	if($password == "") {$password = PASSWORD;}
	
	$g_link = mysql_connect($host, $user, $password) or die('StormsSDK: Could not connect to server.'.mysql_error());
	mysql_select_db($db, $g_link) or die('StormsSDK: Could not select database :: '.mysql_error());
	return $g_link;
    }

    /**
     * 
     * Most of the time this doesn't need to be used as the MySQL implementation does a great job of cleaning up connections
     * 
     * @param Object $db An opened database connection
     * @return Object A closed database connection 
     */
    function CleanUpDB($db) {
            if( $db != false ) { mysql_close($db); }
            $db = false;
            return $db;
    }
}

?>
