<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignInvitesTable.
 */
class CreateCampaignInvitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_invites', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('touch_point_id');
            $table->unsignedInteger('sender_id');
            $table->enum('sent_from', ['businessOwner', 'influencer']);
            $table->integer('original_price')->nullable();
            $table->integer('influencer_price')->nullable();
            $table->text('status')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('touch_point_id')->references('id')->on('campaign_touch_points');
            $table->foreign('sender_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign_invites');
	}
}


