<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTickethasinvoiceTable extends Migration {

	public function up()
	{
		Schema::create('tickethasinvoice', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('ticket_id')->unsigned()->nullable();
			$table->integer('invoice_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('tickethasinvoice');
	}
}