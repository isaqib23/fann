<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CampaingObjectives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_objectives', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->unsignedInteger('parent_category_id');
            $table->boolean('is_active')->default('1');
            $table->timestamps();

            $table->foreign('parent_category_id')->references('id')->on('campaign_objective_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_objectives', function (Blueprint $table) {
            $table->dropForeign('campaign_objectives_parent_category_id_foreign');
        });
        Schema::drop('campaign_objectives');
    }
}
