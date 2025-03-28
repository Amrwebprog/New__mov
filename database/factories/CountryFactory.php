<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->randomElement([
                'Egypt',
                'Algeria',
                'South Africa',
                'Nigeria',
                'Morocco',
                'Kenya',
                'Tunisia',
                'Sudan',
                'Ethiopia',
                'Ghana',
                'Germany',
                'France',
                'United Kingdom',
                'Italy',
                'Spain',
                'Russia',
                'Sweden',
                'Norway',
                'Netherlands',
                'Greece',
                'Saudi Arabia',
                'United Arab Emirates',
                'China',
                'Japan',
                'India',
                'South Korea',
                'Indonesia',
                'Turkey',
                'Pakistan',
                'Philippines',
                'Australia',
                'New Zealand',
                'Fiji',
                'Papua New Guinea',
                'Samoa',
                'Tonga',
                'Micronesia',
                'Solomon Islands',
                'Vanuatu',
                'Kiribati',
                'Brazil',
                'Argentina',
                'Chile',
                'Colombia',
                'Venezuela',
                'Peru',
                'Ecuador',
                'Uruguay',
                'Bolivia',
                'Paraguay',
                'United States',
                'Canada',
                'Mexico',
                'Cuba',
                'Panama',
                'Haiti',
                'Jamaica',
                'Costa Rica',
                'Belize',
                'El Salvador',

            ])
        ];
    }
}




