<?php

namespace App\Manticore;

use App\Config\Config;
use Manticoresearch\Client;
use Manticoresearch\Search;

class Manticore
{
    private Client $client;
    private(set) Search $search;

    public function __construct(private Config $config)
    {
        $config = [
            'host' => $this->config->get('manticore.host'),
            'port' => $this->config->get('manticore.port'),
        ];
        $this->client = new Client($config);
        $this->search = new Search($this->client);
    }
}