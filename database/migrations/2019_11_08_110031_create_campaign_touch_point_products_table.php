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
            $table->unsignedInteger('outside_product_id');
            $table->text('outside_product_link')->nullable();
            $table->integer('outside_product_variant_id');
            $table->e->enum('outside_platform', ['Shopify', 'Magento', 'WooCommerce', 'BigCommerce', 'OpenCart', 'PrestaShop', 'OsCommerce', 'ZenCart', 'Joomla', 'Drupal']);
            $table->text('outside_product_image')->nullable();

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
