<?php
/*
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
*/
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
   <title>Grnd0s Dev Center</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />

  </head>
  <body>
    <? include('views/nav.html'); ?>
    <h1>Labs</h1>
    <ul style="list-style-type: none;">
      <li><a href="lab1/index.html"><h2>Portfolio</h2></a></li>
      <li><a href="lab2/index.php"><h2>Lab 2</h2></a></li>
      <li><a href="labs/lab3/index.php"><h2>Lab 3</h2></a></li>
      <li><a href="labs/lab4/index.php"><h2>Lab 4</h2></a></li>
      <li><a href="labs/lab5/index.php"><h2>Lab 5</h2></a></li>
      <li><a href="labs/lab6/index.php"><h2>Lab 6</h2></a></li>
      <li><a href="labs/lab7/index.php"><h2>Lab 7</h2></a></li>
      <li><a href="labs/lab8/index.php"><h2>Lab 8</h2></a></li>
    </ul>
    
    <h1>Homework</h1>
    <ul style="list-style-type: none;">
      <li><a href="hw1/index.html"><h1>Homework 1</h2></a></li>
      <li><a href="hw/hw2/index.php"><h2>Homework 2</h2></a></li>
      <li><a href="hw/hw3/index.php"><h2>Homework 3</h2></a></li>
      <li><a href="hw/hw4/index.php"><h2>Homework 4</h2></a></li>
    </ul>
    
    <a href="teamproject/index.php"><button class="btn btn-success btn-lg">TeamProject</button></a><br />
    <a href="finalproject/index.php"><button class="btn btn-primary btn-lg">Final Project</button></a>
  </body>
</html>