<?php

declare(strict_types=1);

namespace App\Database;

use App\Config\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connection;

class Db
{
    private Capsule $capsule;

    public function __construct(private Config $config)
    {
        $this->capsule = $this->getInstance();
    }

    public function connection(): Connection
    {
        return $this->capsule->getConnection();
    }

    public function getInstance(): Capsule
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => $this->config->get('database.mysql.driver'),
            'host' => $this->config->get('database.mysql.host'),
            'database' => $this->config->get('database.mysql.database'),
            'username' => $this->config->get('database.mysql.username'),
            'password' => $this->config->get('database.mysql.password'),
            'charset' => $this->config->get('database.mysql.charset'),
            'collation' => $this->config->get('database.mysql.collation'),
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }
}