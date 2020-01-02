<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCompaniesTable.
 */
class CreateCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('logo');
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
            $table->foreign('niche_id')->references('id')->on('niches');
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
		Schema::drop('companies');
        Schema::enableForeignKeyConstraints();
	}
}
