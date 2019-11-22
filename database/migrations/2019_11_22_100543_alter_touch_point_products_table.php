<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTouchPointProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_touch_point_products', function($table)
        {
            $table->unsignedInteger('outside_product_id')->change();
            $table->text('outside_product_link')->nullable()->change();
            $table->unsignedInteger('outside_product_variant')->change();
            $table->text('outside_product_image')->nullable()->after('outside_platform');
        });

        Schema::table('campaign_touch_point_products', function($table)
        {
            $table->renameColumn('outside_product_variant', 'outside_product_variant_id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_touch_point_products', function($table)
        {
            $table->unsignedDecimal('outside_product_id')->change();
            $table->text('outside_product_link')->nullable(false)->change();
            $table->text('outside_product_variant_id')->nullable(false)->change();
            $table->dropColumn(['outside_product_image']);
        });

        Schema::table('campaign_touch_point_products', function($table)
        {
            $table->renameColumn('outside_product_variant_id', 'outside_product_variant');
        });
    }

}
