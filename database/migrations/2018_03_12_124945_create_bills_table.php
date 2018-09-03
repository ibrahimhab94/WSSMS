<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsTable extends Migration {

	public function up()
	{
		Schema::create('bills', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->double('amount');
			$table->string('client_name');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('customer_id')->unsigned()->nullable();
			$table->unsignedInteger('constraint')->nullable();
			$table->boolean('invoiced');
			$table->enum('status',['OK','INVOICED','WE','WA','DELETED','S','OTHER']);
			$table->text('details');

			//WE waiting edit , WA waiting Approvment,S Suspended
		});
	}

	public function down()
	{
		Schema::drop('invoices');
	}
}