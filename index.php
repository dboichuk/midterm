<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once("vendor/autoload.php");


//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function () {
    echo "<h1>Midterm Survey</h1><br>";
    echo '<p><a href="survey">Take my midterm survey</a></p>';

});

$f3->route('GET|POST /survey', function ($f3) {

    $f3->set('options',array("This midterm is easy", "I like midterms",
        "Today is Monday"));

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['name']=$_POST['name'];
        $_SESSION['options']=$_POST['options'];

        $f3->reroute('summary');
    }



    $view = new Template();
    echo $view->render('views/survey.html');


});

$f3->route('GET|POST /summary', function ($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});



//Run F3
$f3->run();