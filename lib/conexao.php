<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "escola_ead";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "Connect failed: " . $mysqli->connect_error;
    exit();
}
