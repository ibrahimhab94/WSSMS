<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCsTicketsTable extends Migration {

	public function up()
	{
		Schema::create('cs_tickets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ticket_no')->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('customer_id')->unsigned()->nullable();
			$table->integer('employee_id')->unsigned()->nullable();
			$table->timestamp('leave_time')->nullable();
			$table->tinyInteger('status')->nullable();
			$table->text('customer_details')->nullable();
			$table->text('user_details');
			$table->text('customer_detail')->nullable();
			$table->timestamp('arrive_time')->nullable();
			$table->integer('proirity')->nullable()->default('0');
		});
	}

	public function down()
	{
		Schema::drop('cs_tickets');
	}
}