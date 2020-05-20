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
    $array=array("empty","empty");
    $f3->set('options',array("This midterm is easy", "I like midterms",
        "Today is Monday"));

    if($_SERVER['REQUEST_METHOD'] == 'POST') {




        if(empty($_POST['name'])){
            $f3->set('errors["name"]',"Please provide your name!");
        }
        if(empty($_POST['options'])){
            $f3->set('errors["options"]',"Please select a checkbox!");
        }

        if(empty($f3->get('errors'))) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['options'] = $_POST['options'];

            $f3->reroute('summary');
        }
    }


    $f3->set('name',$_POST['name']);
    if(!empty($_POST['options'])) {
        $array=$_POST['options'];

    }
    $f3->set('selectedOptions', $array);
    $view = new Template();
    echo $view->render('views/survey.html');


});

$f3->route('GET|POST /summary', function ($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});



//Run F3
$f3->run();