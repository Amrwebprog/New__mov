<?php

use App\Models\Country;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('story');
            $table->string('quality');
            $table->string('year_of_production');
            $table->float('rate');
            $table->boolean('top_10');//new
            $table->string("description");
            $table->string("name");
            $table->string("film_url");
            $table->foreignIdFor(Genre::class)->constrained();
            $table->foreignIdFor(Country::class)->constrained();//new
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
