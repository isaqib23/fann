<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserPlatformsTable.
 */
class CreateUserPlatformsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_platforms', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('provider', ['instagram', 'youtube']);
            $table->string('provider_id');
            $table->string('provider_name');
            $table->longText('access_token');
            $table->string('provider_photo');
            $table->json('meta_json');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_platforms');
	}
}
