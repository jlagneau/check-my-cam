<?php

require 'database.php';

try {
    $pdo = new PDO($DB_DSN);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}
