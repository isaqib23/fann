<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotificationTypesTable.
 */
class CreateNotificationTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();

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
        Schema::disableForeignKeyConstraints();
		Schema::drop('notification_types');
        Schema::enableForeignKeyConstraints();
	}
}
