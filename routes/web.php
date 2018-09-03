<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/Dashboard','DashboardController@dashboard');
Route::get('/login','DashboardController@dashboard');
//customer grpup
Route::get('/Dashboard/Customers/List','CustomersController@list')->name('customers');
Route::post('/Dashboard/Customers/Add_Customer/JSON','CustomersController@add_customer_json')->name('add_customer_json');
Route::post('/Dashboard/Customers/Update_Customer','CustomersController@update_customer')->name('update_customer');
//customer services group
Route::get('/Dashboard/CustomerServices/tickets','CustomerService@tickets')->name('view_tickets');
Route::post('/Dashboard/CustomerServices/Ticket/ChangeState','CustomerService@changeTicketState')->name('change_state');
Route::post('/Dashboard/CustomerServices/New/Ticket','CustomerService@insert')->name('submit_cs_ticket');
Route::post('/Dashboard/CustomerService/Customer/Profile/','CustomerService@profile')->name('get_customer_profile');
Route::post('/Dashboard/CustomerService/Customer/Ticket/','CustomerService@getTicketData')->name('get_ticket_data');
Route::post('/Dashboard/CustomerService/Customer/Ticket/GET_TICKET_STATE','CustomerService@getTicketStateView')->name('get_ticket_state');

Route::get('/Dashboard/Employees/View','CustomerService@listEmployees')->name('get_employees');
Route::get('/Dashboard/Employees/GET','CustomerService@getEmployees')->name('get_employees_ajax');


// ACCOUNTING ROUTE
Route::prefix('/Dashboard/Accounting/')->group(function () {
    Route::get('Accounts/Tree','Accounting@tree')->name('accounts_tree');
});
