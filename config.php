<?php 
use Database\ConDB;

# Set Default Time Zone Static In Jordan
date_default_timezone_set("Asia/Amman");

# Require File 
require_once('init.php');
require_once($class.'class.ConDB.php');

# Variable Connect Database
define('HOST','localhost');
define('USER','root');
define('PWD','');
define('NAMEDB','chat');

# Create Object From CLass ConDB 
$con = new ConDB(HOST,USER,PWD,NAMEDB);