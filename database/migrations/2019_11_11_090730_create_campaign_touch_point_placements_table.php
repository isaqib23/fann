<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointPlacementsTable.
 */
class CreateCampaignTouchPointPlacementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_placements', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_touch_point_id');
            $table->unsignedInteger('placement_type_id');

            $table->foreign('campaign_touch_point_id')->references('id')->on('campaign_touch_points');
            $table->foreign('placement_type_id')->references('id')->on('placement_types');

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
		Schema::drop('campaign_touch_point_placements');
	}
}
