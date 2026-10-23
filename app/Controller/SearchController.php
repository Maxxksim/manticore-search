<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manticore\Manticore;
use App\Model\Country;
use Exception;
use Manticoresearch\Utils;

class SearchController
{

    use Utils;

    public function __construct(private Manticore $manticore)
    {

    }

    public function suggestCountries(): void
    {
        $this->manticore->search->setTable('countries');
        $keywords = trim($_GET['keywords']);
        $suggestCountries = [];

        if (!$keywords) {
            echo json_encode($suggestCountries);
            exit();
        }

        $safeKeywords = self::escape($keywords);

        try {
            $result = $this->manticore->search->search("$safeKeywords*")->get();
        } catch (Exception $e) {
            echo json_encode($suggestCountries);
            exit();
        }

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