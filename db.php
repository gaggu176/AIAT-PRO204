<?php

declare(strict_types=1);

$databaseHost = 'localhost';
$databasePort = 3306;
$databaseName = 'user_directory';
$databaseUsername = 'root';
$databasePassword = 'Grandmaa.,513@';

if (!preg_match('/^[A-Za-z0-9_]+$/', $databaseName)) {
    throw new RuntimeException('Invalid database name.');
}

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $serverConnection = new PDO(
        "mysql:host={$databaseHost};port={$databasePort};charset=utf8mb4",
        $databaseUsername,
        $databasePassword,
        $pdoOptions
    );
    $serverConnection->exec("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    $database = new PDO(
        "mysql:host={$databaseHost};port={$databasePort};dbname={$databaseName};charset=utf8mb4",
        $databaseUsername,
        $databasePassword,
        $pdoOptions
    );
} catch (PDOException $exception) {
    throw new RuntimeException(
        'MariaDB is unavailable or the credentials are invalid. Check db.php and confirm MariaDB is running.',
        (int) $exception->getCode(),
        $exception
    );
}

$database->exec(
    'CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        role VARCHAR(20) NOT NULL DEFAULT \'Member\',
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )'
);
