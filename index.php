<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the autoload file
require_once("vendor/autoload.php");


//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function () {
    echo "<h1>Midterm Survey</h1><br>";
    echo "<a href='survey'>Take my midterm survey</a>";
});




//Run F3
$f3->run();