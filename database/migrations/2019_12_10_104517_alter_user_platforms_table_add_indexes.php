<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPlatformsTableAddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_platforms', function (Blueprint $table) {
            $table->index('provider');
            $table->index('provider_id');
            $table->index('provider_name');
            $table->index('provider_photo');
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
            $table->dropIndex(['provider']);
            $table->dropIndex(['provider_id']);
            $table->dropIndex(['provider_name']);
            $table->dropIndex(['provider_photo']);
        });
    }
}
