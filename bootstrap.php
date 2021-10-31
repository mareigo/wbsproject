<?php

// Adjust paths as needed
// const PATH = 'C:/xampp/htdocs/kurs/php/skeleton/';
// const BASE_URL = 'http://localhost/kurs/php/skeleton/';


require_once 'lib/authentication.php';
require_once 'lib/database.php';
require_once 'lib/request.php';
require_once 'lib/response.php';
require_once 'lib/session.php';
require_once 'lib/view.php';

// Don't forget to adjust the DB connection details
$database = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'wbsprojekt'
]);

session_start();

$errors = [];

