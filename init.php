<?php

session_start();

spl_autoload_register(function($class){
    $path = 'classes/'.$class.'.php';
    loadClass($path);
});

function loadClass($path){

    if(file_exists($path))
    {
        require_once $path;
    }
    else{
        loadClass('../'.$path);
    }

}





