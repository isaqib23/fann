<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserMetasTable.
 */
class CreateUserMetasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_metas', function(Blueprint $table) {
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
	 *provider,provider_id,provider_name,access_token,provider_photo,meta_json
	 * @return void
	 */
	public function down()
	{
        Schema::disableForeignKeyConstraints();
		Schema::drop('user_metas');
        Schema::enableForeignKeyConstraints();
	}
}
