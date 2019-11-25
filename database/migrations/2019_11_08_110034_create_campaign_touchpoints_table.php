<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointsTable
 */
class CreateCampaignTouchPointsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_points', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('dispatch_product')->default(0);
            $table->unsignedInteger('barter_product')->default(0);
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('placement_id');
            $table->boolean('barter_as_dispatch');
            $table->double('amount', 10, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('dispatch_product')->references('id')->on('campaign_touch_point_products');
            $table->foreign('barter_product')->references('id')->on('campaign_touch_point_products');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('placement_id')->references('id')->on('placements');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign_touch_points');
	}
}
