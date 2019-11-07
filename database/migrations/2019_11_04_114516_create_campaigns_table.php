<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignsTable.
 */
class CreateCampaignsTable extends Migration
{

    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 255);
            $table->text('description');
            $table->text('status');
            $table->unsignedInteger('touch_points');
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('objective_id');
            $table->string('impressions');
            $table->string('actions');
            $table->string('eng_rate');

            $table->softDeletes();
            $table->timestamps();


            $table->foreign('objective_id')->references('id')->on('campaign_objectives');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaigns');
	}
}
