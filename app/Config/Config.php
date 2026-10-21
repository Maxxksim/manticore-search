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

        foreach (glob(__DIR__ . '/Config/*.php') as $config) {
            $configs[basename($config, '.php')] = require $config;
        }

        $this->config = new Repository($configs);
    }

    public function config(string $key, mixed $default = null): Repository
    {
        return $this->config->get($key, $default);
    }

}