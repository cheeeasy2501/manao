<?php
require_once '../database_connection.php';
header('Content-Type:application/json');

if ($databaseInstance->isExists()) {
    $login = $_POST['login'];
    $password = md5('соль'.$_POST['password']);
    $database = $databaseInstance->loadDatabase();
    $user = $databaseInstance->checkUserByPassword($database, $login, $password);

    if ($user) {
        $databaseInstance->setLogin($database, $user);
        http_response_code(200);
        echo json_encode(['status' => true]);
        return;
    }
    http_response_code(401);
    echo json_encode(['status' => false, 'errors' => ['authorization' => 'Incorect login or password!']]);
}
