<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInfluencerEntireStatisticsTable
 */
class CreateInfluencerEntireStatisticsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('influencer_entire_statistics', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('placement_id');
            $table->unsignedInteger('user_id');
            $table->integer('rating')->nullable();
            $table->integer('eng_rate')->nullable();
            $table->integer('work_rate')->nullable();
            $table->longText('tags')->nullable();
            $table->string('post_count')->nullable();
            $table->string('comment_count')->nullable();
            $table->string('like_count')->nullable();
            $table->string('follower_count')->nullable();
            $table->string('following_count')->nullable();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('placement_id')->references('id')->on('placements');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('influencer_entire_statistics');
        Schema::enableForeignKeyConstraints();
	}
}
