<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserCreditCardsTable.
 */
class CreateUserCreditCardsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_credit_cards', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('card_id');
            $table->string('brand');
            $table->string('country');
            $table->string('exp_month');
            $table->string('exp_year');
            $table->string('funding');
            $table->string('last4');
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
        Schema::disableForeignKeyConstraints();
		Schema::drop('user_credit_cards');
        Schema::enableForeignKeyConstraints();
	}
}
