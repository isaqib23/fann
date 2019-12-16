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
            $table->unsignedInteger('placement_id');
            $table->unsignedInteger('sender_id');
            $table->enum('sent_from', ['businessOwner', 'influencer']);
            $table->integer('original_price')->nullable();
            $table->integer('quoted_price')->nullable();
            $table->enum('status', ['queued', 'sent', 'price_quoted', 'accept', 'reject']);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('placement_id')->references('id')->on('placements');
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
        Schema::disableForeignKeyConstraints();
		Schema::drop('campaign_invites');
        Schema::enableForeignKeyConstraints();
	}
}


