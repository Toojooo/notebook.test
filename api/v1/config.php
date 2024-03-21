<?php

Error_Reporting(-1);
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("track_errors","1");
//*/

ini_set("max_execution_time", 0); 
//ini_set("memory_limit", "512M");

ini_set("default_charset", "UTF-8");

header('Content-Type: application/json; charset=utf-8');

//logs
define('DIR_LOGS', dirname(__FILE__) . '/logs/');
define('MY_LOCAL_HOST', 'notebook.test');

//base
$pdo = new PDO("mysql:host=localhost;dbname=notebook", "root", "");

?>