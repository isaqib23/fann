<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointProductsTable.
 */
class CreateCampaignTouchPointProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_products', function(Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedDecimal('outside_product_id');
            $table->text('outside_product_link');
            $table->text('outside_product_variant');
            $table->string('outside_platform');

            $table->softDeletes();
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
		Schema::drop('campaign_touch_point_products');
	}
}
