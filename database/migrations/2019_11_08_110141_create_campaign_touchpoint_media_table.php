<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointImagesTable
 */
class CreateCampaignTouchPointMediaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_media', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_touch_point_id');
            $table->text('path', 255);
            $table->enum('format', ['image', 'video', 'pdf', 'doc']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('campaign_touch_point_id')->references('id')->on('campaign_touch_points');


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign_touch_point_media');
	}
}
