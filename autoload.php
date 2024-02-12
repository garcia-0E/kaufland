<?php
// autoload.php

// Define autoloader function
spl_autoload_register(function ($className) {
    // Replace namespace separators with directory separators
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    // Include the class file
    require_once __DIR__ . "\\src". DIRECTORY_SEPARATOR . $className . '.php';
});

// Include PHPUnit autoloader if needed
