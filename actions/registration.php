<?php
require_once '../database_connection.php';
header('Content-Type:application/json');

if ($databaseInstance->isExists()) {
    $login = $_POST['login'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5('соль'.$_POST['password']);

    $database = $databaseInstance->loadDatabase();
    $errors = $databaseInstance->beforeRegistration($database, $login, $email);

    if (!$errors) {
        $errors = $databaseInstance->saveInXml($database, $email, $login, $password, $name);
        if (!$errors) {
            http_response_code(200);
            echo json_encode(['status' => true]);
            return;
        }
    }
    http_response_code(401);
    echo json_encode(['status' => false, 'errors' => $errors]);
}
