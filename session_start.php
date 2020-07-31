<?php
session_start();
require_once 'database_connection.php';
$cookie = $databaseInstance->getCookie();
if ($cookie) {
    $database = $databaseInstance->loadDatabase();
    $check = $databaseInstance->checkUserByCode($database, $cookie['login'], $cookie['code']);
    if (!$check) {
        $databaseInstance->destroyCookie();
        $databaseInstance->destroySession();
        return;
    }
    if (!isset($_SESSION['login'])) {
        $_SESSION['login'] = $cookie['login'];
    }
}
