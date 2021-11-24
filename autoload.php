<?php

session_start();

spl_autoload_register(function($className) {
    $filepath = __DIR__ . "/clases/" . $className . ".php";

    if(file_exists($filepath)) {
        require $filepath;
    }
});
