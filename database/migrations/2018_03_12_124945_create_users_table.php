<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 200);
			$table->string('username')->unique();
			$table->string('password');
			$table->text('details');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}