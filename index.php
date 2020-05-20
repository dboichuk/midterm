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
    echo '<p><a href="survey">Take my midterm survey</a></p>';

});

$f3->route('GET /survey', function ($f3) {

    $f3->set('options',array("This midterm is easy", "I like midterms",
        "Today is Monday"));



    $view = new Template();
    echo $view->render('views/survey.html');


});




//Run F3
$f3->run();