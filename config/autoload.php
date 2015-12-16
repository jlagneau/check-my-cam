<?php

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'Camagru\\';

    // base directory for the namespace prefix
    $base_dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;

    // does the class use the namespace prefix?
    $len = strlen($prefix);

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
