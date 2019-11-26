<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointPlacementsTable.
 */
class CreateCampaignTouchPointPlacementActionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_placement_actions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_touch_point_id');
            $table->unsignedInteger('placement_type_id');
            $table->string('link', 500)->nullable();
            $table->string('link_type')->nullable();

            $table->foreign('campaign_touch_point_id', 'ctppa_campaign_touch_point_id_foreign')->references('id')->on('campaign_touch_points');
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('campaign_touch_point_placements');
        Schema::drop('campaign_touch_point_placement_actions');

        Schema::enableForeignKeyConstraints();
	}
}