<?php
require 'vendor/autoload.php';
Flight::route('/', function(){
    echo 'Hello Formula 1';
});

Flight::start();

?>