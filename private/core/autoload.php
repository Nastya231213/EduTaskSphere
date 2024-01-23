<?php

require "app.php";
require "database.php";
require "config.php";
require "controller.php";
require "helper_functions.php";

spl_autoload_register(function($className){
    require "../private/models/".ucfirst($className).".php";
});