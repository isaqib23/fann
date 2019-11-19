<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotificationsTable.
 */
class CreateNotificationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id');
            $table->string('itemable');
            $table->text('text');
            $table->unsignedInteger('itemable_id');


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('notification_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}
}
