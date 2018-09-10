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
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('alternative_mobile')->nullable();
            $table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->string('full_address')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}