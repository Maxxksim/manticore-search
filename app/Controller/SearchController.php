<?php

declare(strict_types=1);

namespace App\Controller;

use Manticoresearch\Client;
use Manticoresearch\Search;

class SearchController
{
    private Client $client;
    private Search $search;

    public function __construct()
    {
        $config = ['host' => '127.0.0.1', 'port' => 9308];
        $this->client = new Client($config);
        $this->search = new Search($this->client);
        $this->search->setTable('countries');

    }

    public function suggestCountries(): void
    {
        $keywords = $_GET['keywords'];
        $suggestCountries = [];
        $result = $this->search->search("$keywords*")->get();

        header('Content-Type: application/json; charset=utf-8');

        if ($result->getTotal() !== 0) {

            foreach ($result as $hit) {
                $suggestCountries[] = $hit->getData()['country'];
            }

            echo json_encode($suggestCountries);
            exit();
        }

        echo json_encode($suggestCountries);
        exit();
    }
}