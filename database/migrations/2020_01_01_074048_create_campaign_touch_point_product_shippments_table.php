<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampaignTouchPointProductShippmentsTable.
 */
class CreateCampaignTouchPointProductShippmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_touch_point_product_shippments', function(Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('outside_order_id');
            $table->date('dispatch_date');
            $table->string('discount_code')->nullable();
            $table->json('fulfillments')->nullable();
            $table->text('order_status_url');
            $table->BigInteger('outside_customer_id');
            $table->json('shipping_address')->nullable();


            $table->json('order_json');
            $table->unsignedInteger('send_by');
            $table->unsignedInteger('touch_point_id');
            $table->unsignedInteger('touch_point_product_id');

            $table->foreign('send_by')->references('id')->on('users');
            $table->foreign('touch_point_id','tp_id')->references('id')->on('campaign_touch_points');
            $table->foreign('touch_point_product_id','tpp_id')->references('id')->on('campaign_touch_point_products');

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
		Schema::drop('campaign_touch_point_product_shippments');
        Schema::enableForeignKeyConstraints();
	}
}
