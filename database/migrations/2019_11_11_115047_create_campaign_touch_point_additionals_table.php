<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointAdditionalsTable.
 */
class CreateCampaignTouchPointAdditionalsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_additionals', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_touch_point_id');
            $table->json('tags');
            $table->json('mentions');

            $table->foreign('campaign_touch_point_id')->references('id')->on('campaign_touch_points');

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
		Schema::drop('campaign_touch_point_additionals');
	}
}
