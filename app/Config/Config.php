<?php

declare(strict_types=1);

namespace App\Config;

use Illuminate\Config\Repository;

class Config
{
    private Repository $config;

    public function __construct()
    {
        $configs = [];
        foreach (glob(__DIR__ . '/configs/*.php') as $config) {
            $configs[basename($config, '.php')] = require $config;
        }

        $this->config = new Repository($configs);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config->get($key, $default);
    }

}