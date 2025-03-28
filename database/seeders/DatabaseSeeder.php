<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Episode;
use App\Models\EpisodeWatching;
use App\Models\Film;
use App\Models\FilmWatching;
use App\Models\Genre;
use App\Models\Matches;
use App\Models\MatchWatching;
use App\Models\Message;
use App\Models\Season;
use App\Models\Series;
use App\Models\Subscription;
use App\Models\SubscriptionDetails;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(40)->create();
        User::factory(500)->create();
        Genre::factory(20)->create();
        Series::factory(40)->create();
        Season::factory(40)->create();
        Message::factory(40)->create();
        Episode::factory(40)->create();
        EpisodeWatching::factory(40)->create();
        Film::factory(1000)->create();
        FilmWatching::factory(100)->create();
        Matches::factory(100)->create();
        MatchWatching::factory(100)->create();
        Subscription::factory(3)->create();
        SubscriptionDetails::factory(100)->create();
    }
}