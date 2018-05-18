<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCstexecutionsTable extends Migration {

	public function up()
	{
		Schema::create('cstexecutions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('ticket_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamp('leave_time')->nullable();
			$table->integer('status')->default('-1');
			$table->text('customer_detail')->nullable();
			$table->text('employee_details')->nullable();
			$table->timestamp('arrive_time')->nullable();
			$table->string('customer_rate');
			$table->string('employee_rate');
		});
	}

	public function down()
	{
		Schema::drop('cstexecutions');
	}
}