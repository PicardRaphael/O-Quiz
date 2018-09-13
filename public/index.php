<?php

use oQuiz\App;

require dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

/* J'active le système de session sur tout le site */
session_start();

/* J'instancie le FrontController */
$app = new App();
$app->run();
