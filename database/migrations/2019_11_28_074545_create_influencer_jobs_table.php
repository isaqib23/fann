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
		Schema::create('campaign_assigned_job_details', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assign_to_id');
            $table->unsignedInteger('assign_by_id');
            $table->unsignedInteger('campaign_touch_point_id')->nullable();
            $table->unsignedInteger('campaign_invite_id')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('eng_rate')->nullable();
            $table->integer('work_rate')->nullable();
            $table->longText('tags')->nullable();
            $table->string('post_count')->nullable();
            $table->string('comment_count')->nullable();
            $table->string('like_count')->nullable();
            $table->string('follower_count')->nullable();
            $table->string('following_count')->nullable();
            $table->text('status')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('assign_to_id')->references('id')->on('users');
            $table->foreign('assign_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('campaign_assigned_job_details');
        Schema::enableForeignKeyConstraints();
	}
}
