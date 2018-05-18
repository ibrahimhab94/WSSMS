<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('mobile');
			$table->string('email');
			$table->string('alternative_mobile');
			$table->string('phone');
			$table->string('address')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}