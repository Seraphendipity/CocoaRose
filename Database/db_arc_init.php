<?php

$server = 'localhost';
$user = 'Seraphendipity';
$password = 'CocoaBean18';
$db = 'CocoaRose';
$port = 3306;

$conn = new mysqli($server, $user, $password, $db, $port);
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connection_error);
} else {
    echo 'Connection opened.';
    $conn->close;
    echo 'Connection closed.';
}

?>