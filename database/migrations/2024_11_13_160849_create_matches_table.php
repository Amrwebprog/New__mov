<?php

use App\Models\Country;
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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->float('rate');
            $table->boolean('top_10');//new
            $table->string('quality');
            $table->string('story');
            $table->string('year_of_production');
            $table->string('match_url');
            $table->string('stadium');
            $table->string('team_1');
            $table->string('team_1_logo');
            $table->string('team_2');
            $table->string('team_2_logo');
            $table->string('champion');
            $table->string('result');
            $table->foreignIdFor(Country::class)->constrained();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
