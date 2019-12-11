<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CampaingObjectiveCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_objective_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('image', 255);
            $table->boolean('is_active')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('campaign_objective_categories');
        Schema::enableForeignKeyConstraints();
    }
}
