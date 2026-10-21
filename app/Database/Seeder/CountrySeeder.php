<?php

declare(strict_types=1);

namespace App\Database\Seeder;

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = json_decode(
            file_get_contents(__DIR__ . '/../../../countries.json'),
            true
        );

        $preparedCountries = [];

        foreach ($countries as $country) {
            $preparedCountries[] = [
                'name' => $country['name']['common'],
            ];
        }

        DB::table('countries')->insert($preparedCountries);
    }
}