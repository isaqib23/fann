<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInfluencerJobsTable.
 */
class CreateInfluencerJobsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('influencer_jobs', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assign_to_id');
            $table->unsignedInteger('assign_by_id');
            $table->unsignedInteger('campaign_touch_point_id')->nullable();
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('placement_id');
            $table->unsignedInteger('campaign_invite_id');
            $table->text('status')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('assign_to_id')->references('id')->on('users');
            $table->foreign('assign_by_id')->references('id')->on('users');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('placement_id')->references('id')->on('placements');
            $table->foreign('campaign_touch_point_id')->references('id')->on('campaign_touch_points');
            $table->foreign('campaign_invite_id')->references('id')->on('campaign_invites');
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
        Schema::dropIfExists('influencer_jobs');
        Schema::enableForeignKeyConstraints();
	}
}
