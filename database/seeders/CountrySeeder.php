<?php

namespace Database\Seeders;

use App\Models\Country;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();
        $request = new Request('GET', 'https://restcountries.com/v3.1/all?fields=name,languages,currencies,cca2');
        $res = $client->sendAsync($request)->wait();

        $countries = collect(json_decode($res->getBody()->getContents()))->map(function ($item) {
            return [
                'name_uz' => $item->name->common,
                'name_ru' => $item->name->common,
                'name_en' => $item->name->common,
                'code' => $item->cca2,
                'currencies' => key($item->currencies),
                'created_at' => now(),
                'updated_at' => now()
            ];
        });

        Country::truncate();
        Country::insert($countries->toArray());
    }
}
