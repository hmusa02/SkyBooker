<?php
require 'vendor/autoload.php';
Flight::route('/', function(){
    echo 'Hello SkyBooker';
});

Flight::start();

?>
