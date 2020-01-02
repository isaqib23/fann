<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPlatformsMetaTableAddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_platform_metas', function (Blueprint $table) {
            $table->index('rating');
            $table->index('eng_rate');
            $table->index('work_rate');
            $table->index('post_count');
            $table->index('comment_count');
            $table->index('like_count');
            $table->index('follower_count');
            $table->index('following_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_platform_metas', function (Blueprint $table) {
            $table->dropIndex(['rating']);
            $table->dropIndex(['eng_rate']);
            $table->dropIndex(['work_rate']);
            $table->dropIndex(['post_count']);
            $table->dropIndex(['comment_count']);
            $table->dropIndex(['like_count']);
            $table->dropIndex(['follower_count']);
            $table->dropIndex(['following_count']);
        });
    }
}
