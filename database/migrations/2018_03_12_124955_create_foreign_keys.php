<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('invoices', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('customers')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('customers')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->foreign('employee_id')->references('id')->on('employees')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('cstexecutions', function(Blueprint $table) {
			$table->foreign('ticket_id')->references('id')->on('cs_tickets')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('cstexecutions', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('tickethasinvoice', function(Blueprint $table) {
			$table->foreign('ticket_id')->references('id')->on('cs_tickets')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('tickethasinvoice', function(Blueprint $table) {
			$table->foreign('invoice_id')->references('id')->on('cs_tickets')
						->onDelete('set null')
						->onUpdate('set null');
		});
	}

	public function down()
	{
		Schema::table('invoices', function(Blueprint $table) {
			$table->dropForeign('invoices_user_id_foreign');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->dropForeign('invoices_customer_id_foreign');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->dropForeign('cs_tickets_user_id_foreign');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->dropForeign('cs_tickets_customer_id_foreign');
		});
		Schema::table('cs_tickets', function(Blueprint $table) {
			$table->dropForeign('cs_tickets_employee_id_foreign');
		});
		Schema::table('cstexecutions', function(Blueprint $table) {
			$table->dropForeign('cstexecutions_ticket_id_foreign');
		});
		Schema::table('cstexecutions', function(Blueprint $table) {
			$table->dropForeign('cstexecutions_user_id_foreign');
		});
		Schema::table('tickethasinvoice', function(Blueprint $table) {
			$table->dropForeign('tickethasinvoice_ticket_id_foreign');
		});
		Schema::table('tickethasinvoice', function(Blueprint $table) {
			$table->dropForeign('tickethasinvoice_invoice_id_foreign');
		});
	}
}