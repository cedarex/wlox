<?php 
class object {
}
$CFG = new object ( );

$CFG->dbhost = "localhost";
$CFG->dbname = "1btcxe";
$CFG->dbuser = "1btcxedb";
$CFG->dbpass = "KfRnwWsS8uTuXDHp";
$CFG->authy_api_key = 'b218b2b72cb5ca05e90126b3643e44b8';

/* debugging */
$DB_DEBUG = true;
$DB_DIE_ON_FAIL = true;

require_once ("dblib.php");
require_once ("stdlib.php");

/* Connect to the database */
db_connect($CFG->dbhost,$CFG->dbname,$CFG->dbuser,$CFG->dbpass);