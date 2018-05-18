<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {

	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('mobile');
			$table->string('phone')->nullable();
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('employees');
	}
}