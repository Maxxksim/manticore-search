<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manticore\Manticore;
use App\Model\Country;

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
            $suggestCountries[] = ['name' => $hit->getData()['name'], 'id' => $hit->getId()];
        }

        echo json_encode($suggestCountries);
        exit();
    }

    public function searchCountryInfo(): void
    {
        $id = $_GET['countryId'];

        if (!($country = Country::find((int)$id))) {
            echo json_encode(['error' => 'Country not found.']);
            exit();
        }
        echo json_encode(['data' => $country->getAttributes()]);
        exit();
    }
}