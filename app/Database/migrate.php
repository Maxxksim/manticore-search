<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Config;
use App\Database\Db;
use App\Database\Seeder\CountrySeeder;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$config = new Config;
new Db($config);

$migrations = glob(__DIR__ . '/migrations/*.php');

foreach ($migrations as $migrationPath) {
    $migration = require $migrationPath;

    try {
        $migration->up();
        new CountrySeeder()->run();
        echo 'MIGRATION MESSAGE: Migration ' . basename($migrationPath, '.php') . ' has been migrated.';
    } catch (PDOException $e) {

        if ($e->getCode() === '42S01') {
            echo 'MIGRATION MESSAGE: Migration' . basename($migrationPath, '.php') . ' has been already executed.';
        } else {
            echo 'MIGRATION MESSAGE: Error: ' . $e->getMessage();
        }
    }
}