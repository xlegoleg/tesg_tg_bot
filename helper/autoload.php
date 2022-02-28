<?php
const LIB_DIR = './src/';

spl_autoload_register(function($class) {
    $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    $file = LIB_DIR . str_replace('\\', '/', $fn);
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});