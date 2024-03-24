<?php

$servername = "localhost";
$username1 = 'mysql';
$password1 = '';

$connection = new mysqli($servername, $username1, $password1, "test");

if (!$connection->ping()) {
    die(mysqli_connect_error());
}

$query = "SHOW TABLES FROM test";
$result = mysqli_query($connection, $query);

$row = $result->fetch_row(); // Array with the values of all rows of the result of the query

if (count($row) == 0) {
    die("no tables in db");
}


