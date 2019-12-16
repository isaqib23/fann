<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignsTable.
 */
class CreateCampaignsTable extends Migration
{

    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->unsignedInteger('primary_placement_id')->nullable();
            $table->unsignedInteger('touch_points')->default(0);
            $table->double('total_amount', 10, 2)->default(0);
            $table->unsignedInteger('objective_id')->default(0);
            $table->unsignedInteger('impressions')->default(0);
            $table->unsignedInteger('actions')->default(0);
            $table->unsignedInteger('eng_rate')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('primary_placement_id')->references('id')->on('placements');
            $table->foreign('objective_id')->references('id')->on('campaign_objectives');
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
        Schema::dropIfExists('campaigns');
        Schema::enableForeignKeyConstraints();
	}
}
