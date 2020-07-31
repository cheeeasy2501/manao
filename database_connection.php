<?php
require_once 'classes/Database.php';
use Classes\Database;
$xml_path = $_SERVER['DOCUMENT_ROOT'].'/database.xml';
$databaseInstance = new Database($xml_path);