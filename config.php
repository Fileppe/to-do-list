<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Aceraspire');
define('DB_NAME', 'todo');

$connessione = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

require_once 'funzioni.php';