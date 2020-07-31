<?php
require_once '../database_connection.php';
if($databaseInstance->getCookie()) {
    $databaseInstance->destroyCookie();
}
$a = $databaseInstance->destroySession();
http_response_code(200);
echo json_encode(true);



