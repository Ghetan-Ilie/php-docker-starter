<?php
// Setările bazei de date (numele serviciului din docker-compose = host)
const DB_HOST = 'mysql-latest';
const DB_NAME = 'my_database';
const DB_USER = 'root';
const DB_PASS = 'your_secure_password';

function db_status(): array
{
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_errno) {
        return ['ok' => false, 'msg' => $conn->connect_error];
    }
    $version = $conn->server_info;
    $conn->close();
    return ['ok' => true, 'msg' => 'MySQL ' . $version];
}
