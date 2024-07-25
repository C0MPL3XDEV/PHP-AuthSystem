<?php
$request = $_SERVER["REQUEST_URI"];

switch ($request) {
    case "/":
        require __DIR__ . '/login.php';
        break;
    case "":
        require __DIR__ . '/login.php';
        break;
    case "/home":
        require __DIR__ . '/home.php';
        break;
    case "/register":
        require __DIR__ . '/register.php';
        break;
    case "/login":
        require __DIR__ . '/login.php';
        break;
    case "/geoip":
        require __DIR__ . '/geoip.php';
        break;
    case "/5BIN/authSystem/":
        require __DIR__.'/login.php';
        break;
    default:
        require __DIR__ . '/404.html';

}