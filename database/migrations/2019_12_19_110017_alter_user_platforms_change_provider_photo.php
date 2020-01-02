<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPlatformsChangeProviderPhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_platforms', function (Blueprint $table) {
            $table->dropColumn('provider_photo');
        });

        Schema::table('user_platforms', function (Blueprint $table) {
            $table->text('provider_photo')->after('provider_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_platforms', function (Blueprint $table) {
            $table->dropColumn('provider_photo');
        });
    }
}
