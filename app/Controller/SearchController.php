<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manticore\Manticore;

class SearchController
{
    public function __construct(private Manticore $manticore)
    {

    }

    public function suggestCountries(): void
    {
        $this->manticore->search->setTable('countries');
        $keywords = $_GET['keywords'];
        $suggestCountries = [];

        if (!trim($keywords)) {
            echo json_encode($suggestCountries);
            exit();
        }
        $result = $this->manticore->search->search("$keywords*")->get();

        foreach ($result as $hit) {
            $suggestCountries[] = $hit->getData()['country'];
        }

        echo json_encode($suggestCountries);
        exit();
    }
}