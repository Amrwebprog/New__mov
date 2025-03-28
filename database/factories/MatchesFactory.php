<?php

namespace Database\Factories;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matches>
 */
class MatchesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "match_url" => fake()->url(),
            'image' => fake()->randomElement([
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-fc-barcelona.jpg?width=1920&name=football-logo-fc-barcelona.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-real-madrid.jpg?width=1920&name=football-logo-real-madrid.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-manchester-united.jpg?width=1920&name=football-logo-manchester-united.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-liverpool.jpg?width=1920&name=football-logo-liverpool.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ac-milan.jpg?width=1920&name=football-logo-ac-milan.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-bayern-munchen.jpg?width=1920&name=football-logo-bayern-munchen.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-juventus-fc.jpg?width=1920&name=football-logo-juventus-fc.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-paris-saint-germain.jpg?width=1920&name=football-logo-paris-saint-germain.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ajax.jpg?width=1920&name=football-logo-ajax.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-benfica.jpg?width=1920&name=football-logo-benfica.jpg',
            ]),
            'story' => fake()->text(),
            'quality' => fake()->name(),
            'year_of_production' => fake()->year(Carbon::now()),
            'rate' => fake()->randomFloat(8, 0, 10),
            'top_10' => fake()->boolean(),
            'stadium' => fake()->name(),
            'team_1' => fake()->name(),
            'team_2' => fake()->name(),
            'team_1_logo' => fake()->randomElement([
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-fc-barcelona.jpg?width=1920&name=football-logo-fc-barcelona.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-real-madrid.jpg?width=1920&name=football-logo-real-madrid.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-manchester-united.jpg?width=1920&name=football-logo-manchester-united.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-liverpool.jpg?width=1920&name=football-logo-liverpool.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ac-milan.jpg?width=1920&name=football-logo-ac-milan.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-bayern-munchen.jpg?width=1920&name=football-logo-bayern-munchen.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-juventus-fc.jpg?width=1920&name=football-logo-juventus-fc.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-paris-saint-germain.jpg?width=1920&name=football-logo-paris-saint-germain.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ajax.jpg?width=1920&name=football-logo-ajax.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-benfica.jpg?width=1920&name=football-logo-benfica.jpg',
            ]),
            'team_2_logo' => fake()->randomElement([
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-fc-barcelona.jpg?width=1920&name=football-logo-fc-barcelona.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-real-madrid.jpg?width=1920&name=football-logo-real-madrid.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-manchester-united.jpg?width=1920&name=football-logo-manchester-united.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-liverpool.jpg?width=1920&name=football-logo-liverpool.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ac-milan.jpg?width=1920&name=football-logo-ac-milan.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-bayern-munchen.jpg?width=1920&name=football-logo-bayern-munchen.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-juventus-fc.jpg?width=1920&name=football-logo-juventus-fc.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-paris-saint-germain.jpg?width=1920&name=football-logo-paris-saint-germain.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-ajax.jpg?width=1920&name=football-logo-ajax.jpg',
                'https://22400058.fs1.hubspotusercontent-na1.net/hub/22400058/hubfs/football-logo-benfica.jpg?width=1920&name=football-logo-benfica.jpg',
            ]),
            'champion' => fake()->name(),
            'result' => fake()->randomElement([
                '3-6',
                '0-1',
                '0-2',
                '0-5',
                '0-7',
                '1-0',
                '2-0',
                '8-0',
                '2-1',
                '2-4',
                '8-4',
                '1-3',
            ]),
            'country_id' => Country::all()->random()->id,
        ];
    }
}
