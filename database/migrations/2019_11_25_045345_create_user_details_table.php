<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserDetailsTable.
 */
class CreateUserDetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_details', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('bio');
            $table->string('address');
            $table->string('picture');
            $table->unsignedInteger('niche_id');
            $table->string('timezone')->nullable();
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('country_id');
            $table->string('website' , 255);
            $table->string('phone')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
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
		Schema::drop('user_details');
	}
}
