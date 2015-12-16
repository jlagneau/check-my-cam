<?php

session_start();

define('ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('CONFIG', ROOT.'config'.DIRECTORY_SEPARATOR);
define('SRC', ROOT.'src'.DIRECTORY_SEPARATOR);
define('VIEWS', SRC.'views'.DIRECTORY_SEPARATOR);
define('UPLOADS', ROOT.'uploads'.DIRECTORY_SEPARATOR);

require CONFIG.'kernel.php';
