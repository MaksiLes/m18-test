<?php

$conn = null;

try {
    $host = '127.0.0.1';
    $port = 3306;
    $dbname = 'links';
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    $username = 'root';
    $passwd = 'qwerty';
    $conn = new PDO($dsn, $username, $passwd);
    return $conn;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br />";
}


